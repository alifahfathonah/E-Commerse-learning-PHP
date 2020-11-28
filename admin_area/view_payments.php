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
    <td colspan="4"><h2>View All Payements</h2></td>
</tr>
<tr>
    <th>Payment No.</th>
    <th>Invoice No.</th>
    <th>Amount Paid</th>
    <th>Payment Method</th>
    <th>Ref No.</th>
    <th>Code</th>
    <th>Payment Date</th>
</tr>
<?php
        include("includes/db.php");
        $get_payments="select * from payments";
        $run_payments=mysqli_query($connection,$get_payments);
         $i=0;
        while($row_payments=mysqli_fetch_array($run_payments)){
           
          $payment_id=$row_payments['payment_id'];  
          $invoice=$row_payments['invoice_no'];  
          $amount=$row_payments['amount'];  
          $payment_m=$row_payments['payment_mode'];  
          $code=$row_payments['code'];  
          $date=$row_payments['payment_date'];  
        
            $i++;
          
        ?>
<tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $payment_id ?></td>
       <td bgcolor='pink'><?php echo  $invoice ?></td>
       <td><?php echo  $amount ?></td>
       <td><?php echo   $code ?></td>
       <td><?php echo  $date ?></td>
        </tr>
        <?php  } ?>
    </table>
</body>
</html>
<?php  } ?>