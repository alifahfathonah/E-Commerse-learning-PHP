<?php
@session_start();
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else
{
include("includes/db.php");
//----getting the specific product from table----
if(isset($_GET['edit_pro'])){
    $edit_id=$_GET['edit_pro'];
    
    $get_edit="select * from products where product_id='$edit_id'";
    $run_edit=mysqli_query($connection,$get_edit);
    $row_edit=mysqli_fetch_array($run_edit);
    
    $p_title=$row_edit['product_title'];
    $cat_id=$row_edit['cat_id'];
    $brand_id=$row_edit['brand_id'];
    $p_image1=$row_edit['product_img1'];
    $p_image2=$row_edit['product_img2'];
    $p_image3=$row_edit['product_img3'];
    $p_price=$row_edit['product_price'];
    $p_desc=$row_edit['product_desc'];
    $p_keywords=$row_edit['product_keywords'];
}
//---getting the exact brand for product
$get_cat="select * from categories where cat_id='$cat_id'";
$run_cat=mysqli_query($connection,$get_cat);
$cat_row=mysqli_fetch_array($run_cat);
$cat_edit_title=$cat_row['cat_title'];

//---getting the product relevent gategory
$get_brand="select * from brands where brand_id='$brand_id'";
$run_brand=mysqli_query($connection,$get_brand);
$brand_row=mysqli_fetch_array($run_brand);
$brand_edit_title=$brand_row['brand_title'];
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
    <!--- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>--->
</head>

<body bgcolor="#999999">
   <form action="" method="post" enctype="multipart/form-data">
    <table width="794" align="center" bgcolor="#3399cc" border="1">
        <tr align="center">
            <td colspan="2">
                <h1>Update or Edit Prodct:</h1>
            </td>
        </tr>
        <tr>
            <td align="rigth"><b>Product Title</b></td>
            <td>
                <input type="text" size="50" name="product_title" value="<?php echo $p_title; ?>">
            </td>
        </tr>
           
            <tr>
            <td align="rigth"><b>Product Category</b></td>
            <td>
                <select name="product_cart">
                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_edit_title; ?></option>
                 <?php
             $get_cats="select *  from categories";
              $run_cats=mysqli_query($connection,$get_cats);
              while($row_cats=mysqli_fetch_array($run_cats)){
                  $cat_id=$row_cats['cat_id'];
                  $cat_title=$row_cats['cat_title'];
              echo "<option value='$cat_id'>$cat_title</option>";
                  }
              ?>
                </select>
            </td>
        </tr>
            <tr>
            <td align="rigth"><b>Product Brand</b></td>
            <td>
                <select name="product_brand">
                    <option value="<?php echo $brand_id; ?>"><?php echo $brand_edit_title; ?></option>
                <?php
             $get_brands="select *  from brands";
              $run_brands=mysqli_query($connection,$get_brands);
              while($row_brands=mysqli_fetch_array($run_brands)){
                  $brand_id=$row_brands['brand_id'];
                  $brand_title=$row_brands['brand_title'];
             echo "<option value='$brand_id'>$brand_title</option>";
                  }
              ?>
                </select>
            </td>
        </tr>
            <tr>
            <td align="rigth"><b>Product Image 1</b></td>
            <td>
                <input type="file" name="product_img1"><br><img src="product_images/<?php echo $p_image1 ?>" width="80" height="80">
            </td>
        </tr>
         <tr>
            <td align="rigth"><b>Product Image 2</b></td>
            <td>
                <input type="file" name="product_img2"><br><img src="product_images/<?php echo $p_image2 ?>" width="80" height="80">
            </td>
        </tr>
            <tr>
            <td align="rigth"><b>Product Image 3</b></td>
            <td>
                <input type="file" name="product_img3"><br><img src="product_images/<?php echo $p_image3 ?>" width="80" height="80">
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Price</b></td>
            <td>
                <input type="text" size="50" name="product_price" value="<?php echo $p_price; ?>">
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Description</b></td>
            <td>
                <textarea name="product_desc" cols="35" rows="10" ><?php echo $p_desc; ?></textarea> 
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Keywords</b></td>
            <td>
                <input type="text" size="50" name="product_keywords" value="<?php echo $p_keywords; ?>">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="submit" name="update_product" value="Update Product">
            </td>
        </tr>
    </table>
</form>
</body>
</html>

<?php
    if(isset($_POST['update_product'])){
        $product_title=$_POST['product_title'];
        @$product_cat=$_POST['product_cart'];
        @$product_brand=$_POST['product_brand'];
        $product_price=$_POST['product_price'];
        $product_desc=$_POST['product_desc'];
        @$product_keywords=$_POST['product_keywords'];
        $status='on';
        
        //image names
        $product_img1=$_FILES['product_img1']['name'];
        $product_img2=$_FILES['product_img2']['name'];
        $product_img3=$_FILES['product_img3']['name'];
        
         //image temp-names
        $temp_name1=$_FILES['product_img1']['tmp_name'];
        $temp_name2=$_FILES['product_img2']['tmp_name'];
        $temp_name3=$_FILES['product_img3']['tmp_name'];
        
       /*--- if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keywords=='' OR $status=='' OR $product_img1=='' OR $product_img2=='' OR $product_img3=='')
        {
            echo "<script>alert('Please fill all the fields!');</script>";
            exit();
        }
        else{----*/
            //--Uploading images to it's folder
            move_uploaded_file($temp_name1,"product_images/$product_img1");
            move_uploaded_file($temp_name2,"product_images/$product_img2");
            move_uploaded_file($temp_name3,"product_images/$product_img3");
            
         $update_product="update products set cat_id='$product_cat',brand_id='$product_brand',date=NOW(),product_title='$product_title',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_price='$product_price',product_desc='$product_desc',product_keywords='$product_keywords' where product_id='$edit_id'";
        
            $run_product=mysqli_query($connection,$update_product);
            if($run_product){
                echo "<script>alert('Product updated Successfully');</script>";
                echo "<script>window.open('index.php?view_products','_self')</script>";
            }
        else{
            echo mysqli_error($connection);
        }
        
    }
}
?>