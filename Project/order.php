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
<title>Car Rental - Order</title>
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
        echo "<a class='nav-item nav-link' href='/add.php'>Add</a>";        
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

<br>

<div class="container">
<h2 style="width:100%;text-align:center"  class='whitecolor'>Car Booked</h2>
<br>

<div class="dividedcolumn">
<div class="container">
<div class="bg-light p-5 rounded">
<?php
$conn = mysqli_connect("fdb16.awardspace.net", "3224160_carrental", "Rental@123", "3224160_carrental");

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$finalprice = intval(intval($_POST["days"]) * intval($_SESSION["price"]));
$sql = "INSERT INTO carinventoryorder (make, model, year, price, days, finalprice, username, image, payment, address, firstname, lastname) VALUES 
('" . $_SESSION["make"] . "', '" . $_SESSION["model"] . "', '" . $_SESSION["year"] . "', '" . $_SESSION["price"] . "', '" . 
$_POST["days"] . "', '" . $finalprice . "', '" . $_SESSION["username"] . "', '" . $_SESSION["image"] . "', '" . $_POST["paymentoption"] . "', '" . $_POST["address"] . "', '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "')";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "<img style='width: 100%;' src='upload/" . $_SESSION["image"] . "'>";
?>
</div>
</div>
</div>

<div class="dividedcolumn">
<div class="container">
<div class="bg-light p-5 rounded" style="padding: 2rem 3rem!important;">
<?php
echo "<p class='lead'>First Name: " . $_POST["firstname"] . "</p>";
echo "<p class='lead'>Last Name: " . $_POST["lastname"] . "</p>";
echo "<p class='lead'>Address: " . $_POST["address"] . "</p>";
echo "<p class='lead'>Make: " . $_SESSION["make"] . "</p>";
echo "<p class='lead'>Model: " . $_SESSION["model"] . "</p>";
echo "<p class='lead'>Year: " . $_SESSION["year"] . "</p>";
echo "<p class='lead'>Number of Days: " . $_POST["days"] . "</p>";
echo "<p class='lead'>Payment Option: " . $_POST["paymentoption"] . "</p>";
echo "<p class='lead'>Total Price: " . intval(intval($_POST["days"]) * intval($_SESSION["price"])) . " CAD</p>";
?>
</div>
</div>
</div>

</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>