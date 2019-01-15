<?php 
/*cette fonction génère une liste de nombre dans un formulaire
*
*@return une liste de nombre
*/

function liste_option($dir){
$var="<option value='filiere'> -- Votre filière -- </option>\n";
$folder = opendir ($dir); 
while ($file = readdir ($folder)) { 
	if ($file != "." && $file != "..") { 
		$pathfile = $dir.'/'.$file; 
		$var.= "<option value='$file'>".$file."</option>\n"; 
		if(filetype($pathfile) == 'dir'){
			 liste_option($pathfile); 
		}
	} 
} 
closedir ($folder);
return $var;	
}
function writeInfo($fileNameCSV,$id,$filiere,$groupe,$image){
		$file = fopen($fileNameCSV,'a+');
		$listData = array($id,$filiere,$groupe,$image);
		$i=fputcsv($file,$listData);
		fclose($file);
	}
function verifyinfo($fileNameCSV,$id){
		$file = fopen($fileNameCSV,'r+');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($id==$line[0]) {
				$find=true;
			}
			return $find;
		}
}
function writeDataEnseignat($fileNameCSV,$nom,$prenom,$id,$mdp){
		$file = fopen($fileNameCSV,'a+');
		$hashedPassWord=password_hash($mdp,PASSWORD_DEFAULT);
		$listData = array($nom,$prenom,$id,$hashedPassWord);
		$i=fputcsv($file,$listData);
		fclose($file);
	}
/*
Cette vérifie si une ligne précise existe dans un fichier csv. 
*/
function existeLineCSV($fileName,$listWords){
		$File = fopen($fileName,'r');
		$exist=false;
		while (!$exist && ($currentLine = fgetcsv($File)) !== false){
			if (count($listWords) == count($currentLine)) {
				$i= 0;
				$equals=true;
				while ( $i < count($listWords) && $equals) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$equals=false;
					}
					$i++;
				}
				if ( $i >= count($listWords)) {
					$exist=true;
				}
			}
		}
		fclose($File);
		return $exist;
	}


/**
 *cette fonction permet l'affichage d'une image prise au hazard dans le dossier passé en parametres
 *@param $dossierImages
 *		 chemin de dossier d'images
 *@return  une balise <figure> contenant l'image choisie
 */
function afficherImage($dossierImages){
	$tabImage=NULL;
	$i=0;
	if(is_dir($dossierImages)){
		if($dossier = opendir($dossierImages)){
			while ($s = readdir($dossier)) {
				if ($s != "." && $s != ".."){
					$tabImage[$i]=$s;
					$i++;
				}
			}
			closedir($dossier);
		}
	}

	$image = $tabImage[rand(0, count($tabImage)-1)];
	$var="\t\n<figure>";
	$var.="\t\t\n<img src='".$dossierImages.'/'.$image."' alt='image choisie aléatoirement' style='width:782px;height: 400px;'/>";
	$var.="\t\t\n<figcaption style='text-align:center'>";
	$var.=$image;
	$var.="\t\t\n</figcaption>";
	$var.="\t\t\n</figure>";		
	return $var; 
}



/**cette fonction génère un formulaire de connexion de l'étudiant
*@return un formulaire de connexion
*/

function formulaireConnexionEtudiant() {
	$var="\t\n<form class='formConnexionEtudiant' method='post' action='espace_etudiant.php'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Un formulaire de connexion</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='username' class='labelId'>Identifiant : </label>";
	$var.="\t\t\t\n<input id='username' name='username' type='text' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='password' class='labelMp'>Mot de passe : </label>";
	$var.="\t\t\t\n<input id='password' name='password' type='password' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<input class='bouttonConnexion' type='submit' name='connexion' value='Connexion'/>";
	$var.="\t\t\t\n<p>Exemple de test : identifiant = Amirouche/ Mot de passe = 1234</p>";
	$var.="\t\t\t\n<p>Si vous n'êtes pas encore inscrits, cliquez sur <a href='./inscription.php'>Inscrivez-vous</a></p>";
	$var.="\t\n</form>";
	return $var;
}


