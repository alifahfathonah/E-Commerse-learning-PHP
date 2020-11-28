<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
if(isset($_GET['delete_c'])){
    $delete_id=$_GET['delete_c'];
    $delete_c="delete from customers where customer_id='$delete_id'";
    $run_c=mysqli_query($connection,$delete_c);
    if($run_c){
        echo "<script>alert('Customer has been deleted Succesfully!')</script>";
        echo "<script>window.open('index.php?view_customers','_self')</script>";
    }
    
}
}
?>