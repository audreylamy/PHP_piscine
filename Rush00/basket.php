<?php
session_start();
include('admin/config.php');
include('cart_functions.php');
$link = mysqli_connect(null, $SQLlogin, $SQLpass, "my_db", 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
	echo "Connection succeeded\n";
#mysqli_select_db($link, "my_db");
#$sql = "SELECT * FROM produits";
#echo $sql;
#$requete = mysqli_query($link, $sql);
#$data = mysqli_fetch_array($requete);
#print_r($data);
#echo "tot\n";

#init session with an empty cart

if (isset($_GET['action']) && $_GET['action'] === "modif")
{
    $_SESSION["qty"][$_GET["i"]] = $_GET["qty"];
    $sql = "SELECT prix FROM produits WHERE id_produit='".$_GET["product_id"]."'";
    $requete = mysqli_query($link, $sql);
    $data = mysqli_fetch_array($requete);
    $_SESSION["cost"][$_GET["i"]] = $_GET["qty"] * $data[0];
}
var_dump($_SESSION);

?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="cart_validation.css" />
        <title>Validation du panier</title>
    </head>

    <body>

    <div class="container">
        <h1>Mon panier:</h1>
<form name="listing" action="basket.php" method="GET">
    <table width="100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Coût</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <h2>Articles sélectionnés :</h2>
        <p align="right">total: <?php echo $_SESSION['total']?> euros</>
		<?php for($i=0; $i < $_SESSION["x"]; $i++): ?>
        <form name="basket" action="basket.php" method="GET">
            <tbody>
                <tr>
					<td><input type="text" name="nom" id="nom" value="<?php echo $_SESSION["name"][$i]?>" size="15vw" autofocus readonly/></td>
					<td><input type="text" name="description" id="description" value="<?php echo $_SESSION["desc"][$i]?>" size="50vw" maxlength="10" readonly/></td>
					<td><input type="text" name="cout" id="cout" value="<?php echo $_SESSION["cost"][$i]?>" size="15vw" maxlength="10" readonly/></td>
					<td><input type="number" name="qty" id="qty" min="1" max="99" value="<?php echo $_SESSION["qty"][$i]?>" size="15vw" maxlength="10" required/></td>
                    <input type="hidden" name="product_id" value="<?php echo $_SESSION["cart"][$i];?>"/>
                    <input type="hidden" name="i" value="<?php echo $i;?>"/>
                    <td><input type="submit" name="action" value="modif" style="width:10vw"/></td>
                </tr>
            </tbody>
		</form>
		<?php endfor; ?>
    </table>
</form>
</div></body></html>
