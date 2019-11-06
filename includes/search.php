<?php
	if(isset($_POST['search']) && !empty($_POST['search'])){
?>

<div class="products searching">
	<?php
		$products = new Products();
		$products->setProductName($_POST['search']);
		if($products->listProductByName()){
			header('location:index.php?id='.$products->getId().'#productsJ');
		}else{
			echo '<div class="alert alert-danger" role="alert">
  				No results for this search
			</div>';
		}
	}else{
		header('location:index.php');
	}
	?>
</div>