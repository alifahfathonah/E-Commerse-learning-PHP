<?php
@session_start();
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}
else
{
?>
   <form action="" method="post">
    <table align="center" width="500">
        <tr align="center">
            <td colspan="5"><h2>Change Your Password</h2></td>
        </tr>
        <tr>
            <td align="right">Enter Current Password: </td>
            <td><input type="password" name="old_pass" required></td>
        </tr>
        <tr>
            <td align="right">Enter New Password: </td>
            <td><input type="password" name="new_pass" required></td>
        </tr>
        <tr>
            <td align="right">Enter Current Password Again: </td>
            <td><input type="password" name="new_pass_again" required></td>
        </tr>
        <tr align="center">
            <td colspan="5"><input type="submit" name="change_pass" value="Change Password"></td>
        </tr>
    </table>
</form>
<?php
include("includes/db.php");
$c=$_SESSION['customer_email'];
if(isset($_POST['change_pass'])){
    $old_pass=$_POST['old_pass'];
    $new_pass=$_POST['new_pass'];
    $new_pass_again=$_POST['new_pass_again'];
    $get_real_pass="select * from customers where customer_pass='$old_pass'";
    $run_real_pass=mysqli_query($connection,$get_real_pass);
    $check_pass=mysqli_num_rows($run_real_pass);
    if($check_pass==0){
        echo "<script>alert('Your current pasword is not valid, Try Again')</script>";
        exit();
    }
    if($new_pass!=$new_pass_again){
        echo "<script>alert('New Password did not match, Try Again')</script>";
        exit();
    }
    else
    {
        $update_pass="update customers set customer_pass='$new_pass' where customer_email='$c'";
        $run_pass=mysqli_query($connection,$update_pass);
        echo "<script>alert('Your password hasbeen successfully changed!')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }
} }
?>