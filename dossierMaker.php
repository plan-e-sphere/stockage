<?php
	include 'Dossiers.php';
	
	echo "creer un dossier securise <br/>
	<form name = 'fomu' action = 'dossierMaker.php' method = 'POST'>
	nom : <input type = 'text' name='nom' /> <br/>	
	nom : <input type = 'password' name='pass' /> <br/>	
	<input type = 'submit' name='ok' value = 'ok' />
	</form>";
	
	if(isset($_POST['ok'])){
		$nom = $_POST['nom'];
		$mdp = $_POST['pass'];
		$dos= new Dossiers();
		$dos->create($nom,$mdp);
	}
?>