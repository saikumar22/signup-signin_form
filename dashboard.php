<?php
session_start();
if($_SESSION["role"]==1){?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Admin page</title>
<style>
body {
  font-family: "Lato", sans-serif;
}
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  /* z-index: 1; */
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: red;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.header{
    border-bottom: 3px solid red;
}
.btn-sm{
     margin: -100px 0px 0px 95%;
}
</style>
</head>
<body>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="book.php">Admin View</a>
  <a href="dashboard.php">User Details</a>
  <a href="logout.php">Logout</a>
  <a href="#"></a>
  <a href="#"></a>
</div>
<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
</div>

<div class="container">
    <div class="header">
    <h1>Hello Admin</h1>
    </div>
    <button class="btn btn-success btn-sm" onclick="window.location.href='logout.php'" name="logout">Logout</button>
<?php
 $con = mysqli_connect('localhost', 'root', '', 'wealus');
 $sql4="SELECT * from users_details";
 $result = mysqli_query($con,$sql4);
 echo "<table class='table'>";
 echo '<tr><td>Sno</td><td>User Name</td><td>EMail</td><td>Password</td><td>Mobile</td></tr>';
 $n=1;
 while ($row = mysqli_fetch_assoc($result)) {
   // print_r($row);
     echo '<tr><td>'.$n.'</td><td>' .
        //  $row['userid'] .
        //  '</td><td>' .
         $row['name'] .
         '</td><td>' .
         $row['email'].
         '</td><td>' .
        '******' .
         '</td><td>' .
         $row['mobile'].
         '</td><tr>'; 
         $n++;
        }
 echo '</table>';
?>
</div>
<?php 
//images and video link
 $con = mysqli_connect('localhost', 'root', '', 'wealus');
 $sql4="SELECT * from ad";

 $result = mysqli_query($con,$sql4);
 while($data2= mysqli_fetch_assoc($result))
{
?>
<img src="<?php echo $data2["ad"]; ?>"></img>

<?php }?>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.getElementById("main").style.marginLeft = "200px";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body>
</html>
<?php
   }else{
       echo "error";
    header('Refresh: 1; URL = book.php');
   }
?>