/**cette fonction génère un formulaire d'inscription pour l'étudiant
*@return un formulaire d'inscription
*/
function formulaireInscriptionEtudiant() {
	$var="\t\n<form class='formConnexionEtudiant' action='apres_insc.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Formulaire D'inscription</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='NumEtu' class='labelNum'>Numéro d'étudiant : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='NumEtu' name='NumEtu' type='text' size='8' min='21000000' max='21999999'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='familyName' class='labelNom'>Nom : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='familyName' name='familyName' type='text' size='30' pattern='[a-z][A-Z]{,}' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='firstName' class='labelPrenom'>Prénom : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='firstName' name='firstName' type='text' size='30' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='email' class='email'>Email Universitaire: </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='email' name='email' type='text' size='30' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='Pi' class='labelPi'>Date de première inscription: </label>";
	$var.="\t\t\t\n</div>";			
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='Pi' name='Pi' type='text' size='8' min='21000000' max='21999999' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='dateNai' class='labelDate'>Date de naissance : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='dateNai' name='dateNai' type='date' max='2001-01-01' min='1990-01-01'   autocomplete='off'/>";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='filiere' class='labelFiliere'>Choisissez votre filière : </label>\n";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<select name='filiere' id='filiere'>";
	$var.=liste_option('../arborescence/',0);
   $var.="\t\t\t\n</select>";
	$var.="\t\t\t\n</div>";
   $var.="\t\t\t\n<input style='margin-left:80%'class='suite' type='submit' name='inscription' value='Inscription'/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\n</form>";
	return $var;
	
	}
function formulaireDepoEtudiant($Annee) {
	$var="\t\t\t\n<form class='formConnexionEtudiant' action='upload.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Déposer votre photo ici</h2>";									
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='nombre' class='labelFiliere'>Choisissez votre Groupe: </label>\n";
	$var.="\t\t\t\n</div>";								
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<select name='groupeTd' id='groupeTd' class='champ'>\n";
	$var.= liste_option('../arborescence/'.$Annee.'/');			      				
	$var.= "\t\t\t\n</select>\n";
	$var.="\t\t\t\n</div>";								
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='photoEtu' class='labelPhoto'>Sélectionnez votre photo : </label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='fileToUpload' name='fileToUpload' type='file' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<input class='bouttonValider' type='submit' name='valider' value='Valider'/>";
	$var.="\t\n</form>";
	return $var;


}
function inscriSuite() {
if(isset($_POST['NumEtu']) && isset($_POST['familyName']) && isset($_POST['firstName'])&& isset($_POST['Pi']) && isset($_POST['dateNai']) && isset($_POST['email'])){
		
				// Ajouter un Etudaint
				$numeroDeEtudiant=$_POST['NumEtu'];
	 			$nom=$_POST['familyName'];
			   $prenom=$_POST['firstName'];
			   $dateDepremiereIN=$_POST['Pi'];
			   $email=$_POST['email'];
	 			$Date_de_naissance=$_POST['dateNai'];
	 			$filiere=$_POST['filiere'];	
	 if(($dateDepremiereIN - 1799==substr($numeroDeEtudiant,0,3)) && ('u-cergy.fr'==substr($email,-10,10))) {
	 			$hashedPassWord=password_hash($Date_de_naissance,PASSWORD_DEFAULT);
	 			$listData = array($numeroDeEtudiant,$nom,$prenom,$dateDepremiereIN,$email,$Date_de_naissance,$filiere,$hashedPassWord);
					if(!existeLineCSV('./identification.csv',$listData)){
							writeData('./identification.csv',$numeroDeEtudiant,$nom,$prenom,$dateDepremiereIN,$email,$Date_de_naissance,$filiere,$Date_de_naissance);
							echo"<p style='text-align:center; color:green;'>Étudiant ajouté avec succès!</p><p style='text-align:center; color:green;'> votre identifiant est:".$_POST['NumEtu']."</p><p style='text-align:center; color:green;'> votre mot de passe est:".$_POST['dateNai']."</p>\n";
							echo"<p style='text-align:center; color:red;'><a href='./connexion_etudiant.php'>Espace Connexion</a></p>";
						}else{
							echo"<p style='margin-left:32%; color:red;'>Étudiant existe déjà!</p>\n";
						}
			}else {
					echo"<p style='text-align:center; color:red;'>Merci De vérifier votre numéro d'étudiant ou votre Email Universitaire </p>\n";
					echo"<p style='text-align:center;'><a href='./inscription.php'>Espace d'inscription</a></p>\n";
					
	}
}	
}
function recuAnnee($fileNameCSV,$login) {
		$file = fopen($fileNameCSV,'r+');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]) {
				$find=true;
			}
		}
		return $line[6] ;
}

