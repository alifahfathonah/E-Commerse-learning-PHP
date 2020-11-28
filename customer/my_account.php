
<?php 
@session_start();
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}
else
{

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
      <a href="../index.php">  <img src="../imgaes/businessWireLogo.jpg" style="float:left" width="250px;" height="150"></a>
      <img src="../imgaes/ecommerce-banner.png" style="float:right" width="750px;" height="150">
  </div>
  <!--header end----->
  <!---navigation bar start--->
  <div id="navbar">
      <ul id="menu">
          <li><a href="../index.php">Home</a></li>
          <li><a href="../all_products.php">All Products</a></li>
          <li><a href="my_account.php">My Account</a></li>
          <?php
          if(!isset($_SESSION['customer_email'])){
         echo "<li><a href='../user_register.php'>Sign Up</a></li>";
          }
          ?>
          <li><a href="../cart.php">Shopping Cart</a></li>
          <li><a href="../contact.php">Connect Us</a></li>
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
            Manage Account:
          </div>
          <ul id="cats">
           <?php
              @$customer_session=$_SESSION['customer_email'];
              $get_customer_pic="select * from customers where customer_email='$customer_session'";
              $run_customer=mysqli_query($connection,$get_customer_pic);
              $row_customer=mysqli_fetch_array($run_customer);
              $customer_pic=$row_customer['customer_image'];
              echo "<img src='customer_photos/$customer_pic' width='150' height='150'>";
           
              ?>
            <li><a href="my_account.php?my_orders">My Orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
            <li><a href="my_account.php?change_pass">Change Password</a></li>
            <li><a href="my_account.php?delete_account">Delete Account</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
      </div>
      
      <div class="right_content">
          <div class="headline">
              <div class="headline_content">
                <span>
                 <?php
                  if(isset($_SESSION['customer_email'])){
                    echo "<b>Welcome: </b>"."<b style='color:yellow'>". $_SESSION['customer_email'] ."</b>";  
                  }
                 
                   if(!isset($_SESSION['customer_email'])){
                 echo "<a href='../checkout.php' style='color:#F93'> Login</a>";
                  }
                  else
                  {
                      echo "<a href='../logout.php' style='color:#F93'> Logout</a>";
                 }
                      ?>
                 </span>
              </div>
          </div>
          <!---product box---->
          <div>
             <h2 style="background:#000;color:#fc9;padding:20px;text-align:center;border-top:2px solid #fff;font-size: 24px;">Manage Your Account here</h2>
          <?php   getDefault(); //--this function is defined in function folder file inn coutomer folder--
              
              ?> 
          <?php
              if(isset($_GET['my_orders'])){
                  include("my_orders.php");
              }
              if(isset($_GET['edit_account'])){
                  include("edit_account.php");
              }
               if(isset($_GET['change_pass'])){
                  include("change_pass.php");
              }
                if(isset($_GET['delete_account'])){
                  include("delete_account.php");
              }
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

<?php } ?>