<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    //---getting customer id----
    if(isset($_GET['c_id'])){
        $customer_id=$_GET['c_id'];
        //*-----getting email for sending customer by mail
        $c_email="select * from customers where customer_id='$customer_id'";
        $email_run=mysqli_query($connection,$c_email);
        $row_email=mysqli_fetch_array($email_run);
        $customer_email=$row_email['customer_email'];
        $customer_name=$row_email['customer_name'];
    }
    //-getting product price and number of items
    $i=0;
      $ip_add=getRealIpAddr();
    $total=0;
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price=mysqli_query($connection,$sel_price);
    $status='pending';
    $invoice_no=mt_rand(); ///generating a randam number--
    $count_pro=mysqli_num_rows($run_price); //---counting products--
    while($record=mysqli_fetch_array($run_price)){
        $pro_id=$record['p_id'];
        $pro_price="select * from products where product_id='$pro_id'";
        $run_pro_price=mysqli_query($connection,$pro_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_name=$p_price['product_title'];
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total +=$values; 
            $i++;
        }
    }
    //--getting quaintity from the cart and insrting data into customer_orders and pending_orders table----
    $get_cart="select * from cart";
    $run_cart=mysqli_query($connection,$get_cart);
    $get_qty=mysqli_fetch_array($run_cart);
    $qty=$get_qty['qty'];
    $qty=$qty;
    $sub_total=$total*$qty;
    $insert_order="insert into customer_orders values(NULL,'$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status')";
   $run_order=mysqli_query($connection,$insert_order);
    if($run_order){
        echo "<script>alert('Order successfully submited,Thank You!')</script>";
     echo "<script>window.open('customer/my_account.php','_self')</script>";
       $insert_to_pending_orders="insert into pending_orders values(NULL,'$customer_id','$invoice_no','$pro_id','$qty','$status')";
        $run_pending_order=mysqli_query($connection,$insert_to_pending_orders);
        $empty_cart="delete from cart where ip_add='$ip_add' ";
        $run_empty=mysqli_query($connection,$empty_cart);
        
        
        //*-------sending message to customer about order info.---
        $from="myside@acadmy.com";
        $subject="Order Details";
        $message="
        <html>
        <p>Hello Dear <b style='color:blue'>$customer_name</b>You have orderd some products on yor website www.mysite.com, Plaese find ypur orders details below and pay the dues as soon as possible, so we can proceed your order. Thank You!</p>
        <table bgcolor='#FFCC99' align='center' width='600' border='2'>
        <tr>
        <td><h2>Your order details form mysite.com</h2></td>
        </tr>
        <tr>
        <th><b>S.N.</b></th>
        <th><b>Product Name</b></th>
        <th><b>Quantity</b></th>
        <th><b>Total Price</b></th>
        <th><b>Invoice no</b></th>
        </tr>
        <tr>
        <td>$i</td>
        <td>$product_name</td>
        <td>$qty</td>
        <td>$sub_total</td>
        <td>$invoice_no</td>
        </tr>
        </table> 
        <h2>Please go to your account and pay the dues</h2>
        <h3><a href='www.mysite.com' >Click Here</a>to login to your account</h3>
        <h3>Thank You for order on mysite.com.</h3>
        </html>
        ";
        mail($customer_email,$subject,$message,$from);
    }
    
    else{
       
        echo mysqli_error($connection);
        
}
    ?>
</body>
</html>