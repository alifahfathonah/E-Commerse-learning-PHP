<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
if(isset($_GET['edit_brand'])){
   $brand_id=$_GET['edit_brand'];
    $select_brand="select * from brands where brand_id='$brand_id'";
    $run_brand=mysqli_query($connection,$select_brand);
    $row_brand=mysqli_fetch_array($run_brand);
    $brand_title=$row_brand['brand_title'];
      
    
}

?>
<form action="" method="post">
<table width="794" bgcolor="#3399cc" border="1">
<tr align="center">
    <td colspan="4"><h2>Edit Brand</h2></td>
</tr>
<tr>
<td style="text-align:right"><b>Brand Name: </b></td>
         <td  align="right" width="20"><input type="text" name="brand_name" required value="<?php echo $brand_title ?>"></td>  
         <td><input type="submit" name="update_brand" value="Update Brand"></td>  
    </tr>


</table>
</form>
<?php
if(isset($_POST['update_brand'])){
    $brand_title=$_POST['brand_name'];
    $update_brand="update brands set brand_title='$brand_title' where brand_id='$brand_id'";
    $brand_update=mysqli_query($connection,$update_brand);
    if($brand_update){
        echo "<script>alert('Brand has been updated Successfully');</script>";
                echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
}}
?>