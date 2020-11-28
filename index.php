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
  <!--for getting ip address and adding in to cart and we can call anywhere this function in this page--->
   <?php cart(); ?>
   <!---end cart----->
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
          <li><a href="customer/my_account.php">My Account</a></li>
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
              
                getPro();
              //---getting product by category---
                 getCatPro();
         //---getting product by brand----
            getBrandPro();
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
