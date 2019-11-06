<?php
$title = "Register";
include("includes/header.php");

if(!isset($_SESSION['user'])){
	if(isset($_POST['lastName'], 
		$_POST['firstName'], 
		$_POST['email'], 
		$_POST['billingAddress'], 
		$_POST['deliveryAddress'], 
		$_POST['password'])
		&& !empty($_POST['lastName']) 
		&& !empty($_POST['firstName']) 
		&& !empty($_POST['email']) 
		&& !empty($_POST['billingAddress']) 
		&& !empty($_POST['deliveryAddress']) 
		&& !empty($_POST['password'])){
		
		$user = new User();
		$user->setLastName($_POST['lastName']);
		$user->setFirstName($_POST['firstName']);
		$user->setEmail($_POST['email']);
		$user->setBillingAddress($_POST['billingAddress']);
		$user->setDeliveryAddress($_POST['deliveryAddress']);
		$user->setPassword(sha1($_POST['password']));
		if($user->checkIfMailExist($_POST['email']) == 0){
			$user->register();
			header('location:login.php?success');
		}else{
			echo '<div class="alert alert-danger alertS" role="alert">
	  			This email is already registered
			</div>';
		}
	}
}else{
	header('location:index.php');
}

include("includes/register.php");

include("includes/footer.php");