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
    <td colspan="4"><h2>View All Customrrs</h2></td>
</tr>
<tr>
    <th>S.N.</th>
    <th>Name</th>
    <th>Email</th>
    <th>Image</th>
    <th>Country</th>
    <th>Delete</th>
</tr>
<?php
        include("includes/db.php");
        $get_customers="select * from customers";
        $run_customers=mysqli_query($connection,$get_customers);
        $i=0;
        while($row_customers=mysqli_fetch_array($run_customers)){
            
          $c_id=$row_customers['customer_id'];  
          $c_name=$row_customers['customer_name'];  
          $c_email=$row_customers['customer_email'];  
          $c_image=$row_customers['customer_image'];  
          $c_country=$row_customers['customer_country']; 
            $i++;
          
        ?>
<tr align="center">
       <td><?php echo $i ?></td>
       <td><?php echo $c_name ?></td>
       <td><?php echo $c_email ?></td>
       <td><img src="../customer/customer_photos/<?php echo $c_image ?>" width="60" height="60"></td>
       <td><?php echo $c_country ?></td>
    <td><a href="delete_customer.php?delete_c=<?php echo $c_id ?>">Delete</a></td>
        </tr>
        <?php  } ?>
    </table>
</body>
</html>
<?php } ?>