<?php

	include('config.php');


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="container">

		<h1>Connection</h1>

		<form action="login_handler.php" method="post">			
			<input type="text" name="email" placeholder="Email or username">Nom d'utilisateur
			<input type="password" name="password" placeholder="Password">Mot de passe

			<button type="submit">Envoyer</button>
		</form>
		




	</div>
	
</body>
</html>