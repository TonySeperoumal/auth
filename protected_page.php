<?php
	session_start();
	include('config.php');
	include('db_connexion.php');
	include('fonctions.php');


	pr($_SESSION);
	

	


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