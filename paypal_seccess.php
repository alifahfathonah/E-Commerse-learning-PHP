<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
     <h2>you have successfully paid for your order</h2>
    <h3>Go to back our Shop</h3>
    <a href="www.myshop.com">Go to shop</a>
</body>
</html>


<?php
include("includes/db.php");
       //-getting product price and number of items for paypal----
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
        $ip_add=$record['ip_add'];
        $pro_qty=$record['qty'];
        $pro_price="select * from products where product_id='$pro_id'";
        $run_pro_price=mysqli_query($connection,$pro_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_name=$p_price['product_title'];
            $product_id=$p_price['product_id'];
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total +=$values; 
            $i++;
        }
    }
 $customer_name="select * from customers where customer_ip='$ip_add'";
        $run_customer=mysqli_query($connection,$customer_name);
$row_customer=mysqli_fetch_array($run_customer);
$customer_id=$row_customer['customer_id'];
$customer_name1=$row_customer['customer_name'];

//----script for storing payment info ------this will with real payment getway---
$transaction_id=$_REQUEST['tx']; //---paypal transaction id
$amount=$_REQUEST['amt']; //---paypal receved amount
$currency=$_REQUEST['cc']; //---paypal receved currency type

$insert_payment="insert into paypal_payments values(NULL,'$transaction_id','$amount','$currency','$customer_id','$customer_name1','$pro_id','$pro_qty')";
$run_payment=mysqli_query($connection,$insert_payment);
$empty_cart="delete * from cart";
$run_cart=mysqli_query($connection,$empty_cart);
?>