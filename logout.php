<?php
	//deconnexion !
	session_start();//même pour effacer la session, on doit la demarrer
	unset($_SESSION['user']);
	header('location: login.php');
	die();

?>
