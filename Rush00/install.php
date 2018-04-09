#!/usr/bin/php
<?php
include('admin/config.php');
$link = mysqli_connect(null, $SQLlogin, $SQLpass, NULL, 0, '/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock');
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
	echo "Connection succeeded\n";

$sql = "CREATE DATABASE my_db";
if (mysqli_query($link, $sql)) {
	echo "Database created successfully\n";
} else {
	echo "Error creating database: " . mysqli_error($link);
	echo "\n";
}
/* Retourne le nom de la base de données courante */
if ($result = mysqli_query($link, "SELECT DATABASE()")) {
	$row = mysqli_fetch_row($result);
	printf("La base de données courante est %s.\n", $row[0]);
	mysqli_free_result($result);
}
/* Selectionne la base de donnes de travail */
mysqli_select_db($link, "my_db");
/* Retourne le nom de la base de données courante */
if ($result = mysqli_query($link, "SELECT DATABASE()")) {
	$row = mysqli_fetch_row($result);
	printf("La base de données courante est %s.\n", $row[0]);
	mysqli_free_result($result);
}

$sql_admin = "CREATE TABLE administrateurs( ".
	"id_admin INT NOT NULL AUTO_INCREMENT, ".
	"login VARCHAR(30) NOT NULL, ".
	"nom VARCHAR(30) NOT NULL, ".
	"prenom VARCHAR(30) NOT NULL, ".
	"password VARCHAR(300) NOT NULL, ".
	"PRIMARY KEY (id_admin)); ";

$retval_admin = mysqli_query($link, $sql_admin);
if(!$retval_admin) {
die('Could not create table: ' . mysql_error());
}
echo "Table admin created successfully\n";

$insert_admin = "INSERT INTO administrateurs (id_admin, login, nom, prenom, password)
VALUE (1, '$admin1_login', 'Lamy', 'Audrey', '$admin1_password'),
(2, '$admin2_login', 'Pham', 'Minh',  '$admin2_password'),
(3, '$admin3_login', 'Babin', 'Fxavier', '$admin3_password')";

if (mysqli_query($link, $insert_admin)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $insert_admin . "<br>" . mysqli_error($link);
}

$sql_clients = "CREATE TABLE clients( ".
	"id_client INT NOT NULL AUTO_INCREMENT, ".
	"prenom VARCHAR(30) NOT NULL, ".
	"nom VARCHAR(30) NOT NULL, ".
	"login VARCHAR(30) NOT NULL, ".
	"password VARCHAR(300) NOT NULL, ".
	"email VARCHAR(255) NOT NULL, ".
	"date_naissance DATE NOT NULL, ".
	"adresse VARCHAR(300) NOT NULL, ".
	"ville VARCHAR(255) NOT NULL, ".
	"code_postal VARCHAR(5) NOT NULL, ".
	"pays VARCHAR(255) NOT NULL, ".
	"PRIMARY KEY (id_client)); ";

$retval_clients = mysqli_query($link, $sql_clients);
if(!$retval_clients) {
	die('Could not create table: ' . mysql_error());
 }
 echo "Table clients created successfully\n";

$sql_produits = "CREATE TABLE produits( ".
 	"id_produit INT NOT NULL AUTO_INCREMENT, ".
	"nom VARCHAR(30) NOT NULL, ".
	"description VARCHAR(300) NOT NULL, ".
 	"prix DECIMAL(10,2) NOT NULL, ".
	"id_categorie INT NOT NULL, ".
	"img_produit VARCHAR(300) NOT NULL, ".
 	"PRIMARY KEY (id_produit)); ";


$retval_produits = mysqli_query($link, $sql_produits);
if(!$retval_produits) {
	die('Could not create table: ' . mysql_error());
}
echo "Table produits created successfully\n";

$insert_produit = "INSERT INTO produits (id_produit, nom, description, prix, id_categorie, img_produit) VALUE 
(1, 'Harry Potter Tome 1', 'Il etait une fois un petit apprenti sorcier...', '5', '0', 'https://static.fnac-static.com/multimedia/Images/FR/NR/ba/d8/1d/1956026/1507-1/tsp20171002094855/Harry-Potter-a-l-ecole-des-sorciers.jpg'),
(2, 'Harry Potter Tome 2', 'Il etait une fois un petit apprenti sorcier...', '5', '0', 'https://static.fnac-static.com/multimedia/Images/FR/NR/bb/d8/1d/1956027/1507-1/tsp20171122092205/Harry-Potter-et-la-chambre-des-secrets.jpg'),
(3, 'Le Seigneur des anneaux', 'Il etait une fois un petit hobbit...', '8', '0', 'https://images-na.ssl-images-amazon.com/images/I/51Xv-zGNDfL._SX346_BO1,204,203,200_.jpg'),
(4, 'Naruto', 'Kakash', '5', '1', 'https://static.fnac-static.com/multimedia/Images/FR/NR/c8/8c/13/1281224/1507-1/tsp20160606162704/Naruto.jpg'),
(5, 'Dragon ball', 'Il etait une fois un petit garcon avec une queue de singe..', '5', '1', 'https://static.fnac-static.com/multimedia/images_produits/ZoomPE/8/5/0/9782876952058/tsp20110629150343/Sangoku.jpg'),
(6, 'One piece', 'Il etait une fois un petit pirate avec un chapeau de paille...', '5', '1', 'https://static.fnac-static.com/multimedia/FR/images_produits/FR/Fnac.com/ZoomPE/8/5/3/9782723433358/tsp20130902121711/A-l-aube-d-une-grande-aventure.jpg'),
(7, 'Walking Dead Tome 1', 'Gleen est mort dans les dernieres saisons', '4', '2', 'https://static.fnac-static.com/multimedia/images_produits/ZoomPE/4/2/1/9782756009124/tsp20130903015020/Pae-decompose.jpg'),
(8, 'Tintin', 'Les aventures de Tintin au pays de soviets', '3', '2', 'https://images-na.ssl-images-amazon.com/images/I/51vAB9bWjsL._SX373_BO1,204,203,200_.jpg'),
(9, 'Asterix et Obelix', 'Asterix et la Transitalique', '2', '2', 'https://static.fnac-static.com/multimedia/Images/FR/NR/c4/82/85/8749764/1507-1/tsp20171009133305/Asterix-et-la-Transitalique.jpg')";

if (mysqli_query($link, $insert_produit)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $insert_produit . "<br>" . mysqli_error($link);
}

$sql_categories = "CREATE TABLE categories( ".
	"id_categorie INT NOT NULL AUTO_INCREMENT, ".
	"nom VARCHAR(30) NOT NULL, ".
	"PRIMARY KEY (id_categorie)); ";

$retval_categories = mysqli_query($link, $sql_categories);
if(!$retval_categories) {
	die('Could not create table: ' . mysql_error());
}
echo "Table categories created successfully\n";

$insert_categorie = "INSERT INTO categories (id_categorie, nom) VALUE
(1, 'Aventure'),
(2, 'Manga'),
(3, 'BD')";

if (mysqli_query($link, $insert_categorie)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $insert_categorie . "<br>" . mysqli_error($link);
}

$sql_commandes = "CREATE TABLE commandes( ".
"id_commande INT NOT NULL AUTO_INCREMENT, ".
"id_client INT NOT NULL, ".
"id_produit INT NOT NULL, ".
"quantite INT NOT NULL, ".
"PRIMARY KEY (id_commande)); ";

$retval_commandes = mysqli_query($link, $sql_commandes);
if(!$retval_commandes) {
	die('Could not create table: ' . mysql_error());
}
echo "Table commandes created successfully\n";
?>