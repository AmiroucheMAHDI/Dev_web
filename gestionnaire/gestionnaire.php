<?php	
			include_once("../include/fonctions.inc.php");
			echo title_page("Espace Gestionnaire");
			include_once("../include/util.inc.php");
			include_once("../include/header.inc.php");

?>					
	<body>
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
	<?php
				echo formulaire_ajouter_filiere();
				
				 
			if(isset($_POST['nameFiliere']) AND isset($_POST['groupe'])){

				// Ajouter filière/groupe:

				if (isset($_POST['ajouter'])) {
					$groupe = str_replace_espace(true,$_POST['groupe']);
					$filiere = str_replace_espace(true,$_POST['nameFiliere']);
					$directory='../arborescence/'.$filiere.'/'.$groupe;
					$directory_Filier = '../arborescence/'.$filier;
				
					if (!file_exists($directory) AND !empty($_POST['groupe'])) {
						
						$listData = array($filiere,$groupe,0);
						$listData2 = array($filiere,0);
						
						if(!file_exists($directory_Filier)){							
							writeDataCSV("./dataEffectifs.csv",$listData2);
						}
						writeDataCSV("./dataEffectifs.csv",$listData);
						creat_Groupe_ID($filiere,$groupe);
						mkdir($directory,0777,true);		
						echo "<p style='color:green;text-align:center'>Groupe ajouté avec succès</p>";
					}
					elseif(!file_exists($directory_Filier) AND empty($_POST['groupe'])){
							mkdir($directory_Filier,0777,true);
							$listData = array($filiere,0);
							writeDataCSV("./dataEffectifs.csv",$listData);
							echo "<p style='color:green;text-align:center'>Filière ajoutée avec succès</p>";
					}	
					else{
						echo "<p style='color:red;text-align:center'>Ce repertoire existe déja!</p>\n";
					}
				}

				// Supprimer filière/groupe:

				if(isset($_POST['supprimer'])){
					$groupe = str_replace_espace(true,$_POST['groupe']);
					$filiere = str_replace_espace(true,$_POST['nameFiliere']);
					if (!empty($_POST['nameFiliere']) AND !empty($_POST['groupe'])) {
						$directory='../arborescence/'.$filiere.'/'.$groupe;
						if (file_exists($directory)) {
							$listWords = array($filiere,$groupe);
							if(file_exists('./dataEtudiant.csv')){
								deleteLineText("./dataEtudiant.csv",$listWords);
							}
							rmAllDir($directory);
							echo "<p style='color:green;text-align:center'>Groupe supprimé avec succès!</p>";
						}else{
							echo "<p style='color:red;text-align:center'>Le groupe que vous souhaitez supprimer n'existe pas!</p>";
						}
					}
					elseif(!empty($_POST['nameFiliere']) AND empty($_POST['groupe'])) {
						$directory='../Informatique/'.$filiere;
						if (file_exists($directory)) {
							$listWords = array($filiere);
							if(file_exists('./dataEtudiant.csv')){
								deleteLineText("./dataEtudiant.csv",$listWords);
							}
							rmAllDir($directory);
							echo "<p style='color:green;text-align:center'>Filière supprimé avec succès!</p>";
						}else{
							echo "<p style='color:red;text-align:center'>La filière que vous souhaitez supprimer n'existe pas!</p>";
						}
					}
				}
			}
			echo'<h2 style="text-align:center;"> Filière/Groupe:</h2>';
			mkmap('../arborescence');
echo footerConnexionEtudiant();
?>

