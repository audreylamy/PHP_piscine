#!/usr/bin/php
<?php
session_start();
header('Location: index.php');
require('auth.php');
include('admin/config.php');
$link = mysqli_connect(null, $SQLlogin, $SQLpass, "my_db", 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock')
			or die("Impossible de se connecter : " . mysql_error() . "\n");
	echo "Connexion réussie\n";

$sql = "SELECT login, password FROM clients";
$requete = mysqli_query($link, $sql); 
$sql1 = "SELECT login, password FROM administrateurs";
$requete1 = mysqli_query($link, $sql1); 

if (auth($_POST['login'], $_POST['password'], $requete) == TRUE)
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
	$_SESSION['user'] = "client";
}
else if (admin($_POST['login'], $_POST['password'], $requete1) == TRUE)
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
	$_SESSION['user'] = "admin";
}
else 
{
	header('Location: connexion.php');
	$_SESSION['loggued_on_user'] = '';
	$_SESSION['invalide_login_mdp'] = 'INVALIDE';
	echo "ERROR"."\n";
}
?>