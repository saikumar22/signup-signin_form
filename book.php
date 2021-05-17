<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>welcome</title>
    <style>
        .btn-sm{
            margin: -30px 0px 0px 95%;
        }
        h3{
            margin-top: 20px;
            color:red;
        }
    </style>
</head>
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
<body>
    <div class="container">
    <h3> Welcome <?=$_SESSION["name"]?></h3>
   <button class="btn btn-success btn-sm" onclick="window.location.href='logout.php'" name="logout">Logout</button>
    <br>
      <div class="edit">
        <?php
          $con = mysqli_connect('localhost', 'root', '', 'wealus');
          if (isset($_GET['edit'])) {
            $bookid = $_GET['bookid'];
            $sql = "SELECT * FROM `book` WHERE bookid='$bookid'";
            $result = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($result);
        // print_r($data);
        ?>  
        <form action="#" method="post">
          <h3>Update</h3><br>
          <label>Name:</label>
          <input type="text" name="name" value='<?= $data['name']?>'><br><br>
          <label>Price:</label>
          <input type="number" name="price"  value='<?= $data['price']?>'><br><br>
          <a href=""><button class="btn btn-success btn-lg" name="update">Update</button></a>
        </form>
      <?php
        if (isset($_POST['update'])) {
            $bookid = $_GET['bookid'];
            $bname = $_POST['name'];
            $bprice = $_POST['price'];

            $con = mysqli_connect('localhost', 'root', '', 'wealus');
            $sql2 = "UPDATE `book` SET `name`='$bname', `price`='$bprice' WHERE bookid='$bookid'";
            echo "$sql2";
            $result = mysqli_query($con, $sql2);

            if ($result) {
                echo "success";
                header("Location: book.php");
            }
        }
      } else {
        ?> 
        <div class="row">
          <div class="col-4">
            <h1>Book</h1><br>
            <form action="#" method="POST">
              <label>Book Name:</label>
              <input type="text" name="name" required><br><br>
              <label>Book Price:</label>
              <input type="number" name="price"><br><br>
              <input type="text" name="userid" hidden value ="<?=$_SESSION["userid"]?>">
              <a href=""><button class="btn btn-success btn-lg" name="submit">submit</button></a>
            </form>
          </div>

          <div class="col-8">
          <?php
          $con = mysqli_connect('localhost', 'root', '', 'wealus');
          if (isset($_POST['submit'])) {
              $bname = $_POST['name'];
              $bprice = $_POST['price'];
              $uid=$_POST['userid'];
              $sql = "INSERT INTO `book`(`name`,`price`,`userid`) VALUES ('$bname','$bprice','$uid')";
              $result = mysqli_query($con, $sql);
              if ($result) {
                  $message = 'Success';
              }
          }
          ?>
        <?php } ?>
          <h1> List </h1><br>
          
          <?php
          $con = mysqli_connect('localhost', 'root', '', 'wealus');
          $uid=$_SESSION["userid"];
          $sql3="SELECT * from book WHERE userid='$uid'";
          $result = mysqli_query($con,$sql3);
          echo "<table class='table'>";
          echo '<tr><td>ID</td><td>Name</td><td>Price</td><td>Edit</td><td>Delete</td></tr>';
          while ($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
              echo '<tr><td>' .
                  $row['bookid'] .
                  '</td><td>' .
                  $row['name'] .
                  '</td><td>' .
                  $row['price'];
              echo '</td><td><a href='.'book.php?edit=1&bookid='.$row['bookid']."><button class='btn btn-primary'>Edit</button></a>
                    </td><td><a href=" .'book.php?delete=1&bookid=' .$row['bookid'] ."><button class='btn btn-danger'>Delete</button></a></td></tr>";
          }
          echo '</table>';
          ?>
          <div class="delete">
            <?php if (isset($_GET['delete'])) {
                $bookid = $_GET['bookid'];
                $con = mysqli_connect('localhost', 'root', '', 'wealus');
                $sql = "DELETE FROM book WHERE bookid='$bookid'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo 'deleted success';
                    header('Location: book.php');
                  }
                } ?>
          </div>
        </div>
      </div>
    </div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>