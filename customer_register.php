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
          <div>
            <form action="customer_register.php" method="post" enctype="multipart/form-data">
                <table width="750" align="center">
                    <tr align="center">
                        <td colspan="5">
                            <h2>Create an Account</h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Customer Name: </b></td>
                        <td><input type="text" name="c_name" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Email: </b></td>
                        <td><input type="text" name="c_email" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Password: </b></td>
                        <td><input type="password" name="c_pass" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Country: </b></td>
                        <td><select name="c_country" required>
                        <option>Select a Country</option>
                        <option>India</option>
                        <option>Pakisthan</option>
                        <option>Irak</option>
                        <option>America</option>
                        <option>Africa</option>
                        <option>Jpana</option>
                        <option>nepal</option>
                        <option>other</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer City: </b></td>
                        <td><input type="text" name="c_city" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Mobile no.: </b></td>
                        <td><input type="text" name="c_contact" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Address: </b></td>
                        <td><input type="text" name="c_address" required></td>
                    </tr>
                     <tr>
                        <td align="right"><b>Customer Imgae: </b></td>
                        <td> <input type="file" name="c_image" required></td>
                        
                    </tr>
                    
                    <tr align="center">
                        <td colspan="8">
                            <input type="submit" name="register" value="Submit">
                        </td>
                    </tr>
                </table>
            </form>
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

<?php
if(isset($_POST['register'])){
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];
    
    $c_ip=getRealIpAddr();
    
    $customer_insert="insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) values('$c_name','$c_email','$c_pass','$c_country','$c_city',' $c_contact','$c_address','$c_image','$c_ip')";
    $run_customer=mysqli_query($connection,$customer_insert);
 move_uploaded_file( $c_image_tmp,"customer/customer_photos/$c_image");
    $sel_cart="select * from cart where ip_add='$c_ip'";
    $run_cart=mysqli_query($connection,$sel_cart);
     $check_cart=mysqli_num_rows($run_cart);
    if($check_cart>0){
        $_SESSION['customer_email']=$c_email;
        echo "<script>alert('Account havebeen created sucessfully, Thank You!')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
}
    else
    {
         $_SESSION['customer_email']=$c_email;
        echo "<script>alert('Account havebeen created sucessfully, Thank You!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>
