<?php
$title = "Login";
include("includes/header.php");

if(!isset($_SESSION['user'])){
	if(isset($_GET['success'])){
		echo '<div class="alert alert-success alertS" role="alert">
	  			You have been successfully registered
			</div>';
	}

	if(isset($_POST['email'], 
		$_POST['password'])
		&& !empty($_POST['email'])
		&& !empty($_POST['password'])){

		$user = new User();
		$user->setEmail($_POST["email"]);
		$user->setPassword(sha1($_POST["password"]));

		if ($user->login()){
		    $_SESSION["user"] = serialize($user);
		    header("location:index.php");
		}
		else{
		    echo '<div class="alert alert-danger alertW" role="alert">
	  		Your email or your password are incorrect
			</div>';
		}
	}
}else{
	header('location:index.php');
}

include("includes/login.php");

include("includes/footer.php");