<?php
	
	session_start();
	include('config.php');
	include('db_connexion.php');
	include('fonctions.php');
	include('vendor/autoload.php');

	if (!empty($_GET)){
		$_SESSION['token'] = $_GET['token'];
	}

	$confirm_password = "";
	$errorConfirm_password = "";

	if (!empty($_POST)){

		$password = trim(strip_tags($_POST['password']));
		$confirm_password = trim(strip_tags($_POST['confirm_password']));

		if ($password != $confirm_password){
			$errorConfirm_password = "Vos mots de passe ne correspondent pas !";
		}
		else if (strlen($password) <= 6){
			$errorConfirm_password = "Veuillez saisir un mot de passe d'au moins 7 caracteres !";
		}
		else{
			$containsLetter = preg_match('/[a-zA-Z]/', $password);
			$containsDigit = preg_match('/\d/', $password);
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

			if (!$containsLetter || !$containsDigit || !$containsSpecial){
				$errorConfirm_password = "Veuillez choisir un mot de passe avec au moins une lettre, un chiffre et un caractere spécial.";
			}
		}

		if ($errorConfirm_password == ""){
		$sql = "UPDATE users
				SET password = :password
				WHERE token = :token";
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':token', $_SESSION['token']);		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
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
	<h1>Changer votre mot de passe</h1>
	<div class="container">
		<form action="change_password.php" method="post">
			<div class="form-row">
				<label for="password">Mot de passe
					<input type="password" name="password" id="password">			
				</label>
			</div>
			<br />
			<div class="form-row">
				<label for="confirm_password">Confirmé mot de passe
					<input type="password" name="confirm_password" id="confirm_password">
				</label>
				<div class="help-block text-danger"><?php echo $errorConfirm_password; ?></div>
			</div>
			<button type="submit">Envoyer</button>
		</form>
	</div>
	
</body>
</html>