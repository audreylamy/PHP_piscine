#!/usr/bin/php
<?php
session_start();
header('Location: connexion.php');
include('admin/config.php');
include('auth.php');

$date_naissance = $_POST['date_naissance'];
$email = $_POST['email'];

if (preg_match("#^[^a-z][a-zàáâäçèéêëìíîïñòóôöùúûü]{1,15}$#", $_POST['prenom']))
{
	$_SESSION['prenom'] = "ok";
	$prenom = htmlspecialchars($_POST['prenom']);
	echo "ok1";
}
else
{
	$_SESSION['prenom'] = NULL;
	echo "error1";
}
	
/* minimum 2 caracteres, maximum 16 caracteres, caracteres alphabétiques, pas de noms composes */
if (preg_match("#^[a-zA-Z]{2,16}$#",$_POST['nom']))
{
	$_SESSION['nom'] = "ok";
	$nom = htmlspecialchars($_POST['nom']);
	echo "ok2";
}
else
{
	$_SESSION['nom'] = NULL;
	echo "error2";
}

/* minimum 6 caracteres, maximum 16 caracteres, caracacteres alphanumeriques + underscore */
if (preg_match("#^[a-zA-Z0-9_]{5,16}$#", $_POST['login']))
{
	$_SESSION['login'] = "ok";
	$login = htmlspecialchars($_POST['login']);
	echo "ok3";
}
else
{
	$_SESSION['login'] = NULL;
	echo "error3";
}

/* minimum 1 lettre minuscule, minimum 1 lettre majuscule, minimum un chiffre, minimum 6 caracteres */
if (preg_match("#(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*#", $_POST['password']))
{
	$_SESSION['password'] = "ok";
	$password = htmlspecialchars($_POST['password']);
	$hashed_password = hash('whirlpool', $password);
}
else
{
	$_SESSION['password'] = NULL;
}

// $password = password_hash(htmlspecialchars($_POST['password']));

if (preg_match("#(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*#", $_POST['password2']))
{
	$_SESSION['password2'] = "ok";
	$password2 = htmlspecialchars($_POST['password2']);
	echo $password2;
	$hashed_password2 = hash('whirlpool', $password);
	echo $hashed_password2;
}
else
{
	$_SESSION['password2'] = NULL;
	echo "error5";
}

/* string commencant par des chiffres, suivi d'un mot */
if (preg_match("#[a-zA-Z0-9,]{1,255}#", $_POST['adresse']))
{
	$_SESSION['adresse'] = "ok";
	$adresse = htmlspecialchars($_POST['adresse']);
}
else
{
	$_SESSION['adresse'] = NULL;
	echo "error7";
}

/* minimum 2 caracteres, maximum 16 caracteres, ville compose ex : Saint-Denis */
if ($_POST['ville'])
{
	$_SESSION['ville'] = "ok";
	$ville = htmlspecialchars($_POST['ville']);
}
else
{
	$_SESSION['ville'] = NULL;
	echo "error8";
}

/* code postal sous la forme 00000 */
if (preg_match("#^[0-9]{5,5}$#", $_POST['code_postal']))
{
	$_SESSION['code_postal'] = "ok";
	$code_postal = htmlspecialchars($_POST['code_postal']);
}
else
{
	$_SESSION['code_postal'] = NULL;
	echo "error9";
}

/* minimum 2 caracteres, maximum 16 caracteres, nom de pays compose ex : Etats-Unis */
if ($_POST['pays'])
{
	$_SESSION['pays'] = "ok";
	$pays = htmlspecialchars($_POST['pays']);
}
else
{
	$_SESSION['pays'] = NULL;
	echo "error10";
}


if ($_SESSION['prenom'] != NULL && $_SESSION['nom'] != NULL && $_SESSION['login'] != NULL && $_SESSION['password'] != NULL && $_SESSION['password2'] != NULL && $_SESSION['email'] != NULL 
&& $_SESSION['adresse'] != NULL && $_SESSION['ville'] && $_SESSION['code_postal'] && $_SESSION['pays'])
{
	$link = mysqli_connect(null, $SQLlogin, $SQLpass, "my_db", 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
	if($link === false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	else
		echo "Connection succeeded\n";

	$sql = "SELECT login FROM clients";
	$requete = mysqli_query($link, $sql); 
	$sql1 = "SELECT email FROM clients";
	$requete1 = mysqli_query($link, $sql1); 

	if ((email($email, $requete1) == FALSE) && (login($login, $requete) == FALSE) && ($hashed_password == $hashed_password2))
	{
		$insert_bdd = "INSERT INTO clients (prenom, nom, login, password, email, date_naissance, adresse, ville, code_postal, pays)
		VALUE ('$prenom', '$nom', '$login', '$hashed_password', '$email', '$date_naissance', '$adresse', '$ville', '$code_postal', '$pays')";
	
		if (mysqli_query($link, $insert_bdd)) 
		{
			$_SESSION['add_user'] = "ADD";
			echo "New record created successfully";
		} 
		else 
			echo "Error: " . $insert_bdd . "<br>" . mysqli_error($link);
	}
	else if (email($email, $requete1) == TRUE)
	{
		$_SESSION['error_email'] = "INVALIDE";
		echo "ERROR email";
	}
	else if (email($login, $requete) == TRUE)
	{
		$_SESSION['error_login'] = "INVALIDE";
		echo "ERROR login";
	}
	else if ($hashed_password != $hashed_password2)
	{
		$_SESSION['error_password'] = "INVALIDE";
		echo "ERROR password";
	}
}
else 
{
	echo "ERROR";
}
?>