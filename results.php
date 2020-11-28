<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link href="styles/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <div class="main_wrapper">
  <!---header start--->
  <div class="header_wrapper">
      <a href="index.php">  <img src="imgaes/businessWireLogo.jpg" style="float:left" width="250px;" height="150"></a>
      <img src="imgaes/ecommerce-banner.png" style="float:right" width="750px;" height="150">
  </div>
  <!--header end----->
  <!---navigation bar start--->
  <div id="navbar">
      <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="my_account.php">My Account</a></li>
          <li><a href="user_register.php">Sign Up</a></li>
          <li><a href="cart.php">Shopping Cart</a></li>
          <li><a href="contact.php">Connect Us</a></li>
      </ul>
      <!--search box---->
      <div id="form">
        <form method="get" action="results.php" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="Search a product">
            <input type="submit" name="search" value="search">
        </form>
      </div>
  </div>
  <!----navigation bar end--->
  <!----content _wrapper start-->
  <div class="content_wrapper">
      <div id="left_sidebar">
          <div id="sidebar_title">
              Categories
          </div>
          <ul id="cats">
            <?php
           getCats();
              ?>
          </ul>
          
           <div id="sidebar_title">
              Brands
          </div>
          <ul id="cats">
              <?php
            getBrands();
              ?>
          </ul>
      </div>
      
      <div class="right_content">
          <div class="headline">
              <div class="headline_content">
                     <?php
                  if(!isset($_SESSION['customer_email'])){
                    echo "<b>Welcome Guest!</b><b style='color:yellow'> Shopping Cart</b>";  
                  }
                  else
                  {
                     echo "<b>Welcome: "."<span style='color:skyblue'>".$_SESSION['customer_email']."</span>"."</b>"."<b style='color:yellow'> Your Shopping Cart</b>"; 
                  }
                  ?>
                  <span>
          - Total Items: <?php items(); ?> - Total Price: <?php total_price(); ?> - <a href="cart.php" style="color:#ff0">Go to Cart</a> &nbsp;
                 <?php
                   if(!isset($_SESSION['customer_email'])){
                 echo "<a href='checkout.php' style='color:#F93'>Login</a>";
                  }
                  else
                  {
                      echo "<a href='logout.php' style='color:#F93'>Logout</a>";
                 }
                      ?>
                 </span>
              </div>
          </div>
          <!---product box---->
          <div class="products_box">
              <?php
          if(isset($_GET['search'])){
              $user_keywords=$_GET['user_query'];
     $get_products="select * from products where product_keywords like '%$user_keywords%' ";
              $run_products=mysqli_query($connection,$get_products);
              while($row_products=mysqli_fetch_array($run_products)){
                  $pro_id=$row_products['product_id'];
                  $pro_title=$row_products['product_title'];
                  $pro_cat=$row_products['cat_id'];
                  $pro_brand=$row_products['brand_id'];
                  $pro_desc=$row_products['product_desc'];
                  $pro_price=$row_products['product_price'];
                  $pro_image=$row_products['product_img1'];
                  
                  echo "
                  <div class='single_product'>
                  <h3>$pro_title</h3>
                 <a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='220' height='210' /></a>
                  <br>
                   <p><b>price $pro_price</b></p>
                  <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                 
                  <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Chart</button></a>
                  </div>
                  ";
              }
    }
              else{
                 echo mysqli_error($connection);
              }
    

//---end
              ?>
          </div>
          
<!----end prodct box---->
      </div>
  </div>
  <!---footer start---->
  <div class="footer">
      <h1 style="color:#fff;text-align:center;padding-top:30px;">&copy; 2017 - by sonu mittal</h1>
      
  </div>
  <!-----footer end---->
  </div>  
</body>
</html>
