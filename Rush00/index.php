<?php
session_start();
include('cart_functions.php');
$_SESSION['prenom'] = "OK";
$_SESSION['nom'] = "OK";
$_SESSION['login'] = "OK";
$_SESSION['password'] = "OK";
$_SESSION['password2'] = "OK";
$_SESSION['email'] = "OK";
$_SESSION['tel'] = "OK";
$_SESSION['adresse'] = "OK";
$_SESSION['ville'] = "OK";
$_SESSION['code_postal'] = "OK";
$_SESSION['pays'] = "OK";
$_SESSION['error_email'] = "OK";
$_SESSION['error_login'] = "OK";
$_SESSION['error_password'] = "OK";
$_SESSION['invalide_login_mdp'] = "OK";
$_SESSION['modif_false'] = "OK";
$_SESSION['modif_done'] = "OK";

include('admin/config.php');
$link = mysqli_connect(null, $SQLlogin, $SQLpass, "my_db", 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_GET['action']) && $_GET['action'] == "add")
{
	add_product($link);
}
else
{
	init_cart();
}

if ($_SESSION['loggued_on_user'])
{
	echo $_SESSION['loggued_on_user']."\n";
	echo $_SESSION['user'];
}
else
{
	$_SESSION['loggued_on_user'] = NULL;
}
?>
<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Welcome</title> 
		<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway:700|Roboto:500" rel="stylesheet">
		<link href="index.css" rel="stylesheet">
 	</head>
	<body>
			<p id="logo">My Shop</p>
		<div id="block">
			<nav>
				<div id="bloc_compte">
				<?php
				if ($_SESSION['user'] == 'admin')
					echo "<div><a id='admin' href='browse.php'>Admin</a></div>";
				else if ($_SESSION['user'] == 'client')
					echo "<div><a id='mon_compte' href='modif.php'>Mon compte</a></div>";
				?>
				<?php
				if ($_SESSION['loggued_on_user'] == NULL)
					echo "<div><a id='connexion' href='connexion.php'>Se connecter</a></div>";
				else
				{
					echo "<div><a id='deconnexion' href='logout.php'>";
					echo Deconnexion." ".$_SESSION['loggued_on_user'];
					echo "</a></div>";
				}
				?>
					<a style="text-decoration:none" href="basket.php">
					<img id="panier" src="img/panier.png" title="panier" alt="panier"/>
					</a>
					<p id="total"> <?php echo $_SESSION['total_qty']?></p>
					<p id="nb_cart"><?php echo $_SESSION['total']?></p>
				</div>
			</nav>
		
			<?php
				$nb_cat = "SELECT COUNT(id_categorie) FROM categories";
				$requete = mysqli_query($link, $nb_cat);
				$t = mysqli_fetch_array($requete);
				for ($i=0; $i < $t[0];$i++): ?>
				<div id="bloc_cat1">
					</br>
                	<h4 id="title">Categorie <?php echo $i+1?></h4>
                	<table>
						<?php 
						$sql = "SELECT * FROM produits WHERE id_categorie='$i'";
						$requete = mysqli_query($link, $sql);
						while($data = mysqli_fetch_array($requete)): ?> 
							<div id="produit" style="float:left" >
								<img id="p" src="<?php echo $data['img_produit'];?>" title="panier" alt="panier" />
								<p><?php echo $data['nom']." ".$data['prix']." euros";?></p>
								<form method="GET" action="index.php" name="index.php" >
									<input type="number" name="quantity" value="1">
									<input type="hidden" name="product_id" value="<?php echo($data['id_produit']) ;?>">
									<input type="submit" name="action" value="add">
								</form>
							</div>
                    	<?php endwhile; ?>
                	</table>
            	</div>
			<?php endfor;?>
		</div>
	</body>
</html>
