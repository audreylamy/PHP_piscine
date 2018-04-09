<?php
session_start();
?>
<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Welcome</title> 
		<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway:700|Roboto:500" rel="stylesheet">
		<link href="connexion.css" rel="stylesheet">
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
				<div id="nouveau">
					<h2>Nouveau client</h2>
					<br>
					<form method="post" action="insert_bdd.php">
							<p>
							<div class="row">
								<div class="col-25">
								<label class="label" for="prenom">PRENOM :</label>
								</div>
								<div class="col-75">
								<input class="input" type="text" name="prenom" value="<?php $_POST['prenom'];?>" id="prenom" placeholder="Ex : Martin" size="30" maxlength="10" autofocus required/>
								<?php
									if ($_SESSION['prenom'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div>
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="nom">NOM DE FAMILLE:</label>
								</div>
								<div class="col-75">
								<input class="input" type="text" name="nom" value="<?php $_POST['nom'];?>" id="nom" placeholder="Ex : Dupont" size="30" maxlength="10" required/>
								<?php
									if ($_SESSION['nom'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div>
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="email">ADRESSE E-MAIL :</label>
								</div>
								<div class="col-75">
								<input class="input" type="email" name="email" value="<?php $_POST['email'];?>" id="email" placeholder="Ex : martin.dupont@gmail.com" size="30" maxlength="30" required/>
								<?php
									if ($_SESSION['email'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
									if ($_SESSION['error_email'] == "INVALIDE")
										echo "<p id='error' >Email deja existant</p>";
								?>
								</div>
							</div>
							<div class="row">
									<div class="col-25">
									<label class="label" for="login">LOGIN :</label>
									</div>
									<div class="col-75">
									<input class="input" type="text" name="login" value="<?php $_POST['login'];?>" id="login" placeholder="EX : Vegeta" size="30" maxlength="10" required/>
									<?php
									if ($_SESSION['login'] == "INVALIDE")
										echo "<p id='error' >Champ invalide</p>";
									if ($_SESSION['error_login'] == "INVALIDE")
										echo "<p id='error' >Login deja existant</p>";
									?>
									</div> 
							</div>
							<div class="row">
									<div class="col-25">
									<label class="label" for="password">MOT DE PASSE :</label>
									</div>
									<div class="col-75">
									<input class="input" type="password" name="password" value="<?php $_POST['password'];?>" id="password" placeholder="*****" size="30" maxlength="10" required/>
									<?php
									if ($_SESSION['password'] == "INVALIDE")
										echo "<p id='error' >Mot de passe  invalide</p>";
									?>
									</div> 
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="password2">CONFIRMER VOTRE MOT DE PASSE :</label>
								</div>
								<div class="col-75">
								<input class="input" type="password" name="password2" value="<?php $_POST['password2'];?>" id="password2" placeholder="*****" size="30" maxlength="10" required/>
								<?php
								if ($_SESSION['password2'] == NULL)
									echo "<p id='error' >Mot de passe invalide</p>";
								if ($_SESSION['error_password'] == "INVALIDE")
									echo "<p id='error' >Veuillez saisir à nouveau votre mot de passe</p>";
								?>
								</div> 
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="date_naissance">DATE DE NAISSANCE :</label>
								</div>
								<div class="col-75">
								<input class="input" type="date" name="date_naissance" value="<?php $_POST['date_naissance'];?>" id="date_naissance" required/>
								<?php
								?>
								</div>
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="adresse">ADRESSE :</label>
								</div> 
								<div class="col-75"> 
								<input class="input" type="text" name="adresse" value="<?php $_POST['adresse'];?>" id="adresse" placeholder="Ex : 10, rue de la Paix" size="30" maxlength="10" required />
								<?php
									if ($_SESSION['adresse'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div> 
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="ville">VILLE :</label>
								</div>
								<div class="col-75"> 
								<input class="input" type="text" name="ville" value="<?php $_POST['ville'];?>" id="ville" placeholder="Ex : Paris" size="30" maxlength="10" required/>
								<?php
									if ($_SESSION['ville'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div> 
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="code_postal">CODE POSTAL :</label>
								</div>
								<div class="col-75">
								<input class="input" type="text" name="code_postal" value="<?php $_POST['code_postal'];?>" id="code_postal" placeholder="Ex :75008" size="30" maxlength="10" required/>
								<?php
									if ($_SESSION['code_postal'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div> 
							</div>
							<div class="row">
								<div class="col-25">
								<label class="label" for="pays">PAYS :</label>
								</div>
								<div class="col-75">
								<input class="input" type="text" name="pays" value="<?php $_POST['pays'];?>" id="pays" placeholder="France" size="30" maxlength="10" required/>
								<?php
									if ($_SESSION['pays'] == NULL)
										echo "<p id='error' >Champ invalide</p>";
								?>
								</div> 
							</div>
							<div class="row">
								<div class="col-25">
								</div>
								<div class="col-75">
								<input class="input" type="submit" name="valider" value="Valider"/>
								<?php
									if ($_SESSION['add_user'] == "ADD")
										echo "<p id='error' >Bienvenue! vous pouvez vous connecter :)</p>";
								?>
								</div> 
							</div>
							</p>
						</form>

				</div>
				<div id="vertical_border"></div>
				<div id="ancien">
					<h2>Déjà Client</h2>
					<br>
					<form method="post" action="login.php">
							<p>
							<div class="row">
									<div class="col-25">
									<label for="login">LOGIN :</label>
									</div>
									<div class="col-75">
									<input class="input" type="text" name="login" value="<?php $_POST['login']; ?>" id="login" placeholder="EX : Vegeta" size="30" maxlength="10" required/>
									</div> 
							</div>
							<div class="row">
									<div class="col-25">
									<label for="password">MOT DE PASSE :</label>
									</div>
									<div class="col-75">
									<input class="input" type="password" name="password" value="<?php $_POST['password']; ?>" id="password" placeholder="*****" size="30" maxlength="10" required/>
									<?php
									if ($_SESSION['invalide_login_mdp'] == 'INVALIDE')
										echo "<p id='error' >Votre login ou mot de passe est invalide</p>";
									?>
									</div> 
							</div>
								<div class="row">
									<div class="col-25">
									</div>
									<div class="col-75">
								<input class="input" type="submit" name="modif" value="Connexion"/>
								</div> 
							</div>
							</p>
						</form>
				</div>
			</div>
		</div>
	</body>
</html>