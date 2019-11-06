<form method="post" action="" class="form">
	<div class="form-group">
		<input type="text" name="lastName"  value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : '' ?>" class="form-control" placeholder="Last name" required>
	</div>
	<div class="form-group">
		<input type="text" name="firstName"  value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>" class="form-control" placeholder="First name" required>
	</div>
	<div class="form-group">
		<input type="email" name="email"  value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" class="form-control" placeholder="Enter email" required>
	</div>
	<div class="form-group">
		<input type="text" name="billingAddress"  value="<?= isset($_POST['billingAddress']) ? $_POST['billingAddress'] : '' ?>" class="form-control" placeholder="Billing address" required>
	</div>
	<div class="form-group">
		<input type="text" name="deliveryAddress"  value="<?= isset($_POST['deliveryAddress']) ? $_POST['deliveryAddress'] : '' ?>" class="form-control" placeholder="Delivery address" required>
	</div>
	<div class="form-group">
		<input type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"  class="form-control" placeholder="Password" required>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>