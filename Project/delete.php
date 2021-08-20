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
        echo "<a class='nav-item nav-link active' href='/delete.php'>Delete</a>";        
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
<th>Delete</th>
</tr>
<?php
$conn = mysqli_connect("fdb16.awardspace.net", "3224160_carrental", "Rental@123", "3224160_carrental");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, make, model, year, transmission, priceperday, image FROM carinventory";
$result = $conn->query($sql);

$sessionindex = 1;

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{
$sessionindex++;
echo "<form method='post' action='/delete.php'><tr><td><img style='width: 12vw;' src='upload/" . $row["image"]. "'></td><td>" . $row["make"] . 
"</td><td>" . $row["model"] . "</td><td>" . $row["year"] . "</td><td>" . $row["transmission"] . "</td><td>" . 
$row["priceperday"] . "</td><td><input type='submit' class='btn btn-success storebutton' name='button" . $row["id"] ."' value='Delete'></td></tr></form>";
}
$_SESSION["records"] = $sessionindex;
echo "</table>";
} else { echo "0 results"; }


for ($x = 1; $x <= $_SESSION['records']-1; $x++)
{
if(array_key_exists('button'.$x, $_POST))
{
	$deletesql = "DELETE FROM carinventory WHERE id = " . $x . ";";
	$conn->query($deletesql);
	echo "<script>window.location.reload();</script>";
} 
}

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