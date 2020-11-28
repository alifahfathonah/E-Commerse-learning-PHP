<?php
include("includes/db.php");

?>
<form action="" method="post">
<table width="794" bgcolor="#3399cc" border="1">
<tr align="center">
    <td colspan="4"><h2>Insert New Categories</h2></td>
</tr>
<tr>
<td style="text-align:right"><b>Category Name: </b></td>
         <td  align="right" width="20"><input type="text" name="cat_name" required></td>  
         <td><input type="submit" name="insert_cat" value="Insert Category"></td>  
    </tr>
    <tr align="center">
        
    </tr>

</table>
</form>
<?php
if(isset($_POST['insert_cat'])){
   $cat_name=$_POST['cat_name'];
    $insert_cat="insert into categories values(NULL,'$cat_name')";
    $run_cat=mysqli_query($connection,$insert_cat);
     if($run_cat){
        echo "<script>alert('Category has been inserted Successfully.')</script>";
        echo "<script>window.open('index.php?view_cats','_self')</script>";
    }
    
}
?>