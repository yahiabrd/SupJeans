<?php
$products = new Products();
if(isset($_GET['addCart'], $_GET['p']) && is_numeric($_GET['p']) && !empty($_GET['p'])){
	if(isset($_SESSION['user'])){
		$products->setId($_GET['p']);
		if($products->checkIsProductExist()){
			array_push($_SESSION['cart'], $_GET['p']);
			echo '<div id="addCart" class="alert alert-success alertCart" role="alert">
					You have been successfully added this product to your cart
			</div>';
		}
	}else{
		echo '<div id="addCart" class="alert alert-danger alertCart" role="alert">
					You need to log in for add product to your cart
			</div>';
	}
}else{
?>

<div class="categories">
	<div class="row">Categorie : 
		<?php
			$categories = new Categories();
			$categories->setId(1);
			$categories->listCategorieName();
		?>
	</div>
</div>

<div id="productsJ" class="products">
	<?php
		if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
			$products->setId($_GET['id']);
			$products->listProductById();
		}else{
			$products->listAllProducts();
		}
	?>
</div>
<?php
}