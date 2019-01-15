<?php

	include_once("../include/fonctions.inc.php");
	echo title_page("Espace Enseignant");
	include_once("../include/util.inc.php");
	include_once("../include/header.inc.php");
	
?>

	<?php
	
					if(isset($_POST['connexion'])){
						if(!empty($_POST['username']) && !empty($_POST['password'])){
							if(verifyEnseignant('../gestionnaire/identificationEnseignant.csv',$_POST['username'],$_POST['password'])){
								
								echo'	<body>
										<div id="headerConnexionEtudiant">
										<h1>Espace Enseignant/Sécritaires</h1>	
										</div>
		
										<div id="connexionEtudiant">
										<nav>
										<ul>
										<li><a href="./logout.php">Déconnexion</a></li>
										</ul>
										<hr style="margin-left:20%;margin-right:20%;"/>
										</nav>
										
										<h2 style="text-align:center;">Afficher un trombinoscope :</h2>';
										echo formulaireDaffichage();
										echo footerConnexionEtudiant();
							}
							
							
					}else {
									
									echo "<p style='text-algin:center;color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
									echo"<p style='text-align:center;'><a href='./connexion_enseignant.php'>Espace de connexion</a></p>";
		
				}
	}

						
?>