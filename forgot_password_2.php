<?php

	session_start();
	include('config.php');
	include('db_connexion.php');
	include('fonctions.php');
	include('vendor/autoload.php');

	$email = "";
	$errorEmail = "";

	if (!empty($_POST)){

		$email = trim(strip_tags($_POST['email']));

		if (empty($email)){
			$errorEmail = "Veuillez entrer votre email !";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errorEmail = "Votre email n'est pas valide !";
		}
		else if (strlen($email) > 100){
			$errorEmail ="Votre email est trop long.";
		}

	
		$sql = "SELECT * FROM users
				WHERE email = :email			
				LIMIT 1";

		$sth = $dbh->prepare($sql);
		$sth->bindvalue(':email', $email);
		$sth->execute();

		$foundUser = $sth->fetch();

		if ($foundUser){
			
    		
			$factory = new RandomLib\Factory;
			$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
			$token = $generator->generateString(32, 'abcdef');

			// echo $token;
			// die();

			$sql = "UPDATE users 
					SET token = :token
					WHERE email = :email";
			$sth = $dbh->prepare($sql);
			$sth->bindValue(':token', $token);
			$sth->bindValue(':email', $email);
			$sth->execute();

			require('send_test.php');
		}
		else{
			
			header('location: forgot_password_2.php');
			die();		

		}
		
}

	


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mot de passe oubié</title>
</head>
<body>
	<div class="container">

		<form action="forgot_password_2.php" method="post">
			<div class="form-row">
				<label for="email">Votre email
					<input type="email" name="email" id="email">
					<input type="submit" value="OK">
					<div class="help-block text-danger"><?php echo $errorEmail; ?></div>
				</label>
			</div>

		</form>
		
	</div>
	
</body>
</html>