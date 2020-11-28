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
        th,tr{
            border: 3px groove #000;
        }
        table{
            border: 2px solid #000;
        }
    </style>
</head>
<body>
    <table align="center" width="794" bgcolor="#FFCC99">
       <tr align="center">
          <td colspan="10"><h2>View All products</h2></td> 
       </tr>
        <tr>
            <th>Product No.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        include("includes/db.php");
        $i=0;
        $get_pro="select * from products";
        $run_pro=mysqli_query($connection,$get_pro);
        while($row_pro=mysqli_fetch_array($run_pro)){
            $p_id=$row_pro['product_id'];
            $p_title=$row_pro['product_title'];
            $p_img=$row_pro['product_img1'];
            $p_id=$row_pro['product_id'];
            $p_price=$row_pro['product_price'];
            $status=$row_pro['status'];
            $i++;
            ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $p_title; ?></td>
                <td><img src="product_images/<?php echo $p_img; ?>" alt="" width="60" height="60"></td>
                <td><?php echo $p_price; ?></td>
                <td>
                    <?php
                    $get_sold="select * from pending_orders where product_id='$p_id'";
            $run_sold=mysqli_query($connection,$get_sold);
            $count=mysqli_num_rows($run_sold);
            echo $count;
                    ?>
                </td>
                <td><?php echo $status; ?></td>
                <td><a href="index.php?edit_pro=<?php echo $p_id ?>">Edit</a></td>
                <td><a href="delete_pro.php?delete_pro=<?php echo $p_id ?>">Delete</a></td>
            </tr>
            
    <?php    }?>
    </table>
</body>
</html>
<?php } ?>