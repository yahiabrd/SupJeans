<?php
//verification si il est connecté et si il est admin
if(isset($_SESSION['user'])){
	if($user->getRole() == 1){
		$transactions = new Transactions();
		echo '<div id="admin">';
		if(isset($_GET['alltransactions'])){
			echo '<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Ref</th>
				      <th scope="col">From</th>
				      <th scope="col">Product</th>
				      <th scope="col">Date</th>
				    </tr>
				  </thead>
				  <tbody>';

				  
				  $transactions->viewAllTransactions();

			echo '</tbody>
				</table>';

		}elseif(isset($_GET['allmembers'])){
			echo '<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Ref</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col">Billing Address</th>
				      <th scope="col">Delivery Address</th>
				    </tr>
				  </thead>
				  <tbody>';

				  
				  $user->viewAllUsers();

			echo '</tbody>
				</table>';
		}else{
			echo '<a href="?alltransactions" class="view"><h3>View all transactions ('.$transactions->getNbTransactions().')</h3></a>';
			echo '<br><br>';
			echo '<a href="?allmembers" class="view"><h3>View all members ('.$user->getNbUsers().')</h3></a>';
		}
		echo '</div>';
	}else{
		header('location:index.php');
	}
}else{
	header('location:index.php');
}