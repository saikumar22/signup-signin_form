<?php
session_start();
if(isset($_POST["login"])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con=mysqli_connect("localhost","root","","wealus");
    $sql="SELECT * FROM users_details WHERE email='$email' and password='$password'";
    $result = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($result);
if($data){
    $_SESSION["name"]=$data["name"];
    $_SESSION["userid"]=$data["userid"];

   $_SESSION["role"]=$data["role"];
   if($_SESSION["role"]==1){
    header("Location: dashboard.php");
   }else{
    header("Location: book.php");
   }
    
}
else{
    echo "Invalid Email and Password";
    header('Refresh: 2; URL = signin.html');
}   
}
?>