function verifyEnseignant($fileNameCSV,$login,$password) {
	$file = fopen($fileNameCSV,'r+');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2] && password_verify($password,$line[3])) {
				$find=true;
			}
		}
		if($find){
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
										</div>
										
										<h2 style="text-align:center;">Afficher un trombinoscope :</h2>';
											echo "<p style='color:green; text-align:center;'>Bienvenue ".$line[0]." ".$line[1]."</p>";
											echo formulaireDaffichage();
											echo'<h2 style="text-align:center;"> Arborescence :</h2>';
											mkmap('../arborescence/');
											echo "\t\n</div>";
											echo footerConnexionEtudiant();
		}
		else{ 
			echo "<p style='color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre identifiant et votre mot de passe, attention aux majuscules et aux minuscules</p>";
			echo"<p style='text-align:center;'><a href='./connexion_enseignat.php'>Espace de connexion</a></p>";
		}
		fclose($file);

}
function mkmap($dir){
echo"\t\n<div class='formConnexionEtudiant'>";
echo "<ul>"; $folder = opendir ($dir); 
while ($file = readdir ($folder)) { 
		if ($file != "." && $file != "..") {
 	 		 $pathfile = $dir.'/'.$file; 
 	 		 echo "<li><a href=$pathfile>$file</a></li>"; 
 	 		if(filetype($pathfile) == 'dir'){ 
 	 			 mkmap($pathfile); 
 	 		 }
 		} 
 	 
  	} 
 closedir ($folder); 
	echo "</ul>";
	 echo "\t\n</div>";
}
/**
 *cette fonction permet de vérifier si le login et le mot de passe passés en paramètre
 *existent bien dans le fichier csv spécifié. si c'est le cas, elle affiche le nom et le prénom
 *
 *@param le nom de fichier , login , password
 *
 *@return un message de validation ou d'avertissement 
 */
function verifyEtudiant($fileNameCSV,$login,$password){
		$file = fopen($fileNameCSV,'r+');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[0] && password_verify($password,$line[7])) {
				$find=true;
			}
		}
		if($find){
			echo "<body>
	<div id='headerConnexionEtudiant'>
		<h1>Espace Etudiant</h1>	
	</div>
		
	<div id='connexionEtudiant'>
			<nav>
					<ul>
						<li><a href='./logoutetudiant.php'>Déconnexion</a></li>
						
					</ul>
					<hr style='margin-left:20%;margin-right:20%;'/>
			</nav>";
			echo "<p style='color:green; text-align:center;'>".$line[1]." ".$line[2]." Étudiant(e) en ".$line[6]."</p>";
			echo formulaireDepoEtudiant($line[6]);
			echo footerConnexionEtudiant();
		}
		else{ 
			echo "<p style='color:red;'> Une erreur est survenue durant la connexion. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
			echo"<p style='text-align:center;'><a href='./connexion_etudiant.php'>Espace de connexion</a></p>";
		}
		fclose($file);
}

