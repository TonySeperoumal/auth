<?php
	
	// $yeaRegexp = "/^\d{4}$/";// d pour digit -> chiffre, {4}->4 fois
	// $yeaRegexp = "/^[0-9]{4}$/";

	$yeaRegexp = "/^[1-2][0-9]{3}$/";//1-2 pour les annees 1000 et 2000

	$emailRegexp = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9_-]+\.[a-zA-Z]{2,}$/i";//+ signifie 1 ou plus
	//autre formulation
	//$emailRegexp = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9_-]+\.[a-zA-Z]{2,}/";
	//^ et $ -> le debut et la fin du string;
	//i -> insensible a la casse;

	// $usernameRegexp = "/^[a-zA-Z0-9._-]{2,100}$/";
	$usernameRegexp = "/^[\p{L}0-9._-]{2,100}$/u";//L -> les lettres, u -> utf8;

	if (preg_match($usernameRegexp, "tata")){
		echo "match";
	}
	else {
		echo "no match";
	}

	
?>