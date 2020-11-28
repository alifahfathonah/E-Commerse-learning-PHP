<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        tr,th{
            border: 2px groove #000;
        }
    </style>
</head>
<body>
    <table width="794" bgcolor="#FFCCCC" align="center">
       <tr align="center">
    <td colspan="4"><h2>View All Orders</h2></td>
</tr>
<tr>
    <th>Order No.</th>
    <th>Customer</th>
    <th>Invoice No.</th>
    <th>Product Id</th>
    <th>QTY</th>
    <th>Status</th>
    <th>Delete</th>
</tr>
<?php
        include("includes/db.php");
        $get_order="select * from pending_orders";
        $run_order=mysqli_query($connection,$get_order);
         $i=0;
        while($row_order=mysqli_fetch_array($run_order)){
           
          $order_id=$row_order['order_id'];  
          $c_id=$row_order['customer_id'];  
          $invoice=$row_order['invoice_no'];  
          $product_id=$row_order['product_id'];  
          $qty=$row_order['qty'];  
          $status=$row_order['order_status']; 
            $i++;
          
        ?>
<tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php  
           $get_customer="select * from customers where customer_id='$c_id'";
            $run_customer=mysqli_query($connection,$get_customer);
            $row_customer=mysqli_fetch_array($run_customer);
            $customer_email=$row_customer['customer_email'];
            echo $customer_email;
           ?></td>
       <td bgcolor='pink'><?php echo  $invoice ?></td>
       <td><?php echo  $product_id ?></td>
       <td><?php echo  $qty ?></td>
       <td><?php echo  $status ?></td>
    <td><a href="delete_order.php?delete_order=<?php echo $order_id ?>">Delete</a></td>
        </tr>
        <?php  } ?>
    </table>
</body>
</html>
<?php } ?>