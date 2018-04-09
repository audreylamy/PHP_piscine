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

$link = mysqli_connect(null, $SQLlogin, $SQLpass, 'my_db', 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/* Selectionner la base de donnees */
mysqli_select_db($link, "my_db");

/* Recuperation de la variable id_client */
$user = $_SESSION['loggued_on_user'];
$requete_id = mysqli_query($link, "SELECT id_client FROM clients WHERE login = '$user'");
$id = mysqli_fetch_array($requete_id);
$id = $id['0']; 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="compte.css" />
        <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway:700|Roboto:500" rel="stylesheet">
        <title>Mes informations</title>
    </head>

    <body>
    <p id="logo">My Shop</p>
        <div id="block">
            <nav>
                <div id="bloc_compte">
                    <div><a id="accueil" href="index.php">Retour à l'accueil</a></div>
                    <img id="arrow" src="img/arrow.png" title="arrow" alt="arrow"/>
                </div>
            </nav>  
        <div id="bloc_connexion">    
        <h1>MES INFORMATIONS</h1>
        <h3 id="h2">N'hésitez pas à modifier vos coordonnées ci-dessous pour que votre compte soit parfatement à jour.</h3>

<?php

$sql = "SELECT * FROM clients WHERE id_client = '$id'";
$requete = mysqli_query($link, $sql);
$data = mysqli_fetch_array($requete);
?>

<form method="post" action="modif2.php">
                <input type="hidden" name="id" value="<?php echo($id) ;?>">
            <div class="row">
                <div class="col-26">
                <label class="label1" for="prenom">PRENOM :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="text" name="prenom" id="prenom" value="<?php echo $data['prenom'] ?>" size="30" maxlength="10" autofocus required/>
                </div>
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="nom">NOM DE FAMILLE:</label>
                </div>
                <div class="col-76">
                <input class="input1" type="text" name="nom" id="nom" value="<?php echo $data['nom'] ?>" size="30" maxlength="10" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="login">LOGIN :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="text" name="login" id="login"  value="<?php echo $data['login'] ?>" size="30" maxlength="10" required/>
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="password">MOT DE PASSE :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="password" name="password" id="password" value="<?php echo $data['password'] ?>" size="30" maxlength="10" required/>
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="email">ADRESSE E-MAIL :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="email" name="email" id="email" value="<?php echo $data['email'] ?>" size="30" maxlength="30" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="date_naissance">DATE DE NAISSANCE :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="date" name="date_naissance" id="date_naissance" value="<?php echo $data['date_naissance'] ?>" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="adresse">ADRESSE :</label>
                </div> 
                <div class="col-76"> 
                <input class="input1" type="text" name="adresse" id="adresse" value="<?php echo $data['adresse'] ?>" size="30" maxlength="30" required />
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="ville">VILLE :</label>
                </div>
                <div class="col-76"> 
                <input class="input1" type="text" name="ville" id="ville" value="<?php echo $data['ville'] ?>" size="30" maxlength="10" required/>
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="code_postal">CODE POSTAL :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="text" name="code_postal" id="code_postal" value="<?php echo $data['code_postal'] ?>" size="30" maxlength="10" required/>
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                <label class="label1" for="pays">PAYS :</label>
                </div>
                <div class="col-76">
                <input class="input1" type="text" name="pays" id="pays" value="<?php echo $data['pays'] ?>" size="30" maxlength="10" required/>
                </div> 
            </div>
            <div class="row">
                <div class="col-26">
                </div>
                <div class="col-76">
                <input class="input1" type="submit" name="modif" value="SAUVEGARDER"/>
                <?php
					if ($_SESSION['modif_false'] == "INVALIDE")
                        echo "<p id='error' >Erreur vos modifications n'ont pas ete effectuees</p>";
                    if ($_SESSION['modif_done'] == "TRUE")
					    echo "<p id='error' >Vos modifications ont ete effectuees</p>";
				?>
                </div> 
            </div>
        </form>
    </div>

    <div class="container">
        <h3 id="h2">Vous êtes sur le point de supprimer votre compte. Souhaitez-vous continuer?</h3>

        <form method="post" action="delete.php">
            <input type="hidden" name="id" value="<?php echo($id) ;?>">
            <div class="row">
                <div class="col-26">
                </div>
                <div class="col-76">
                <input class="input1" type="submit" name="delete" value="SUPPRIMER"/>
                </div> 
            </div> 
        </form>
        </div>
    </body>
</html>

<?php
    mysqli_close($link);
?>