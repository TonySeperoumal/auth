<?php

	//mes fonctions


		//convertit une date au format MySQL, vers le francais
		function convertDateToFrench($dateMysql){

			$unix = strtotime($dateMysql);
			$frenchDate = date("d-m-y H:i:s", $unix);

			return $frenchDate;
		}

		//affiche un array dans une balise <pre>
		function pr($table){

			echo '<pre>';
			print_r($table);
			echo '</pre>';
		}

		//si l'utilisteur n'est pas connecté
		function lock(){

			//si on a oublié d'appeler session_start()
			if (!isset($session)){
				session_start();
			}

			if (empty($_SESSION['user'])){
		header('location: login.php');
		die();
			}

		}