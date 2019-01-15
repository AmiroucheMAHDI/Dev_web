<?php	
		include_once("../include/fonctions.inc.php");
		echo title_page("Espace Enseignant");
		include_once("../include/header.inc.php");
	if(isset($_POST['valider1'])){	
										
						if(!empty($_POST['filiere'])){
								echo'<body>
										<div>
										<header>
												<h1 style="text-align:center ; color:white"> 	Trombinoscopes des formations </h1>
										<nav> 	
										<ul class="menu">	
												<li><a href="../index.html">		Accueil		</a></li>
												<li><a href="./logoutetudiant.php">		Déconnexion		</a></li>		
										</ul>
										</nav>
										</header>
										<hr style="width:70% ; color:black;"/>';
												echo formulaireDepoEtudiant1();
												echo footerConnexionEtudiant();									
												if(isset($_POST['valider'])){
														if(!empty($_POST['groupeTd']) && !empty($_POST['fileToUpload'])){
															if(!verifyinfo('./fichierDepot.csv',$line[0])){
																	echo'<p>dépot valider !!</p>';
														}else 
													echo'<p style="text-align: center, color:red;">vous avez deja deposé votre photo !!</p> ';
												
										}
									}
										
							}else
							header('location: connexion_etudiant.php');
										
							}else {
							
									echo "<p style='color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
										echo"<p style='text-align:center;'><a href='./connexion_etudiant.php'>Espace de connexion</a></p>";
		
		
							}
	
?>