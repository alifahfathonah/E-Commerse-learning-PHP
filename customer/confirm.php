
<?php
@session_start();
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}
else
{
?>
include("includes/db.php");
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body bgcolor="#000">
    <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
        <table width="500" align="center" border="2" bgcolor="#ccc">
            <tr align="center">
                <td colspan="5">Please Confirm your payment</td>
            </tr>
            <tr>
                <td align="right">Invoice No: </td>    
                <td><input type="text" name="invoice_no"></td>
            </tr>
              <tr>
                <td align="right">Amount Sent: </td>    
                <td><input type="text" name="amount"></td>
            </tr>
             <tr>
                <td align="right">Select Payment Mode: </td>    
                <td><select name="payment_method">
                    <option>Select Payment</option>
                    <option>Bank Transfer</option>
                    <option>Easypaisa/UBL Omni</option>
                    <option>Western Union</option>
                    <option>Paypal</option>
                </select></td>
            </tr>
            <tr>
                <td align="right">Transaction/Refference ID:</td>    
                <td><input type="text" name="tr"></td>
            </tr>
            <tr>
                <td align="right">Easypaisa/UBLOMNT code: </td>    
                <td><input type="text" name="code"></td>
            </tr>
             <tr>
                <td align="right">Payment Date</td>    
                <td><input type="text" name="date"></td>
            </tr>
             <tr align="center">
                   
                <td colspan="5"><input type="submit" name="confirm" value="Confirm Payment"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
if(isset($_POST['confirm'])){
    $update_id=$_GET['update_id'];
    
    $invoice=$_POST['invoice_no'];
    $amount=$_POST['amount'];
    $payment_method=$_POST['payment_method'];
    $ref_no=$_POST['tr'];
    $code=$_POST['code'];
    $date=$_POST['date'];
    $invoice=$_POST['invoice_no'];
    $complete='complete';
    $insert_payment="insert into payments values(NULL,'$invoice','$amount','$payment_method','$ref_no','$code','$date')";
    $run_payment=mysqli_query($connection,$insert_payment);
$update_order="update pending_orders set order_status='$complete' where order_id='$update_id'";
    $run_order=mysqli_query[$update_order];
    if($run_payment){
        echo "<h2 style='text-align:center;color:#fff;'>Payment Received, Your order will be completed with in 24 hours.</h2>";
    }
    $update_order="update customer_orders set order_status='complete' where order_id='$update_id' ";
    $run_order=mysqli_query($connection,$update_order);
    if($run_order){
     echo "<script>window.open('my_account.php','_self')</script>";
}
} }
?>