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
      <a class="nav-item nav-link active" href="/">Home</a>
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

<div class="mainpage">
<h1 class="whitecolor"  style="width:100%;text-align:center">Welcome to Car Rental</h1><br><br>
<h4 class="whitecolor"  style="width:100%;text-align:center">
Find the best car rental deal, whether for a quick road trip or just driving around the city. Search and compare prices from hundreds of cars for thousands of destinations worldwide. Then book directly with us of your car choice. Fast, easy and reliable.
</h4>
</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>