<?php
//page pour rafraichir la quantité des produits dans le panier
session_start();
echo " <a href='cart.php' class='cartText'><img src='images/icons/cart.png' id='cart'> (".sizeof($_SESSION['cart']).")</a> - <a href='logout.php'>Log out</a>";