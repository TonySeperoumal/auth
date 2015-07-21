<?php
	session_start();
	include('config.php');
	include('db_connexion.php');

	echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';

	if (empty($_SESSION['user'])){
		header('location: login.php');
		die();
	}



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
</head>
<body>
	<div class="container">
		<a href="logout.php" title="Me déconnecter de mon compte">Déconnexion</a>

		<h1>Bienvenue <?php echo $_SESSION['user']['username']; ?></h1>
		

	</div>

	
</body>
</html>