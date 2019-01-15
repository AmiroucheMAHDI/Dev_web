<?php
	include_once("../include/fonctions.inc.php");
	echo title_page("Espace Gestionnaire");
	include_once("../include/util.inc.php");
	include_once("../include/header.inc.php");
	//include_once("../include/fonctions.inc.php");
	//require_once("../include/fonctions.inc.php");
	
?>
<body>
	
	<div id="headerConnexionEtudiant">
		<h1>d'Authentification Enseignants</h1>	
	</div>
		
	<div id="connexionEtudiant">
		<?php
			echo formulaireConnexionEnseignant();
						
		
		?>
		<?php 
			if(isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
				$username = $_COOKIE['username'];
				$password = $_COOKIE['password'];
				
				echo "<script>
					document.getElementById('username').value = '$username';
					document.getElementById('password').value = '$password';
					</script>";
			}
		?>  
	</div>
	
<?php
	echo footerConnexionEtudiant();
?>
