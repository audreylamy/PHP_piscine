#!/usr/bin/php
<?php
session_start();
include('admin/config.php');
/* Verifier qu'il s'agit d'un compte admin */
if ($_SESSION['user'] != 'admin') 
{
    header ('Location: /index.php');
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

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['date_naissance'])  
&& isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['code_postal']) && isset($_POST['pays']))
{
	if ($_POST['add_listing'] == "AJOUTER")
	{
		/* commence par une majuscule, pas de prenom compose, minimum 2 caracteres, maximum 16 caracteres */
        if (preg_match("#^[^a-z][a-zàáâäçèéêëìíîïñòóôöùúûü]{1,15}$#", $_POST['prenom']))
        {
            $new_prenom = htmlspecialchars($_POST['prenom']);
            echo "Le prenom renseigne est valide";   
        }
		else
			echo "Le champ est invalide.";
		/* minimum 2 caracteres, maximum 16 caracteres, caracteres alphabétiques, pas de noms composes */
        if (preg_match("#^[A-Z][a-zàáâäçèéêëìíîïñòóôöùúûü]{1,15}$#", $_POST['nom']))
        {
            $new_nom = htmlspecialchars($_POST['nom']);
            echo "Le nom renseigne est valide";
        }
		else
			echo "Le champ est invalide.";
		/* minimum 6 caracteres, maximum 16 caracteres, caracacteres alphanumeriques + underscore */
        if (preg_match("#^[a-zA-Z0-9_]{5,16}$#", $_POST['login']))
        {
            $new_login = htmlspecialchars($_POST['login']);
            echo "Le login renseigne est valide";
        }
		else
			echo "Le champ est invalide.";

		$query_login = mysqli_query($link, 'SELECT count(*) AS existe_pseudo FROM clients WHERE login="'.mysqli_real_escape_string($link, $_POST['login']).'"');
		$data_login = mysqli_fetch_array($query_login);
		if (($data_login['existe_pseudo'] == '0'))
            echo "Le pseudo est disponible";
        else
            echo "Le pseudo choisis existe déjà";

		/* minimum 1 lettre minuscule, minimum 1 lettre majuscule, minimum un chiffre, minimum 6 caracteres */
        if (preg_match("#(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*#", $_POST['password']))
        {
            $new_password = htmlspecialchars($_POST['password']);
            $hashed_new_password = hash('whirlpool', $new_password);
            echo "Le mot de passe renseigne est valide";
        }
        else
            echo "Le champ est invalide.";
		/* pas RFC5322-compliant mais gere la majorite des cas */
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
        {
            $new_email = htmlspecialchars($_POST['email']);
            echo "L'e-mail renseigne est valide";
        }
        else
        {
            header ('Location: browse.php');
			echo "Le champ est invalide.";
        }
		$query_email = mysqli_query($link, 'SELECT count(*) as existe_email FROM clients WHERE email="'.mysqli_real_escape_string($link, $_POST['email']).'"');
		$data_email = mysqli_fetch_array($query_email);
		if (($data_email['existe_email'] == '0'))
            echo "Le pseudo est disponible";
        else
            echo "Cette adresse email est deja utilisee";

        $new_date_naissance = $_POST['date_naissance'];

		/* string commencant par des chiffres, suivi d'un mot */
        if (preg_match("#[a-zA-Z0-9,]{1,255}#", $_POST['adresse']))
        {
            $new_adresse = htmlspecialchars($_POST['adresse']);
            echo "L'adresse renseignee est valide";   
        }
		else
			echo "Le champ est invalide.";
		/* minimum 2 caracteres, maximum 16 caracteres, pas de nom compose  */
        if (preg_match("#^[^a-z][a-zàáâäçèéêëìíîïñòóôöùúûü]{1,15}$#", $_POST['ville']))
        {
            $new_ville = htmlspecialchars($_POST['ville']);
            echo "La ville renseignee est valide";   
        }
		else
			echo "Le champ est invalide.";
		/* code postal sous la forme 00000 */
        if (preg_match("#^[0-9]{5,5}$#", $_POST['code_postal']))
        {
            $new_code_postal = htmlspecialchars($_POST['code_postal']);
            echo "Le code postal renseigne est valide";   
        }
		else
			echo "Le champ est invalide.";
		/* minimum 2 caracteres, maximum 16 caracteres, pas de nom de pays compose */
        if (preg_match("#^[^a-z][a-zàáâäçèéêëìíîïñòóôöùúûü]{1,15}$#", $_POST['pays']))
        {
            $new_pays = htmlspecialchars($_POST['pays']);
            echo "Le pays renseigne est valide";
        }
		else
			echo "Le champ est invalide.";

        $insert_bdd = "INSERT INTO clients (prenom, nom, login, password, email, date_naissance, adresse, ville, code_postal, pays)
        VALUE ('$new_prenom', '$new_nom', '$new_login', '$hashed_new_password', '$new_email', '$new_date_naissance', '$new_adresse', '$new_ville', '$new_code_postal', '$new_pays')";
		$query_add_user = mysqli_query($link, $insert_bdd);
        if ($query_add_user)
            echo "L'ajout des donnees a ete correctement effectue";
		else
			echo "L'ajout des donnees a echouee";
	}
}
else
	echo "ERROR\n";

    mysqli_close($link);