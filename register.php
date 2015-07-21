<?php
	
	include('config.php');
	include('db_connexion.php');

	$email = "";
	$username = "";	
	$confirm_password = "";
	$errorEmail = "";
	$errorUsername = "";	
	$errorConfirm_password = "";

	if (!empty($_POST)){

		$email = trim(strip_tags($_POST['email']));
		$username = trim(strip_tags($_POST['username']));
		$password = trim(strip_tags($_POST['password']));
		$confirm_password = trim(strip_tags($_POST['confirm_password']));


		if (empty($email)){
			$errorEmail = "Veuillez entrer votre email !";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errorEmail = "Votre email n'est pas valide !";
		}
		else if (strlen($email) > 100){
			$errorEmail ="Votre email est trop long.";
		}
		else{
			$sql = "SELECT email FROM users WHERE email = :email";
			$sth = $dbh->prepare($sql);
			$sth->execute(array(":email" => $email));
			$foundEmail = $sth->fetchColumn();

			if ($foundEmail){
				$errorEmail = "Cet email est déjà enregistré ici !";
			}
		}


		if (empty($username)){
			$errorUsername = "Veuillez indiquer votre pseudo !";
		}
		else if (strlen($username) > 100){
			$errorUsername = "Votre pseudo est trop long.";
		}
		else{
			$sql = "SELECT username FROM users WHERE username = :username";
			$sth = $dbh->prepare($sql);
			$sth->execute(array(":username" => $username));
			$foundUsername = $sth->fetchColumn();

			if ($foundUsername){
				$errorUsername = "Ce pseudo est déjà enregistré ici !";
			}


		if ($password != $confirm_password){
			$errorConfirm_password = "Vos mots de passe ne correspondent pas !";
		}
		
		

		$sql = "INSERT INTO users(id, username, email, password, date_created, date_modified)
				VALUES (NULL, :username, :email, :password, NOW(), NULL)";
		$sth = $dbh->prepare($sql);
		$sth -> bindValue(':username' , $username);
		$sth -> bindValue(':email' , $email);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);//https://github
		$sth -> bindValue(':password' , $hashedPassword);
		$sth -> execute();

	}
}
	









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