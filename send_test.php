	<?php

	//envoie un email grâce aux serveurs SMTP de gmail

	/*||||||||||||||||||||||
	Attention :: Il faut maintenant autoriser les apps en se rendant d'abord sur 
	https://www.google.com/settings/security/lesssecureapps
	||||||||||||||||||||||*/

	/*
	ATTENTION : NE PUBLIEZ PAS VOTRE MOT DE PASSE GMAIL DE VOTRE COMPTE PERSO SUR GITHUB !!!!!
	*/
	require('config.php');
	require ("vendor/autoload.php");


	//instance de PHPMailer
	$mail = new PHPMailer;

	//config de l'envoi
	$mail->isSMTP();
	$mail->setLanguage('fr');
	$mail->CharSet = 'UTF-8';

	//debug
	$mail->SMTPDebug = 2;	//0 pour désactiver les infos de débug
	$mail->Debugoutput = 'html';

	//config du serveur smtp
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = SMTPUSER;
	$mail->Password = SMTPHOST;

	//qui envoie, et qui reçoit
	$mail->setFrom('from@example.com', 'Jean Dupont');
	$mail->addAddress('tony.wf3.nanterre@gmail.com', 'tony SEPEROUMAL');

	//mail au format HTML
	$mail->isHTML(true); 

	//sujet 
	$mail->Subject = 'Envoyé par PHP !';

	//message (avec balises possibles)
	$mail->Body = 'Message envoyé avec <a href="http://localhost/auth/change_password.php">Cliquez ici pour créer un nouveaumot de passe</a>';

	//pièce jointe
	$mail->addAttachment('image/panda.gif');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