function formulaire_ajouter_filiere() {
	$var="\t\n<form class='formConnexionEtudiant' action='./gestionnaire.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Ajouter/supprimer :</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='nomFiliere' class='labelNum'>Filières :</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='nomFiliere' name='nameFiliere' type='text' size='30'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='groupe' class='labelNum'>Groupe :</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='groupe' name='groupe' type='text' size='30'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="<ul class='listButtons'>";
	$var.="<li><input style='margin-left: 40%; background-color: bisque;' type='submit' name='ajouter' value='Ajouter'/></li>";
	$var.="<li><input style='margin-left: 40%; background-color: bisque;' type='submit' name='supprimer' value='Supprimer'/></li>";
	$var.="</ul>";
	$var.="\t\n</form>";
	return $var;
	
}
function formulaireDaffichage() {
	$var="\t\n<form class='formConnexionEtudiant' action='Trombino.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Formulaire D'affichage:</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='filiere' class='labelFiliere'>Filière : </label>\n";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='filiere' name='filiere' type='text' size='30' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='groupe' class='labelGroupe'>Groupe: </label>\n";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='filiere' name='groupe' type='text' size='30' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";	
	$var.="\t\t\t\n<input style='margin-left:80%'class='suite' type='submit' name='afficher' value='Afficher'/>";
	$var.="\t\n</form>";
	return $var;

}
function formulaire_ajouter_enseignat() {
	$var="\t\n<form class='formConnexionEtudiant' action='./gestionnaire_Ajouter_Enseignant.php' method='post' enctype='multipart/form-data'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Ajouter/supprimer :</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='nom' class='labelNum'>Nom:</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='nom' name='nom' type='text' size='30'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='prenom' class='labelNum'>Prénom :</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='prenom' name='prenom' type='text' size='30'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='ID' class='ID'>ID :</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='ID' name='ID' type='text' size='30'  autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='mdp' class='mdp'>Mot de Passe:</label>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<input class='champ' id='mdp' name='mdp' type='text' size='30'  autocomplete='off' required/>";
	$var.="<ul class='listButtons'>";
	$var.="<li><input style='margin-left: 40%; background-color: bisque;' type='submit' name='ajouter' value='Ajouter'/></li>";
	$var.="<li><input style='margin-left: 40%; background-color: bisque;' type='submit' name='supprimer' value='Supprimer'/></li>";
	$var.="</ul>";
	$var.="\t\n</form>";
	return $var;
}

/**
*cette fonction génère le footer de la page de connexion pour l'étudiant
*
*/

function footerConnexionEtudiant(){
	
	$var="\t<footer>\n";
	$var.="\t\t<p style='text-align: center;'>ABDELHAMID-MAHDI</p><p style='text-align: center;'>||copyright 2018||</p><p style='text-align: center;'><a href='../index.html'> Accueil</a></p>\n";	
	$var.="	\t</footer>\n";
	$var.="</body>\n";
	$var.="</html>\n";
	return $var;
}

/**cette fonction génère un formulaire de connexion de gestionnaire
*@return un formulaire de connexion
*/

function formulaireConnexionGestionnaire() {
	$var="\t\n<form class='formConnexionEtudiant' method='post' action='validate.php'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'>Un formulaire de connexion</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='username' class='labelId'>Identifiant : </label>";
	$var.="\t\t\t\n<input id='username' name='username' type='text' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='password' class='labelMp'>Mot de passe : </label>";
	$var.="\t\t\t\n<input id='password' name='password' type='password' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";
	$var.="\t\t\t\n<div style='margin-left:20%'>";
	$var.="\t\t\t\n<input id='remember' name='remember' type='checkbox' value='1'/>";
	$var.="\t\t\t\n<label for='remember' class='labelRemember'> Souvenir de moi </label>";
	$var.="\t\t\t\n</div>";										
	$var.="\t\t\t\n<input class='bouttonConnexion' type='submit' name='connexion' value='Connexion'/>";
	$var.="\t\t\t\n<p>Exemple de test : identifiant = admin / Mot de passe = 1234</p>";
	$var.="\t\n</form>";
	return $var;
}

function formulaireConnexionEnseignant() {
	$var="\t\n<form class='formConnexionEtudiant' method='post' action='./espace_enseignant.php'>";	
	$var.="\t\t\t\n<h2 style='text-align:center'> Formulaire de connexion</h2>";
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='username' class='labelId'>Identifiant : </label>";
	$var.="\t\t\t\n<input id='username' name='username' type='text' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<div>";
	$var.="\t\t\t\n<label for='password' class='labelMp'>Mot de passe : </label>";
	$var.="\t\t\t\n<input id='password' name='password' type='password' size='20' autocomplete='off' required/>";
	$var.="\t\t\t\n</div>";					
	$var.="\t\t\t\n<input class='bouttonConnexion' type='submit' name='connexion' value='Connexion'/>";
	$var.="\t\t\t\n<p>Si vous n'êtes pas encore inscrits veuillez connecter le gestionnaire, cliquez sur <a href='../index.html'>Accueil</a></p>";
	$var.="\t\n</form>";
	return $var;
}
/**
 *cette fonction permet d'écrire le nom/prénom, identifiant et mot de passe crypté 
 *dans le fichier csv dont le nom est passé comme paramètre.
 *
 *@param nom de fichier, nom, prénom , identifiant , mot de passe
 */
