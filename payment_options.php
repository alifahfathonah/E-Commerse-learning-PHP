
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Payment option</title>
 </head>
 <body>
     <div align="center" style="padding:20px">
   <h2>Payment Option for you </h2>
   <?php
         $ip=getRealIpAddr();
         $get_customer="select * from customers where customer_ip='$ip'";
         $run_customer=mysqli_query($connection,$get_customer);
             $customer=mysqli_fetch_array($run_customer);
         $customer_id=$customer['customer_id'];
    ?>
    <?php
          //-getting product price and number of items for paypal----
    $i=0;
      $ip_add=getRealIpAddr();
    $total=0;
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price=mysqli_query($connection,$sel_price);
    $status='pending';
    $invoice_no=mt_rand(); ///generating a randam number--
    $count_pro=mysqli_num_rows($run_price); //---counting products--
    while($record=mysqli_fetch_array($run_price)){
        $pro_id=$record['p_id'];
        $pro_qty=$record['qty'];
        $pro_price="select * from products where product_id='$pro_id'";
        $run_pro_price=mysqli_query($connection,$pro_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_name=$p_price['product_title'];
            $product_id=$p_price['product_id'];
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total +=$values; 
            $i++;
        }
    }
         ?>
    <!--paying online by paypel----->
    <b>Pay With Paypal</b>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post"><!--for testing "https://www.sandbox.paypal.com/cgi-bin/webscr"-with test id---->
     <input type="hidden" name="business" value="seller@designerfotos.com"> <!--to this email payment will be transfered----->

  <!-- Saved buttons use the "secure click" command -->
  <input type="hidden" name="cmd" value="_s-xclick">
  
  <!-- details about the item  -->
  <input type="hidden" name="item_name" value="<?php echo $product_name ?>">
  <input type="hidden" name="item_number" value="<?php echo $product_id ?>">
   <input type="hidden" name="quantity" value="<?php echo $pro_qty ?>">
  <input type="hidden" name="amount" value="<?php echo $total ?>">
  <input type="hidden" name="currency_code" value="USD">

<!-- Saved buttons are identified by their button IDs -->
  <input type="hidden" name="hosted_button_id" value="221">
  
  <!-----return amd cancel_return---->
<input type="hidden" name="return" value="http://www.myshop.com/paypal_success.php">
<input type="hidden" name="cancel_return" value="http://www.myshop.com/paypal_cancel.php">

<!-- Saved buttons display an appropriate button image. -->
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
  <img alt="" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
    
    
    

    <!---end----->
    <a href="order.php?c_id=<?php echo $customer_id ?>">Pay Offline</a>
  <br>  <b>If you selected 'pay offline' option then please check your email or account to find the invoice number for your order</b>
</div>
 </body>
 </html>
  