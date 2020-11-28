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
             <br>
             <form action="cart.php" method="post" enctype="multipart/form-data">
                 <table width="740" align="center" bgcolor="#0099cc">
                   <tr text-align="center">
                       <td><b>Remove</b></td>
                       <td><b>Product</b></td>
                       <td><b>Quantity</b></td>
                       <td><b>Total Price</b></td>
                   </tr> 
                   <?php
                     //---getting the total price and more info of items from the cart---
      $ip_add=getRealIpAddr();
    $total=0;
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price=mysqli_query($connection,$sel_price);
    while($record=mysqli_fetch_array($run_price)){
        $pro_id=$record['p_id'];
        $pro_qty=$record['qty'];
        $total_price_qty=$record['total_price_qty'];
        $total=$total+$total_price_qty;
        $pro_price="select * from products where product_id='$pro_id'";
        $run_pro_price=mysqli_query($connection,$pro_price);
        $p_price=mysqli_fetch_array($run_pro_price);
            $product_price=$p_price['product_price'];
            $product_title=$p_price['product_title'];
            $product_image=$p_price['product_img1'];
            $only_price=$p_price['product_price'];
           
        //    $values=array_sum($product_price);
           // $total +=$values;            //----$total=$total+$product_price; we can write it                                    also without array function here--------//
      
//---end ---------
                     ?>
                   <tr>
                       <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
                       <td><?php echo $product_title ?><br>
                           <a href='details.php?pro_id=<?php echo $pro_id ?>'> <img src="admin_area/product_images/<?php echo $product_image ?>" height='80' width="80" alt=""></a></td>
       <td>
        <input type="text" size="3" name="qty[]" value='<?php echo $pro_qty ?>'>
        <input type="hidden" name="pro_id[]" value='<?php echo $pro_id ?>'>
                       </td>
                        <td><?php echo $total_price_qty ?></td>
                         <input type="hidden" name="product_price1[]" value='<?php echo $product_price ?>'>
                   </tr>
                     
                     
                   <?php   } ?>
                   <tr>
                       <td colspan="3" align="right"><b>Sub Total:</b></td>
                       <td><b><?php echo $total ?></b></td>
                   </tr>
                   <tr></tr>
                   <tr align="center">
                       <td colspan="2"><input type="submit" name="update" value="Update Cart"></td>
                       <td><input type="submit" name="continue" value="Continue Shopping"></td>
                       <td><button><a href="checkout.php" style="color:#000;text-decoration:none;">Checkout</a></button></td>
                   </tr>
                 </table>
     </form>
         <?php
    function updatecart(){
    global $connection;
              if(isset($_POST['update'])){
                  //----deleting multipale selected checkbox---
                  foreach($_POST['remove'] as $remove_id){
                      $delete_products="delete from cart where p_id='$remove_id' ";
                      $run_delete=mysqli_query($connection,$delete_products);
                      if($run_delete){
                          echo "<script>window.open('cart.php','_self')</script>";
                      }
                  }
              }
              }
                          if(isset($_POST['continue'])){
                                  echo "<script>window.open('index.php','_self')</script>";
                            }
                              echo @$up_cart=updatecart();
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


             

    <?php

 
                          //------adding qty and price with qty into database and cart---
                     
//---getting a product price and id of diffrent product by foreach or array------
if(isset($_POST['update'])){
                           $i=0;
                            foreach($_POST['pro_id'] as $pro_id1){
           //echo $pro_id1;
                                
                                $arr_id[$i]=$pro_id1;
                                $i++;
                                
                            }
                       //    print_r($arr);
                        //   echo $arr[0];
                           
                           $k=0;
                           
                            foreach($_POST['product_price1'] as $product_price2){
           //echo $pro_id1;
                                
                                $arr_price[$k]=$product_price2;
                                $k++;
                                
                            }
                           //--end----
                           
                             $j=0;
                              foreach($_POST['qty'] as $qty){
                                $arr_pro_id=$arr_id[$j];
                                $arr_pro_price=$arr_price[$j];
                           if($qty==0){
                            echo "<script>alert('qty can not be 0 or less than 1')</script>" ;  
                           }
                           else
                           {
                            $total_q= $arr_pro_price*$qty;
     $insert_qty="update cart set qty='$qty',total_price_qty='$total_q' where ip_add='$ip_add' AND p_id='$arr_pro_id'"; //--we can use where p_id='$pro_id' too--
                           $j++;  
                           $run_qty=mysqli_query($connection,$insert_qty);
                          
                           if($run_qty){
                          echo "<script>window.open('cart.php','_self')</script>";
                      }
                           
                       }
                           }
                       }
                           
                           
                       

            //----------------------end----
                       ?>