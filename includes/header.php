<?php
session_start();
include "class/classPack.php";

if(empty($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

if(isset($_SESSION['user'])){
	$user = new user();
	$user = unserialize($_SESSION["user"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= isset($title) ? "SupJeans : ". $title : "SupJeans" ?></title>
	<link rel="icon" type="image/png" href="images/jeans.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body onload="slide();">
	<div class="container-fluid">
		<div class="container">
			<header>
				<a href="index.php">SupJeans</a>
			</header>

			<div id="account">
				<?php if(isset($_SESSION['user'])) { 
					if($user->getRole() == 1){
						echo "<span class='admin'><a href='admin.php'>Administration</a></span>";
					}
					echo "<a href='profile.php' class='profile'>". $user->getEmail()."</a> - ";
					echo '<div id="cartList">';
					echo "<a href='cart.php' class='cartText'><img src='images/icons/cart.png' id='cart'> (".sizeof($_SESSION['cart']).")</a> - <a href='logout.php'>Log out</a>"; 
					echo '</div>';

				} else { ?>
				<a href="login.php">Log in</a> / <a href="register.php">Register</a>
				<?php } ?>
			</div>

			<div class="search">
				<form method="post" action="search.php">
					<input type="text" name="search" placeholder="Search products">
					<input type="image" src="images/icons/wen.png" id="imgsearch">
				</form>
			</div>
