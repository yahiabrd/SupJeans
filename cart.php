<?php
$title = "Cart";
include("includes/header.php");

if(isset($_SESSION['user'])){

	if(isset($_GET['clear'])){
		unset($_SESSION['cart']);
		$_SESSION['cart'] = array();
		echo '<div class="alert alert-success alertCart" role="alert">
					You have been successfully clear your cart
			</div>';
	}elseif(isset($_GET['pay'])){
		echo '<div class="alert alert-success alertCart" role="alert">
					You have been successfully pay your products
			</div>';
		$transactions = new Transactions();
		foreach($_SESSION['cart'] as $cart){
			$transactions->setId($cart);
			$transactions->setUserId($user->getId());
			$transactions->addTransaction();
		}
		unset($_SESSION['cart']);
		$_SESSION['cart'] = array();
	}elseif(isset($_GET['history'])){
		echo '<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Ref</th>
				      <th scope="col">Product Name</th>
				      <th scope="col">Price</th>
				      <th scope="col">Product Image</th>
				    </tr>
				  </thead>
				  <tbody>';

				  $transactions = new Transactions();
				  $transactions->getTransactionsById($user->getId());

		echo '</tbody>
				</table>';

	}else{

		echo "<div id='history'><a href='?history'>View transactions history</a></div>";
		echo '<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Ref</th>
				      <th scope="col">Product Name</th>
				      <th scope="col">Price</th>
				      <th scope="col">Product Image</th>
				    </tr>
				  </thead>
				  <tbody>';

		$cart = new Cart();
		for($i = 0; $i < sizeof($_SESSION['cart']); $i++){
			$cart->setId($_SESSION['cart'][$i]);
			$cart->listAllCarts();
		}


		echo '</tbody>
				</table>';

		echo '<div class="butt">
				<a href="?pay"><button type="button" class="btn btn-success">Pay</button></a>
				<a href="?clear"><button type="button" class="btn btn-danger">Clear the cart</button></a>
			</div>';
	}
}else{
	header('location:index.php');
}

include("includes/footer.php");