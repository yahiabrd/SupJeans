<?php
if(isset($_SESSION['user'])){
?>
<div id="profile">
	<?php
		if(isset($_POST['currentPassword'], 
			$_POST['newPassword'], 
			$_POST['confirmationPassword']) 
			&& !empty($_POST['currentPassword'])
			&& !empty($_POST['newPassword'])
			&& !empty($_POST['confirmationPassword'])){

			if($user->verifPassword($_POST['currentPassword'])){
				if($_POST['newPassword'] == $_POST['confirmationPassword']){
					echo '<div class="alert alert-success" role="alert">
	  					You have successfully changed your password
					</div>';
					$user->updateSecurityInformations($_POST['newPassword']);
				}else{
					echo '<div class="alert alert-danger" role="alert">
	  					The confirmation password is incorrect
					</div>';
				}
			}else{
				echo '<div class="alert alert-danger" role="alert">
	  				Your current password is incorrect
				</div>';
			}
		}
	?>
	<h3>Personal Infos</h3>
	<div class="form-group">
		<input type="text" class="form-control" value="<?=$user->getLastName();?>" disabled="disabled">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" value="<?=$user->getFirstName();?>" disabled="disabled">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" value="<?=$user->getEmail();?>" disabled="disabled">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" value="<?=$user->getBillingAddress();?>" disabled="disabled">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" value="<?=$user->getDeliveryAddress();?>" disabled="disabled">
	</div>

	<h3>Security Infos</h3>
		<form method="post" action="">
		<div class="form-group">
			<input type="password" class="form-control" name="currentPassword" placeholder="Current password">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="newPassword" placeholder="New password">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="confirmationPassword" placeholder="Confirmation password">
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>

<?php
}else{
	header('location:index.php');
}