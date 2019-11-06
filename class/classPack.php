<?php
include("includes/database.php");

class User{
	private $id, $lastName, $firstName, $email, $billingAddress, $deliveryAddress, $password, $money, $role;

	public function getId(){
		return $this->id;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getBillingAddress(){
		return $this->billingAddress;
	}

	public function getDeliveryAddress(){
		return $this->deliveryAddress;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getMoney(){
		return $this->money;
	}

	public function getRole(){
		return $this->role;
	}

	public function setUserId($id){
		$this->id = $id;
	}

	public function setLastName($lastName){
		$this->lastName = $lastName;
	}

	public function setFirstName($firstName){
		$this->firstName = $firstName;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setBillingAddress($billingAddress){
		$this->billingAddress = $billingAddress;
	}

	public function setDeliveryAddress($deliveryAddress){
		$this->deliveryAddress = $deliveryAddress;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setRole($role){
		$this->role = $role;
	}

	public function checkIfMailExist($email){
		global $pdo;
		$check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
		$check->execute(array($email));
		return $check->rowcount();
	}

	public function register(){
		global $pdo;
		$register = $pdo->prepare("INSERT INTO users VALUES(NULL, ?,?,?,?,?,?,0)");
		$register->execute(array(
			$this->getLastName(),
			$this->getFirstName(),
			$this->getEmail(),
			$this->getBillingAddress(),
			$this->getDeliveryAddress(),
			$this->getPassword()
		));
	}

	public function login(){
		global $pdo;
        $results = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $results->execute(array(
        	$this->getEmail(),
        	$this->getPassword()
        ));
        $data = $results->fetchAll();
        
        if (sizeof($data) == 1 ){
            
            $this->setUserId($data[0]["id"]);
            $this->setEmail($data[0]["email"]);
            $this->setLastName($data[0]["lastName"]);
            $this->setFirstName($data[0]["firstName"]);
            $this->setBillingAddress($data[0]["billingAddress"]);
            $this->setDeliveryAddress($data[0]["deliveryAddress"]);
            $this->setRole($data[0]["role"]);
            
            return true;
        }
        else
            return false;
        
    }

    public function verifPassword($passwordToVerif){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
		$query->execute(array($this->getId()));
		$data = $query->fetch();
		if($data['password'] == sha1($passwordToVerif)){
			return true;
		}else{
			return false;
		}
	}

    public function updateSecurityInformations($newPassword){
    	global $pdo;
    	$query = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    	$query->execute(array(sha1($newPassword), $this->getId()));
    }

    public function getNbUsers(){
		global $pdo;
		$query = $pdo->query('SELECT * FROM users');
		return $query->rowcount();
	}

	public function viewAllUsers(){
		global $pdo;
		$query = $pdo->query('SELECT * FROM users');
		while($data = $query->fetch()){
			echo '<tr>
			      <th scope="row">'.$data['id'].'</th>
			      <td>'.$data['lastName'].' '.$data['firstName'].'</td>
			      <td>'.$data['email'].'</td>
			      <td>'.$data['billingAddress'].'</td>
			      <td>'.$data['deliveryAddress'].'</td>
			    </tr>';
		}
	}

}


class Categories{

	private $id, $categorieName;

	public function getId(){
		return $this->id;
	}

	public function getCategorieName(){
		return $this->categorieName;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setCategorieName($categorieName){
		$this->categorieName = $categorieName;
	}

	public function listCategorieName(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
		$query->execute(array($this->getId()));
		$data = $query->fetch();
		echo $data['categorieName'];
	}
}

class Products{
	private $id, $productName, $price, $imageName;

	public function getId(){
		return $this->id;
	}

	public function getProductName(){
		return $this->productName;
	}

	public function getPrice(){
		return $this->price;
	}

	public function getImageName(){
		return $this->imageName;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setProductName($productName){
		$this->productName = $productName;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function setImageName($imageName){
		$this->imageName = $imageName;
	}

	public function listAllProducts(){
		global $pdo;
		$query = $pdo->query("SELECT * FROM products ORDER BY id DESC");
		echo '<div class="row">';
		while($data = $query->fetch()){
			?>
				<div class="bloc">
					<a href="?id=<?= $data['id'] ?>#productsJ"><img src="images/<?= $data['imageName'] ?>.png"></a>
					<br> <?= $data['productName'] ?>
				</div>
			<?php
		}
		echo '</div>';
	}

	public function listProductById(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$query->execute(array($this->getId()));
		$data = $query->fetch();
		echo '<div class="row">
  				<article class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
  					<img src="images/'.$data['imageName'].'.png" class="imgRow">
  				</article>

  				<article class="col-sm-12 col-md-12 col-lg-6 col-xl-6 articleP">
  					Product name : '.$data['productName'].'<br>
  					Price : '.$data['price'].'  &euro; <br><br>
  					<a href="?addCart&p='.$data['id'].'#addCart">Add this product to the cart</a>
  				</article>
  			</div>';
	}

	public function listProductByName(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM products WHERE productName LIKE ?");
		$query->execute(array('%' . $this->getProductName() . '%'));
		$data = $query->fetch();
		if($query->rowcount() > 0){
			$this->setId($data['id']);
			return true;
		}
		else
			return false;
	}

	public function checkIsProductExist(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$query->execute(array($this->getId()));
		if($query->rowcount() > 0){
			return true;
		}else{
			return false;
		}
	}
}


class Cart{

	private $id;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function listAllCarts(){
		global $pdo;

		$query = $pdo->prepare('SELECT * FROM products WHERE id = ?');
		$query->execute(array($this->getId()));
		$data = $query->fetch();

		echo '<tr>
			      <th scope="row">'.$data['id'].'</th>
			      <td>'.$data['productName'].'</td>
			      <td>'.$data['price'].' &euro;</td>
			      <td><img src="images/'.$data['imageName'].'.png" class="smallImg"></td>
			    </tr>';

	}
}

class Transactions{
	private $id, $userId, $productId, $date;

	public function getId(){
		return $this->id;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function getProductId(){
		return $this->productId;
	}

	public function getDate(){
		return $this->date;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setUserId($userId){
		$this->userId = $userId;
	}

	public function setProductId($productId){
		$this->productId = $productId;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function addTransaction(){
		global $pdo;

		$select = $pdo->prepare('SELECT * FROM products WHERE id = ?');
		$select->execute(array($this->getId()));
		$dataS = $select->fetch();
		$this->setProductId($dataS['id']);

		//add to transaction table
		$query = $pdo->prepare('INSERT INTO transactions VALUES(NULL, ?,?,NOW())');
		$query->execute(array(
			$this->getUserId(),
			$this->getProductId()
		));
	}

	public function viewAllTransactions(){
		global $pdo;
		$query = $pdo->query('SELECT *
								FROM transactions
								INNER JOIN users
								ON transactions.userId = users.id
								INNER JOIN products
								ON  products.id = transactions.productId');
		while($data = $query->fetch()){
			echo '<tr>
			      <th scope="row">'.$data['idTransaction'].'</th>
			      <td>'.$data['lastName'].' '.$data['firstName'].'</td>
			      <td>'.$data['productName'].'</td>
			      <td>'.$data['date'].'</td>
			    </tr>';
		}
	}

	public function getNbTransactions(){
		global $pdo;
		$query = $pdo->query('SELECT * FROM transactions');
		return $query->rowcount();
	}

	public function getTransactionsById($userId){
		global $pdo;
		$query = $pdo->prepare('SELECT * FROM transactions WHERE userId = ?');
		$query->execute(array($userId));
		while($data = $query->fetch()){
			$userSel = $pdo->prepare('SELECT * FROM users WHERE id = ?');
			$userSel->execute(array($userId));
			$us = $userSel->fetch();

			$proSel = $pdo->prepare('SELECT * FROM products WHERE id = ?');
			$proSel->execute(array($data['productId']));
			$ps = $proSel->fetch();
			echo '<tr>
			      <th scope="row">'.$data['idTransaction'].'</th>
			      <td>'.$ps['productName'].'</td>
			      <td>'.$ps['price'].' &euro;</td>
			      <td>'.$data['date'].'</td>
			    </tr>';
		}
	}
}