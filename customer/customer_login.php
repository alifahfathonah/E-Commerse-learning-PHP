<?php
@session_start();

include("includes/db.php");

if(!function_exists("getRealIpAddr")) {
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
} 
?>
<div>
<form action="checkout.php" method="post">
<table width="800" bgcolor="#66cccc" align="center">
<tr align="center">
    <td colspan="4"><h1>Login or Register</h1></td>
</tr>
<tr>
   <td align="right"><b>Your Email:</b></td>
    <td><input type="text" name="c_email" placeholder="Enter Your Email"></td>
</tr>
<tr>
     <td  align="right"><b>Your Password:</b></td>
    <td><input type="password" name="c_pass" placeholder="Passsword"></td>
</tr>
<tr align="center">
    <td colspan="4"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
</tr>
<tr align="center">
    <td colspan="4"><input type="submit" name="c_login" value="Login"></td>
</tr>
</table>
</form>
<?php
    //---forget password---
    if(isset($_GET['forgot_pass'])){
        echo "
        <div align='center'>
<h2><b>Enter your Email below, we will send you your password to your email.</b></h2><br>
<form action='' method='post'>
<input type='text' name='c_email' placeholder='Enter your email' required><br>
<input type='submit' name='forgot_pass1' value='Send Me Password'><br>
</form>
</div>
        ";
        if(isset($_POST['forgot_pass1'])){
            $c_email=$_POST['c_email'];
            $sel_c="select * from customers where customer_email='$c_email'";
            $run_c=mysqli_query($connection,$sel_c);
            $check_c=mysqli_num_rows($run_c);
            $row_c=mysqli_fetch_array($run_c);
            $c_name=$row_c['customer_name'];
            $c_pass=$row_c['customer_pass'];
            if($check_c==0){
                echo "<script>alert('This email does not exist, sorry!')</script>";
        exit();
            }
            else
            {
               $from="admin@mysite.com";
                $subject="Your Password";
                $message="
                <html>
                <h3>Dera $c_name</h3>
                <p>You requested for your password at www.mysite.com</p>
                <b>Your Password is</b><span style='color:red'>$c_pass</span>
                <h3>Thank You for using our wensite.</h3>
                </html>
                ";
                mail($c_email,$subject,$message,$from);
                  echo "<script>alert('Password was sent to your registred email please check your inbox!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            }
        }
        
    }
    //--end forget password--
    ?>
<h1 style="float:left;text-decoration:none;padding:10"><a href="customer_register.php">New Register Here</a></h1>
</div>

<?php
if(isset($_POST['c_login'])){
    $customer_email=$_POST['c_email'];
    $customer_pass=$_POST['c_pass'];
    $sel_customer="select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass' ";
    $run_customer=mysqli_query($connection,$sel_customer);
    $check_customer=mysqli_num_rows($run_customer);
   $get_ip=getRealIpAddr();
    $sel_cart="select * from cart where ip_add='$get_ip'";
    @$run_cart=mysqli_query($connection,$sel_cart);
     @$check_cart=mysqli_num_rows($run_cart);
    if($check_customer==0){
        echo "<script>alert('Password or Email address is incorrect.')</script>";
        exit();
    }
    if($check_customer==1 AND $check_cart==0){
        $_SESSION['customer_email']=$customer_email;
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    }
    else
    {
 $_SESSION['customer_email']=$customer_email;
         echo "<script>alert('You successfully logged in,you can order now!')</script>";
       include("payment_options.php");
    }
}
?>