<?php
$con=mysqli_connect("localhost","root","","wealus");
if(isset($_POST["signup"])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $mobile=$_POST['mobile'];

$sql="INSERT INTO `users_details` (`name`, `email`, `password`, `mobile`) VALUES ('$name','$email','$password','$mobile')";
$result = mysqli_query($con,$sql);
if($result){
    echo "Register successful<br>";
    header("refresh: 2; url = signin.html");
}
}
?>