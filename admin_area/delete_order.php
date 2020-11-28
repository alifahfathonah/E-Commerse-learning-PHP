<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
if(isset($_GET['delete_order'])){
    $order_id=$_GET['delete_order'];
    $delete_order="delete from pending_orders where order_id='$order_id'";
    $run_order=mysqli_query($connection,$delete_order);
    if($run_order){
        echo "<script>alert('One order has been deleted!')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";
    }
    
}
}
?>