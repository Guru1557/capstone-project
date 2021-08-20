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
<title>Car Rental - Products Ordered</title>
<style>
table {
font-size: 16px !important;
text-align: center !important;
}
</style>
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
      <a class="nav-item nav-link active" href="/products_ordered.php">Orders</a>
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

<div class="mainpage">
<table>
<tr>
<th>Image</th>
<th>Make</th>
<th>Model</th>
<th>Year</th>
<th>Number of Days</th>
<th>Total Price</th>
<th>Payment Method</th>
<th>First Name</th>
<th>Last Name</th>
<th>Address</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "root", "", "carrental");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if($_SESSION["username"] == "admin")
{
$sql = "SELECT image, make, model, year, days, finalprice, payment, firstname, lastname, address FROM carinventoryorder;";
$result = $conn->query($sql);
}
if($_SESSION["username"] != "admin")
{
$sql = "SELECT image, make, model, year, days, finalprice, payment, firstname, lastname, address FROM carinventoryorder where username = '" . $_SESSION["username"] . "';";
$result = $conn->query($sql);
}



if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo "<tr><td><img style='width: 9vw;' src='upload/" . $row["image"]. "'></td><td>" . $row["make"] . "</td><td>" . $row["model"]. "</td><td>" . $row["year"] . "</td><td>" . $row["days"] . "</td><td>" . $row["finalprice"] . "</td><td>" . $row["payment"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["address"] . "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>