function writeData($fileNameCSV,$numeroDeEtudiant,$nom,$prenom,$dateDepremiereIN,$email,$Date_de_naissance,$filiere,$mdp){
		$file = fopen($fileNameCSV,'a+');
		$hashedPassWord=password_hash($mdp,PASSWORD_DEFAULT);
		$listData = array($numeroDeEtudiant,$nom,$prenom,$dateDepremiereIN,$email,$Date_de_naissance,$filiere,$hashedPassWord);
		$i=fputcsv($file,$listData);
		fclose($file);
	}
/*
	Cette fonction retourne un tableau html contenant les photos stockées dans le dossier spécifié.
	*/
	
/*
	Cette fonction permet de supprimer une ligne d'un fichier texte, si elle contient la liste de mots passée en parametres.Elle retourne TRUE si la ligne est bien supprimée, FALSE sinon.
	*/

function deleteLineText($fileName,$listWords){
		$originFile = fopen($fileName,'a+');
		$newFile = fopen('temp','a+');
		$lineRemoved=false;
		while ( ($currentLine = fgetcsv($originFile)) !== false ){
			$findWord=true;
			if (count($listWords) <= count($currentLine)) {
				$i= 0;
				while ( $i < count($listWords) and $findWord) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$findWord=false;
					}
					$i++;
				}	
			}else{
				$findWord=false;
			}
			if(!$findWord){
				fputcsv($newFile,$currentLine);
			}else{
				$lineRemoved=true;
			}	
		}
		fclose($originFile);
		fclose($newFile);
		rename('temp',$fileName);
		return $lineRemoved;
}
/*
	Cette fonction retourne une liste contenant des colonnes précises d'un fichier csv  
	*/
	function showListColumnsCSV($fileNameCSV,$listIndexColumns){
		$file = fopen($fileNameCSV,'r');
		$list="<ul style='text-align:center;font-weight: bold;
			font-size: 14pt;'>";
		while ($line=fgetcsv($file)) {
			$list.="<li>";
			foreach ($listIndexColumns as $index) {
				$list.="$line[$index] ";
			}
			$list.="</li>";
		}
		$list.="</ul>";
		fclose($file);
		return $list;
	}
function getPhotosTable($dir,$lineSize=4) {
		$dir=str_replace(' ','_',$dir);
    	$tabFiles = scandir($dir);
    	$k=0;

    	$groupe=substr($dir,strripos($dir,'arborescence'));
    	$groupe=substr($groupe,13);
    	$groupe=str_replace('_',' ',$groupe);

    	$table="<table class='photosTable'>\n";
    	$table.="<tr><th colspan=".$lineSize.">".$groupe."</th></tr>";
    	foreach($tabFiles as $file){
        	if ($file!= "." && $file!= ".."){
				if ($k==0) {
    				$table.="<tr>\n";
    			}
        		$path = $dir.'/'.$file;
        		$lastmod= "Uploaded on : ".date('F d Y ', filectime($path));
				if (is_file($path)) { 
					$image ="<figure>";
					$image.="<img src='".$path."' alt='".$file." width='25%' height='100px title='".$lastmod."'>";
					$studentName=substr_replace($file,'',strpos($file,'.'));
					$studentName=str_replace('_',' ', $studentName);
					$image.="<figcaption style='text-align:center; title='>".$studentName."</figcaption>";
					$image.="</figure>";
					$table.="<td>$image</td>\n";
				}
				$k++;
				if($k==$lineSize) {
    				$table.="</tr>\n";
    				$k=0;
    			}
        	} 	
    	}
    	return $table;
  }
  
  ?>