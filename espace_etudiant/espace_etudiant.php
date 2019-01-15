<?php
					include_once("../include/fonctions.inc.php");
					echo title_page("Espace Etudiant");
					include_once("../include/header.inc.php");
					if(isset($_POST['connexion'])){
						if(!empty($_POST['username']) && !empty($_POST['password'])){
							if(verifyEtudiant('./identification.csv',$_POST['username'],$_POST['password'])){
										echo formulaireDepoEtudiant();
										echo footerConnexionEtudiant();
														
							
				}
		}
	}else {
		echo "<p style='text-align:center; color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
		echo"<p style='text-align:center;'><a href='./connexion_etudiant.php'>Espace de connexion</a></p>";
		
	}
?>