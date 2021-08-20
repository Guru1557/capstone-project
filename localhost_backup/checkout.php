<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyBEmUdjdkhKTvFnw-b2aXB8HGxC5HAUjI8">
</script>
<script type="text/javascript">
function initialize() {
  var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById("address")), {
        types: ['geocode'],
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script src="bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="styles.css">


<script src="jquery-3.2.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<title>Car Rental - Checkout</title>



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


<div class="checkoutrow">
<div class="dividedcolumn">
<div class="container">
<div class="bg-light p-5 rounded">
<?php

$button = 0;

for ($x = 1; $x <= $_SESSION['records']-1; $x++)
{
if(array_key_exists('button'.$x, $_POST))
{
    $button = $x;
} 
}

echo "<img style='width: 100%;' src='upload/" . $_SESSION['s'.$button][0] . "'>";

$_SESSION["image"] = $_SESSION['s'.$button][0];
$_SESSION["make"] = $_SESSION['s'.$button][1];
$_SESSION["model"] = $_SESSION['s'.$button][2];
$_SESSION["year"] = $_SESSION['s'.$button][3];
$_SESSION["price"] = $_SESSION['s'.$button][5];
?>

</div>
</div>
  </div>
  <div class="dividedcolumn">
    <div class="container">
      <?php
      echo "<h3 class='whitecolor'>" . $_SESSION['s'.$button][1] . "</h3>";
      echo "<h4 class='lead whitecolor'>" . $_SESSION['s'.$button][2] . "</h4>";
      echo "<h4 class='lead whitecolor'>Year: " . $_SESSION['s'.$button][3] . "</h4>";
      echo "<h4 class='lead whitecolor'>Price/Day: " . $_SESSION['s'.$button][5] . "$</h4>";
      ?>
  <form method='post' action='/order.php'>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" name="firstname" placeholder="First name" required="required" pattern="[A-Za-z]{1,30}" title="Only alphabets are allowed!" style="width: 100% !important;">
    </div>
    <div class="col">
      <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required" pattern="[A-Za-z]{1,30}" title="Only alphabets are allowed!" style="width: 100% !important;">
    </div>
  </div>
  <br>

  <h4 class='whitecolor'>Address</h4>
  <div>
      <input type="text" name="address" id="address" style="height:37px;width: 100%;" placeholder="Address" required="required"  title="Only alphabets and numbers are allowed!">
  </div>
  <br>

  <select class="form-control" name="paymentoption">
  <option>Cash on Delivery</option>
  <option>Bank Transfer</option>
  </select>
  <br>


  <div class="row">
    <div class="col">
  <h4 class='whitecolor'>Days Required</h4>
  <script>
    function convertfinalprice()
    {
      if(document.getElementById('days').value>=1)
      {
      document.getElementById('finalprice').innerHTML = document.getElementById('days').value * <?php echo "".$_SESSION['s'.$button][5] ?>;
      }
      else
      {
        document.getElementById('finalprice').innerHTML = "Enter Valid Value";
      }
    }
  </script>
  <input type="number" class="form-control" name="days" id="days" style="max-width: 50%;" onkeyup="convertfinalprice()" onclick="convertfinalprice()"  placeholder="Days" required="required" pattern="[1-9]\d*" min="1" max="90" value=1 title="Only numbers are allowed!">
  <br>
</div>
<div class="col">
  <h4 class='whitecolor'>Final Price(CAD)</h4>
  <p id="finalprice" name="finalprice" class="form-control"></p>
</div>
</div>

  <input type="submit" class='btn btn-success' name="order" value="Order" />
</form>
</div>
  </div>
</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>