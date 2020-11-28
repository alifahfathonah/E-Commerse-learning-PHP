<?php
include("./includes/db.php");

//---function for getting ip address
function getRealIpAddr(){
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    //--check ip from share internet
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //--to check ip pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//---end ip functoin---
//-----creating the script for adding product for cart
function cart(){
if(isset($_GET['add_cart'])){
    global $connection;
    $p_id=$_GET['add_cart'];
    $ip_id=getRealIpAddr();
    $check_pro="select * from cart where ip_add='$ip_id' AND p_id='$p_id' ";
    $run_check=mysqli_query($connection,$check_pro);
    if(mysqli_num_rows($run_check)>0){
        echo "<script>alert('This product is already added in your cart')</script>";
    }
    else
    {
       //----------------
        $query="select * from products where product_id='$p_id'";
        $run=mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($run)){
            $product_price=$row['product_price'];
        }
        //-------------
$q="insert into cart (p_id,ip_add,qty,total_price_qty) values ('$p_id','$ip_id','1','$product_price') ";
        if($run_q=mysqli_query($connection,$q)){
            echo "<script>alert('Your Product hasbenn added into cart successfully')</script>";
        }
        else{
            echo mysqli_error($connection);
        }
    }
}
}
//---end card----
//--getting the total number of items from the cart---
function items(){
    global $connection;
      $ip_id=getRealIpAddr();
    if(isset($_GET['add_cart'])){
        $get_items="select * from cart where ip_add='$ip_id' ";
        $run_items=mysqli_query($connection,$get_items);
        $count_items=mysqli_num_rows($run_items);
    }
    else{
     $get_items="select * from cart where ip_add='$ip_id' ";
        $run_items=mysqli_query($connection,$get_items);
        $count_items=mysqli_num_rows($run_items);
}
    echo  $count_items;
}
//---end ---------
//---getting the price of items from the cart---
function total_price(){
    $total1=0;
     global $connection;
    $ip_add=getRealIpAddr();
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price=mysqli_query($connection,$sel_price);
    while($record=mysqli_fetch_array($run_price)){
        $total_price_qty1=$record['total_price_qty'];
        $total1=$total1+$total_price_qty1;
    }
    echo $total1;
    
   /*---------------------------------------------------------------
   $ip_add=getRealIpAddr();
    $total=0;
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price=mysqli_query($connection,$sel_price);
    while($record=mysqli_fetch_array($run_price)){
        $pro_id=$record['p_id'];
        $pro_price="select * from products where product_id='$pro_id'";
        $run_pro_price=mysqli_query($connection,$pro_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total +=$values;       //----$total=$total+$product_price; we can write it                                    also without array function  here--------//
           
        }
    }
    echo $total;
     ------------------------------------------*/
}
//---end ---------
//---all catagery
function getPro(){
    global $connection;  //we have to make globle connection var with using any function 
    if(!isset($_GET['cat'])){
    if(!isset($_GET['brand'])){
     $get_products="select * from products order by rand() limit 0,6";
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
    }
}
//---end
//---filtring by catagery
function getCatPro(){
    global $connection;  //we have to make globle connection var with using any function 
    if(isset($_GET['cat'])){
        $cat_id=$_GET['cat'];
     $get_cat_pro="select * from products where cat_id='$cat_id' ";
              $run_cat_pro=mysqli_query($connection,$get_cat_pro);
        $count=mysqli_num_rows($run_cat_pro);
        if($count==0){
            echo "<h2>No product found in this category.</h2>";
        }
              while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
                  $pro_id=$row_cat_pro['product_id'];
                  $pro_title=$row_cat_pro['product_title'];
                  $pro_cat=$row_cat_pro['cat_id'];
                  $pro_brand=$row_cat_pro['brand_id'];
                  $pro_desc=$row_cat_pro['product_desc'];
                  $pro_price=$row_cat_pro['product_price'];
                  $pro_image=$row_cat_pro['product_img1'];
                  
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
    }

//----end 
//---filtring by brands
function getBrandPro(){
    global $connection;  //we have to make globle connection var with using any function 
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
     $get_brand_pro="select * from products where brand_id='$brand_id' ";
              $run_brand_pro=mysqli_query($connection,$get_brand_pro);
        $count=mysqli_num_rows($run_brand_pro);
        if($count==0){
            echo "<h2>No product found of this brand</h2>";
        }
              while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
                  $pro_id=$row_brand_pro['product_id'];
                  $pro_title=$row_brand_pro['product_title'];
                  $pro_cat=$row_brand_pro['cat_id'];
                  $pro_brand=$row_brand_pro['brand_id'];
                  $pro_desc=$row_brand_pro['product_desc'];
                  $pro_price=$row_brand_pro['product_price'];
                  $pro_image=$row_brand_pro['product_img1'];
                  
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
    }

//----end 
//--category block
function getCats(){
     global $connection;  //we have to make globle connection var with using any function 
      $get_cats="select *  from categories";
              $run_cats=mysqli_query($connection,$get_cats);
              while($row_cats=mysqli_fetch_array($run_cats)){
                  $cat_id=$row_cats['cat_id'];
                  $cat_title=$row_cats['cat_title'];
              echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
                  }
}
//---end
//---brand block--

function getBrands(){
     global $connection;  //we have to make globle connection var with using any function 
     $get_brands="select *  from brands";
              $run_brands=mysqli_query($connection,$get_brands);
              while($row_brands=mysqli_fetch_array($run_brands)){
                  $brand_id=$row_brands['brand_id'];
                  $brand_title=$row_brands['brand_title'];
              echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
                  }
}//----end---
?>
