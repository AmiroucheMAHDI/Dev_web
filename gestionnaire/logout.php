<?php
	session_start();
	session_destroy();
	if(isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		setcookie('username', $username, time()-1);
		setcookie('password', $password, time()-1);
	}	
	
	echo "retour au formulaire de <a href='../index.html'>Connexion </a>";
?>