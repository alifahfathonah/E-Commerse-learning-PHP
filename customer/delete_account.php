<?php 
@session_start();
if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
}
else
{
?>
   <form action="" method="post">
    <table align="center" width="600">
        <tr align="center">
            <td colspan="2">
                <h2>Do you really want to delete your account?</h2>
            </td>
        </tr>
  <tr align="center">
            <td>
              <input type="submit" name="yes" value="Yes, i want to delete this account">
              <input type="submit" name="no" value="No, i do not want to delete this account">
            </td>
        </tr>
    </table>
</form>
<?php
include('includes/db.php');
@$c=$_SESSION['customer_email'];
if(isset($_POST['yes'])){
    $delete_customer="delete from customers where customer_email='$c'";
    $run_delete=mysqli_query($connection,$delete_customer);
    if($run_delete){
        session_destroy();
        echo "<script>alert('Your account has been deleted!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if(isset($_POST['no'])){
     echo "<script>window.open('my_account.php','_self')</script>";
}}
?>