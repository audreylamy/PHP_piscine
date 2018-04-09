<?php
session_start();
include('admin/config.php');
$link = mysqli_connect(null, $SQLlogin, $SQLpass, 'my_db', 0, '/Users/fbabin/goinfre/mamp/mysql/tmp/mysql.sock');
if ($link == false)
{
	echo "could not connect to db\n";
	exit ;
}
#mysqli_select_db($link, "my_db");
#$sql = "SELECT * FROM produits";
#echo $sql;
#$requete = mysqli_query($link, $sql);
#$data = mysqli_fetch_array($requete);
#print_r($data);
#echo "tot\n";

#init session with an empty cart
function init_cart()
{
	if (!isset($_SESSION["total"]))
	{
		$_SESSION["total"] = 0;
		$_SESSION["cart"] = array();
		$_SESSION["qty"] = array();
		$_SESSION["cost"] = array();
	}
}

function calc_tot()
{
	$tot = 0;
	for ($i=0; $i < count($_SESSION["cart"]); $i++)
	{
		$tot += $_SESSION["cost"][$i];
	}
	$_SESSION["total"] = $tot;
}

function add_product($link)
{
	if (isset($_POST["action"]) && isset($_POST["product_id"]) && $_POST["action"] === "add")
	{
		$id = $_POST["product_id"];
		if (!isset($_POST["quantity"]))
			$q = 1;
		else
			$q = $_POST["quantity"];
		$sql = "SELECT * FROM produits WHERE id_produit='".$id."'";
		$requete = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($requete);
		for ($i = 0; $i < count($_SESSION["cart"]); $i++)
		{
			echo $_SESSION["cart"][$i]."\n";
			if ($_SESSION["cart"][$i] == $id)
			{
				$_SESSION["qty"][$i] = $_SESSION["qty"][$i] + $q;
				$_SESSION["cost"][$i] = $_SESSION["qty"][$i] * $data['prix'];
				calc_tot();
				return ;
			}
		}
		print_r($data);
		echo $data['prix']."\n";
		array_push($_SESSION["cart"], $id);
		array_push($_SESSION["qty"], $q);
		array_push($_SESSION["cost"], $data['prix'] * $q);
		calc_tot();
	}
}
init_cart();
add_product($link);
var_dump($_SESSION);
add_product($link);
var_dump($_SESSION);

?>