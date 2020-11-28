<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        tr,th{
            border: 2px groove #000;
        }
    </style>
</head>
<body>
    <table width="794" bgcolor="#FFCCCC" align="center">
       <tr align="center">
    <td colspan="4"><h2>View All Categories</h2></td>
</tr>
<tr>
    <th>Category ID</th>
    <th>Category Title</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
<?php
        include("includes/db.php");
        $get_cats="select * from categories";
        $run_cats=mysqli_query($connection,$get_cats);
        while($row_cats=mysqli_fetch_array($run_cats)){
          $cat_id=$row_cats['cat_id'];  
          $cat_title=$row_cats['cat_title'];  

        ?>
<tr align="center">
       <td><?php echo $cat_id ?></td>
       <td><?php echo $cat_title ?></td>
       <td><a href="index.php?edit_cat=<?php echo $cat_id ?>">Edit</a></td>
        <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id ?>">Delete</a>
        </tr>
        <?php  } ?>
    </table>
</body>
</html>
<?php } ?>