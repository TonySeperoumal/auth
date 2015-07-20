<?php

	include('db_connexion.php');

	$email = "";
	$username = "";
	$password = "";
	$confirm_password = "";
	$errorEmail = "";
	$errorUsername = "";
	$errorPassword = "";
	$errorConfirm_password = "";

	if (!empty($_POST)){

		$email = trim(strip_tags($_POST['email']));
		$username = trim(strip_tags($_POST['username']));
		$password = trim(strip_tags($_POST['password']));
		$confirm_password = trim(strip_tags($_POST['confirm_password']));


		if (empty($email)){
			$errorEmail = "Veuillez entrer votre email";
		}
		if (empty($username)){
			$errorUsername = "Veuillez indiquer votre nom";
		}
		if (empty($password)){
			$errorPassword = "Entrez votre mot de passe";
		}
		if (empty($confirm_password)){
			$errorConfirm_password = "Confirmez votre mot de passe";
		}

		$sql = "INSERT INTO users(username, email, password)
				VALUES (:username, :email, :password)";
		$sth = $dbh->prepare($sql);
		$sth -> bindValue(':username' , $username);
		$sth -> bindValue(':email' , $email);
		$sth -> bindValue(':password' , $password);
		$sth -> execute();

	}
	print_r($_POST);









?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="container">

		<h1>Formulaire d'inscription</h1>

		<form action="register.php" method="post">

			<div class="form-row">
				<label for="email">Email
					<input type="email" name="email" id="email">
					<div class="help-block text-danger"><?php echo $errorEmail; ?></div>
				</label>				
			</div>
			<div class="form-row">
				<label for="username">Nom d'utilisateur
					<input type="text" name="username" id="username">
					<div class="help-block text-danger"><?php echo $errorUsername; ?></div>
				</label>
			</div>
			<div class="form-row">
				<label for="password">Mot de passe
					<input type="password" name="password" id="password">
					<div class="help-block text-danger"><?php echo $errorPassword; ?></div>
				</label>				
			</div>
			<div class="form-row">
				<label for="confirm_password">Confirmé mot de passe
					<input type="password" name="confirm_password" id="confirm_password">
					<div class="help-block text-danger"><?php echo $errorConfirm_password; ?></div>
				</label>
			</div>

			<button type="submit">Envoyer</button>
			<button type="reset">Annuler</button>

		</form>

	</div>
	
</body>
</html>