<?php 
		$id = "admin";
	$mypass = "1234";
	
	if(isset($_POST['connexion'])) {
		$username = $_POST['username'];	
		$password = $_POST['password'];
		if( $username == $id and $mypass == $password) {
			
			if(isset($_POST['remember'])){
				setcookie('username', $username, time()+60*60);
				setcookie('password', $password, time()+60*60);			
			}		
							session_start();
			
							include_once("../include/fonctions.inc.php");
							echo title_page("Espace Gestionnaire");
							include_once("../include/util.inc.php");
							include_once("../include/header.inc.php");
	echo'<body>
	<div id="headerConnexionEtudiant">
		<h1>Espace Gestionnaire</h1>	
	</div>
		
	<div id="connexionEtudiant">
			<nav>
					<ul>
						<li><a href="./logout.php">Déconnexion</a></li>
						<li><a href="./gestionnaire.php">Filières/Groupes</a></li>
						<li><a href="./gestionnaire_Ajouter_Enseignant.php">Professeurs/Sécritaires</a></li>
					</ul>
					<hr style="margin-left:20%;margin-right:20%;"/>
			</nav>
<section>
	<h2 style="text-align:center;">Gestion des filières et groupes</h2>';
		$_SESSION['username'] = $username;
		//	session_start();
		echo "Welcome ".$_SESSION['username'];
				
				
				
}else{
			echo "identifiant or Password is Invalid . <br/> click here to <a href ='connexion_gestionnaire.php'>
			try again </a>";		
		}
	}
	else {
		header("location : connexion_gestionnaire.php");	
	}
			
			
?>

