<?php
if(isset($_POST['inscription'])){
	include_once("../include/fonctions.inc.php");
	echo title_page("Espace Étudiant");
	include_once("../include/util.inc.php");
	include_once("../include/header.inc.php");
	
	
	echo"
	<div id='headerConnexionEtudiant'>
		<h1> d'Authentification de l'Étudiant</h1>	
	</div>
		
	 <div class='formConnexionEtudiant'>";
	
	   echo inscriSuite();
	

    echo'</div>

</body>
</html>';
}else {
	echo "<p style='text-algin:center;color:red;'> Une erreur est survenue durant votre inscription. Vérifiez bien votre email et votre mot de passe, attention aux majuscules et aux minuscules</p>";
	echo"<p style='text-align:center;'><a href='./connexion_etudiant.php'>Espace de connexion</a></p>";
}
?>