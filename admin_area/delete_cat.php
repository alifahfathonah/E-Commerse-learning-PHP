<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
if(isset($_GET['delete_cat'])){
    $delete_id=$_GET['delete_cat'];
    $delete_cat="delete from categories where cat_id='$delete_id'";
    $run_cat=mysqli_query($connection,$delete_cat);
    if($run_cat){
        echo "<script>alert('One category has been deleted!')</script>";
        echo "<script>window.open('index.php?view_cats','_self')</script>";
    }
    
}
}
?>