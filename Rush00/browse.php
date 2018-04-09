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
?> 
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="browse.css" />
        <title>Admin</title>
    </head>

    <body>

    <div class="container">    
        <h1>SECTION ADMIN</h1>

<?php
/* Connexion Mysql */
$link = mysqli_connect(null, $SQLlogin, $SQLpass, 'my_db', 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

/* Selectionner la base de donnees */
mysqli_select_db($link, "my_db");

/* Recuperation de la base de donnees clients */
$sql = "SELECT * FROM clients";
$requete = mysqli_query($link, $sql);
?>

<form name="listing" action="deletelisting.php" method="POST">
    <table width="13.9%">
        <thead>
            <tr>
                <th style="width:100%">ID_Client</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="id_client" id="id_client" size="10" style="width:100%" autofocus required/></td>            
                <td><input type="submit" name="delete_listing" value="SUPPRIMER" style="width:250px; background-color: #DF5133"/></td>
            </tr>
        </tbody>
    </table>
</form>

<form name="listing" action="addlisting.php" method="POST">
    <table width="100%">
        <thead>
            <tr>
                <th>ID_Client</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Password</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="id_client" id="id_client" value="<?php echo "Auto" ?>" size="10" required/></td>                
                <td><input type="text" name="prenom" id="prenom" size="30" maxlength="10" autofocus required/></td>
                <td><input type="text" name="nom" id="nom" size="30" maxlength="10" required/></td>
                <td><input class="input1" type="text" name="login" id="login" size="30" maxlength="10" required/></td>
                <td><input class="input1" type="password" name="password" id="password" size="30" maxlength="10" required/></td>
                <td><input type="email" name="email" id="email" size="30" maxlength="30" required/></td>
                <td><input type="date" name="date_naissance" id="date_naissance" required/></td>
                <td><input type="text" name="adresse" id="adresse" size="30" maxlength="30" required /></td>
                <td><input type="text" name="ville" id="ville" size="30" maxlength="10" required/></td>
                <td><input type="text" name="code_postal" id="code_postal" size="30" maxlength="10" required/></td>
                <td><input type="text" name="pays" id="pays" size="30" maxlength="10" required/></td>
                <td><input type="submit" name="add_listing" value="AJOUTER" style="width:250px"/></td>
            </tr>
        </tbody>
    </table>
</form>

<form name="listing" action="editlisting.php" method="POST">
    <table width="100%">
        <thead>
            <tr>
                <th>ID_Client</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Password</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>Pays</th>
            </tr>
        </thead>
        
        <?php while($data = mysqli_fetch_array($requete)): ?>
        <tbody>
            <tr>
                <td><input type="text" name="id_client" id="id_client" value="<?php echo $data['id_client'] ?>" size="10" required/></td>            
                <td><input type="text" name="prenom" id="prenom" value="<?php echo $data['prenom'] ?>" size="30" maxlength="10" autofocus required/></td>
                <td><input type="text" name="nom" id="nom" value="<?php echo $data['nom'] ?>" size="30" maxlength="10" required/></td>
                <td><input class="input1" type="text" name="login" id="login"  value="<?php echo $data['login'] ?>" size="30" maxlength="10" required/></td>
                <td><input class="input1" type="password" name="password" id="password" value="<?php echo $data['password'] ?>" size="30" maxlength="10" required/></td>
                <td><input type="email" name="email" id="email" value="<?php echo $data['email'] ?>" size="30" maxlength="30" required/></td>
                <td><input type="date" name="date_naissance" id="date_naissance" value="<?php echo $data['date_naissance'] ?>" required/></td>
                <td><input type="text" name="adresse" id="adresse" value="<?php echo $data['adresse'] ?>" size="30" maxlength="30" required /></td>
                <td><input type="text" name="ville" id="ville" value="<?php echo $data['ville'] ?>" size="30" maxlength="10" required/></td>
                <td><input type="text" name="code_postal" id="code_postal" value="<?php echo $data['code_postal'] ?>" size="30" maxlength="10" required/></td>
                <td><input type="text" name="pays" id="pays" value="<?php echo $data['pays'] ?>" size="30" maxlength="10" required/></td>
                <td><input type="submit" name="save_listing" value="SAUVEGARDER" style="width:250px"/></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</form>

