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

/* Recuperer la variable ID */
$id = mysqli_real_escape_string($link, $_POST['id_client']);

/* Suppression de l'utilisateur par l'id */

if (isset($_POST['id_client']))
{
    if ($_POST['delete_listing'] == "SUPPRIMER")
    {
        $delete_user = "DELETE FROM clients WHERE id_client = '$id'";
        if (mysqli_query($link, $delete_user)) 
        {
            header ('Location: browse.php');
            echo "Record deleted successfully";
        } 
        else 
        {
            echo "Error deleting record: " . mysqli_error($link);
        }
    }
}