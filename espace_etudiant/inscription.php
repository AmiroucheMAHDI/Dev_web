<?php
	include_once("../include/fonctions.inc.php");
	include_once("../include/header.inc.php");
	echo title_page("Depot d'annonce");
	include_once("../include/util.inc.php");
	
?>
<body>
<div>
	<header>
		<h1 style="text-align:center ; color:white">depot d'annonce</h1>
		<nav> 	
			<ul class="menu">	
				<li><a href="../index.html">		Accueil		</a></li>
				<li><a href="./connexion_etudiant.php">		Connexion		</a></li>		
			</ul>
		</nav>
	</header>

	<hr style="width:70% ; color:black;"/>
	<?php
		echo formulaireInscriptionEtudiant();
	?>
	
	
<?php 
	require("../include/footer.inc.php");			
?>