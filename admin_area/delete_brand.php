<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
?>
include("includes/db.php");
if(isset($_GET['delete_brand'])){
    $delete_id=$_GET['delete_brand'];
    $delete_brand="delete from brands where brand_id='$delete_id'";
    $run_brand=mysqli_query($connection,$delete_brand);
    if($run_brand){
        echo "<script>alert('One brand has been deleted!')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
    
}
}
?>