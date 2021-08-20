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
<title>Car Rental - Store</title>
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
      <a class="nav-item nav-link active" href="/store.php">Store</a>
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

<div class="mainpage">
<div style="overflow-y: auto;max-height: 70vmin;">

<table>
<tr>
<th>Image</th>
<th>Make</th>
<th>Model</th>
<th>Year</th>
<th>Transmission</th>
<th>Price/Day(CAD)</th>
<th>Buy</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "root", "", "carrental");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
/*  */
$sql = "SELECT id, make, model, year, transmission, priceperday, image FROM carinventory";
$result = $conn->query($sql);

$arr = array();
$sessionindex = 1;

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{
array_push($arr,$row["image"]);
array_push($arr,$row["make"]);
array_push($arr,$row["model"]);
array_push($arr,$row["year"]);
array_push($arr,$row["transmission"]);
array_push($arr,$row["priceperday"]);
$_SESSION['s'.$sessionindex] = $arr;
$arr = array();
$sessionindex++;
echo "<form method='post' action='/checkout.php'><tr style='border: 1px solid black;border-collapse: collapse;'><td><img style='width: 12vw;' src='upload/" . $row["image"]. "'></td><td>" . $row["make"] . 
"</td><td>" . $row["model"] . "</td><td>" . $row["year"] . "</td><td>" . $row["transmission"] . "</td><td>" . 
$row["priceperday"] . "</td><td><input type='submit' style='border-radius: 6px !important; height: 37px !important; box-shadow:0px -1px 10px rgba(0,0,0,0.5), 0px 1px 10px rgba(0,0,0,0.7); background-color: black !important; border-color: #00339e !important;' class='btn btn-success storebutton' name='button" . $row["id"] ."' value='Buy'></td></tr></form>";
}
$_SESSION["records"] = $sessionindex;
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</div>
</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>