<?php
	include 'Dossiers.php';
	
	$nom = $_POST['nom'];
	$mdp = $_POST['pass'];
	$find = false;
	$next = true;
	$cpt=0;
	$c_mdp = crypt($mdp,'$1$rasmusle$');
	$db = mysql_connect('localhost', 'admin', ''); 
	// on sélectionne la base 
	mysql_select_db('test',$db); 
	// on crée la requête SQL 
	$sql = 'SELECT * FROM verification'; 
	// on envoie la requête 
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
	// on fait une boucle qui va faire un tour pour chaque enregistrement 
	while($data = mysql_fetch_assoc($req)) { 
		// on affiche les informations de l'enregistrement en cours 
		if($data['nom_dossier'] == $nom){
			if($data['password']==$c_mdp){
				$find = true;
				$dos=new Dossiers();
				$dos->compress($nom);
				echo "Archive OK !";
				echo "<br/><a href='".$nom.".zip'> click ici </a>";
				//$dos->download($nom);
				
			}
		}	
		
	} 
	if($find==false){
		echo "ERREUR d\'identification";
	}

	// on ferme la connexion à mysql 
	mysql_close(); 
	echo "<br/><a href='index.php'>retour</a> <br/>";
	
?>