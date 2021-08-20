<!DOCTYPE html>
<html>
<meta charset="utf-8">
<script src="jquery-3.2.1.slim.min.js"></script>
<script src="bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
require('db.php');
if (isset($_REQUEST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
        $query = "INSERT into `users` (username, password, email)
VALUES ('$username', '".md5($password)."', '$email')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form whitecolor'>
<h3 class='whitecolor'>You are registered successfully.</h3>
<br/><span class='whitecolor'>Click here to </span><a href='login.php' class='whitecolor'>Login</a></div>";
            echo "<script>alert('Successfully Registered');</script>";
            echo "<script>window.location = 'http://localhost/'</script>";
        }
    }
?>


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
    </div>
  </div>
</nav>

<br><br>
<div class="form">
<h1 class="whitecolor">Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>

<nav class="mainfooter navbar navbar-expand-lg navbar-dark bg-primary">
  <p class="aligntextcenter footertext">Made by Ajay, Gurpreet, Tarandeep</p>
</nav>

</body>
</html>
