<?php
	include_once("../include/fonctions.inc.php");
	echo title_page("Espace Gestionnaire");
	include_once("../include/util.inc.php");
	include_once("../include/header.inc.php");
?>
<?php
		
		if(isset($_POST['afficher'])){
			if( isset($_POST['groupe']) && isset($_POST['groupe'])){
					echo'<h2 style="text-align:center;">Trombinoscopes</h2>';
					echo '<body>
						<nav>
							<ul>
								<li><a href="./logout.php">Déconnexion</a></li>
							</ul>
							<hr style="margin-left:20%;margin-right:20%;"/>
						</nav>
						<div>';
 						echo'<div id="connexionEtudiant">';
 						echo getphotostable("../arborescence/".$_POST['filiere']."/".$_POST['groupe']."/",4);
		 				echo'</div>';
		}
				
			}else {
				echo "<p style='text-algin:center;color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
				echo"<p style='text-align:center;'><a href='./connexion_enseignant.php'>Espace de connexion</a></p>";
		
			
			}
			
	?>			


