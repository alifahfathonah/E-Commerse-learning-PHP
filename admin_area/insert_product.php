<?php
include("includes/db.php");
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
   <form action="insert-product.php" method="post" enctype="multipart/form-data">
    <table width="794" align="center" bgcolor="#3399cc" border="1">
        <tr align="center">
            <td colspan="2">
                <h1>Inser new Product:</h1>
            </td>
        </tr>
        <tr>
            <td align="rigth"><b>Product Title</b></td>
            <td>
                <input type="text" size="50" name="product_title">
            </td>
        </tr>
           
            <tr>
            <td align="rigth"><b>Product Category</b></td>
            <td>
                <select name="product_cart">
                    <option>Select a Category</option>
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
                    <option>Select a Brand</option>
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
                <input type="file" name="product_img1">
            </td>
        </tr>
         <tr>
            <td align="rigth"><b>Product Image 2</b></td>
            <td>
                <input type="file" name="product_img2">
            </td>
        </tr>
            <tr>
            <td align="rigth"><b>Product Image 3</b></td>
            <td>
                <input type="file" name="product_img3">
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Price</b></td>
            <td>
                <input type="text" size="50" name="product_price">
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Description</b></td>
            <td>
                <textarea name="product_desc" cols="35" rows="10"></textarea> 
            </td>
        </tr>
           <tr>
            <td align="rigth"><b>Product Keywords</b></td>
            <td>
                <input type="text" size="50" name="product_keywords">
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input type="submit" name="insert_product" value="Insert Product">
            </td>
        </tr>
    </table>
</form>
</body>
</html>

<?php
    if(isset($_POST['insert_product'])){
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
                
            $insert_product="insert into products values(Null,'$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_keywords','$status')";    
            $run_product=mysqli_query($connection,$insert_product);
            if($run_product){
                echo "<script>alert('Product insreted Successfully');</script>";
                echo "<script>window.open('index.php?insert_product','_self')</script>";
            }
        else{
            echo mysqli_error($connection);
        }
        
    }
?>