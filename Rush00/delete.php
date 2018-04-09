#!/usr/bin/php
<?php
session_start();
include('admin/config.php');
/* Verifier que le membre est connecté sinon on le redirige vers l'accueil */
if (!isset($_SESSION['loggued_on_user'])) 
{
    header ('Location: index.php');
    exit();
}

/* Connexion Mysql */
$link = mysqli_connect(null, $SQLlogin, $SQLpass, 'my_db', 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/* Selectionner la base de donnees */
mysqli_select_db($link, "my_db");

/* Recuperation de la variable invisible id */
echo "IM HERE";
$id = $_POST["id"] ;
//$id = mysqli_real_escape_string($_POST['id']);

if ($_POST['delete'] == "SUPPRIMER")
{
	$query = "DELETE FROM clients WHERE id_client = '$id'";
	if (mysqli_query($link, $query)) 
	{
		$_SESSION['loggued_on_user'] = NULL;
		$_SESSION['user'] = NULL;
		header ('Location: index.php');
		echo "Record deleted successfully";
	} 
	else 
	{
		echo "Error deleting record: " . mysqli_error($link);
	}
}