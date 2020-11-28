
<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");

?>
<form action="" method="post">
<table width="794" bgcolor="#3399cc" border="1">
<tr align="center">
    <td colspan="4"><h2>Insert New Brand</h2></td>
</tr>
<tr>
<td style="text-align:right"><b>Brand Name: </b></td>
         <td  align="right" width="20"><input type="text" name="brand_name" required></td>  
         <td><input type="submit" name="insert_brand" value="Insert Brand"></td>  
    </tr>
    <tr align="center">
        
    </tr>

</table>
</form>
<?php
if(isset($_POST['insert_brand'])){
   $brand_name=$_POST['brand_name'];
    $insert_brand="insert into brands values(NULL,'$brand_name')";
    $run_brand=mysqli_query($connection,$insert_brand);
     if($run_brand){
        echo "<script>alert('Brand has been inserted Successfully.')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
    
}}
?>