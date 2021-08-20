<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>
<!DOCTYPE html>
<html>
<head>


<script src="jquery-3.2.1.slim.min.js"></script>
<script src="bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<title>Car Rental</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">Car Rental</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="/">Home</a>
      <a class="nav-item nav-link" href="/store.php">Store</a>
      <a class="nav-item nav-link" href="/products_ordered.php">Orders</a>
      <?php
      if($_SESSION["username"] == "admin")
      {
        echo "<a class='nav-item nav-link active' href='/add.php'>Add</a>";        
      }
      ?>
      <?php
      if($_SESSION["username"] == "admin")
      {
        echo "<a class='nav-item nav-link' href='/delete.php'>Delete</a>";        
      }
      ?>
      <a class="nav-item nav-link" href="/logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="mainpage">
    <h2 class="aligntextcenter whitecolor">Enter Details of New Car</h2>
    <br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype="multipart/form-data">  
  <div class="aligntextcenter"><span class="whitecolor">Make: </span> <input type="text" name="make" pattern="[a-zA-Z]{2,}" title="Please type characters only of minimum length 2" required></div>
  <br>
  <div class="aligntextcenter"><span class="whitecolor">Model: </span> <input type="text" name="model" pattern="[a-zA-Z0-9]{2,}" title="Please type characters only of minimum length 2" required></div>
  <br>
  <div class="aligntextcenter"><span class="whitecolor">Year: </span> <input type="text" name="year" pattern="[0-9]{4,5}" title="Please type numbers only" required></div>
  <br>
  <div class="aligntextcenter"><span class="whitecolor">Transmission: </span>
  <select name="transmission" id="transmission">
    <option value="Automatic">Automatic</option>
    <option value="Manual">Manual</option>
  </select>
  </div>
  <br>
  <div class="aligntextcenter"><span class="whitecolor">Price/Day: </span> <input type="text" name="priceperday" pattern="[0-9]{2,}" title="Please type numbers only" required></div>
  <br>
  <div class="aligntextcenter"><span class="whitecolor">Image: </span> <input type="file" class="whitecolor" name="photo" id="fileSelect"></div>
  <br>
  
  <div class="aligntextcenter"><input type="submit" name="submit" value="Submit"></div>  
</form>
</div>



</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$conn = mysqli_connect("localhost", "root", "", "carrental");

if($conn === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

    if(in_array($filetype, $allowed)){
        if(file_exists("upload/" . $filename)){
            echo "<span class='whitecolor'>" . $filename . " is already exists.</span>";
        } else{
            move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename);


            
$resetai = "ALTER TABLE carinventory AUTO_INCREMENT = 1";
mysqli_query($conn, $resetai);
$sql = "INSERT INTO carinventory (make, model, year, transmission, priceperday, image) VALUES ('" . $_POST["make"] . "', '" . 
$_POST["model"] . "', '" . $_POST["year"] . "', '" . $_POST["transmission"] . "', '" . 
$_POST["priceperday"] . "', '" . $filename . "')";
mysqli_query($conn, $sql);
mysqli_close($conn);

echo "<script>alert('Car added Successfully');</script>";
        } 
    } else{
        echo "<span class='whitecolor'> Error1: There was a problem uploading your file. Please try again. </span>"; 
    }


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>