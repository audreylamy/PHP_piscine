<?php

function init_cart()
{
		$_SESSION["total"] = 0;
		$_SESSION["total_qty"] = 0;
		$_SESSION["x"] = 0;
		$_SESSION["cart"] = array();
		$_SESSION["name"] = array();
		$_SESSION["desc"] = array();
		$_SESSION["qty"] = array();
		$_SESSION["cost"] = array();
}

function calc_tot()
{
	$tot = 0;
	$tot_qty = 0;
	for ($i=0; $i < count($_SESSION["cart"]); $i++)
	{
		$tot += $_SESSION["cost"][$i];
		$tot_qty += $_SESSION["qty"][$i];
	}
	$_SESSION["total"] = $tot;
	$_SESSION["total_qty"] = $tot_qty;
}

function add_product($link)
{
	session_start();
	if (isset($_GET["action"]) && isset($_GET["product_id"]) && $_GET["action"] === "add")
	{
		$id = $_GET["product_id"];
		if (!isset($_GET["quantity"]))
			$q = 1;
		else
			$q = $_GET["quantity"];
		$sql = "SELECT * FROM produits WHERE id_produit='".$id."'";
		$requete = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($requete);
		for ($i = 0; $i < count($_SESSION["cart"]); $i++)
		{
			if ($_SESSION["cart"][$i] == $id)
			{
				$_SESSION["qty"][$i] = $_SESSION["qty"][$i] + $q;
				$_SESSION["cost"][$i] = $_SESSION["qty"][$i] * $data['prix'];
				calc_tot();
				return ;
			}
		}
		$_SESSION["x"] += 1;
		array_push($_SESSION["cart"], $id);
		array_push($_SESSION["name"], $data['nom']);
		array_push($_SESSION["desc"], $data['description']);
		array_push($_SESSION["qty"], $q);
		array_push($_SESSION["cost"], $data['prix'] * $q);
		calc_tot();
	}
}

function get_index_by_id($id)
{
	for ($i=0; $i < count($_SESSION["cart"]); $i++)
	{
		if ($_SESSION["cart"][$i] == $id)
			return ($i);
	}
	return (-1);
}
function delete_product($link)
{
	if (isset($_GET["action"]) && isset($_GET["product_id"]) && $_GET["action"] === "delete")
	{
		echo "titi\n";
		$id = $_GET["product_id"];
		if (!isset($_GET["quantity"]))
			$q = 1;
		else
			$q = $_GET["quantity"];
		$sql = "SELECT * FROM produits WHERE id_produit='".$id."'";
		$requete = mysqli_query($link, $sql);
		$data = mysqli_fetch_array($requete);
		if (($idx = get_index_by_id($id)) == -1)
			return ;
		echo $idx."\n";
		unset($_SESSION["cart"][$idx]);
		unset($_SESSION["name"][$idx]);
		unset($_SESSION["desc"][$idx]);
		unset($_SESSION["qty"][$idx]);
		unset($_SESSION["cost"][$idx]);
		$_SESSION["x"] -= 1;
		var_dump($_SESSION);
		calc_tot();
	}
}
?>