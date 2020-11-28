<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
if(isset($_GET['edit_cat'])){
   $cat_id=$_GET['edit_cat'];
    $select_cat="select * from categories where cat_id='$cat_id'";
    $run_cat=mysqli_query($connection,$select_cat);
    $row_cat=mysqli_fetch_array($run_cat);
    $cat_title=$row_cat['cat_title'];
      
    
}

?>
<form action="" method="post">
<table width="794" bgcolor="#3399cc" border="1">
<tr align="center">
    <td colspan="4"><h2>EditCategories</h2></td>
</tr>
<tr>
<td style="text-align:right"><b>Category Name: </b></td>
         <td  align="right" width="20"><input type="text" name="cat_name" required value="<?php echo $cat_title ?>"></td>  
         <td><input type="submit" name="update_cat" value="Update Category"></td>  
    </tr>
    <tr align="center">
        
    </tr>

</table>
</form>
<?php
if(isset($_POST['update_cat'])){
    $cat_title=$_POST['cat_name'];
    $update_category="update categories set cat_title='$cat_title' where cat_id='$cat_id'";
    $run_update=mysqli_query($connection,$update_category);
    if($run_update){
        echo "<script>alert('Category has been updated Successfully');</script>";
                echo "<script>window.open('index.php?view_cats','_self')</script>";
    }
} 
}
?>