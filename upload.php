<!DOCTYPE html>
<html lang="fr">
<head>

</head>
<body>
	<center><h1>Stock Pahul Upload</h1></center>
	<br/>
	<br/>
	<div id="frm" style = "width : 500px">
	<form name = "fomu" action = "upload.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
			<legend><i>Information d'envoie </i></legend>
			Choisissre le nom de votre dossier <input type = "text" name="nom"/> <br/>
			Choisissez un mot de passe <input type = "password" name = "pass"/> <br/>
			Confirmez le mot de passe <input type = "password" name = "pass2"/> <br/>
			S&eacute;lectionnez vos images: <input type="file" name="files[]" id="files" multiple=""/><br/>
			
			<input type = "submit" name="valide" value = "envoyer" />
		</fieldset>
	</form>

	</div>
	<?php
	include 'Dossiers.php';
	if(isset($_POST['valide'])){
		$nom=$_POST['nom'];
		$mdp1 = $_POST['pass'];
		$mdp2 = $_POST['pass2'];
		if($mdp1==$mdp2){
			$dos = new Dossiers();
			$dos->create($nom,$mdp1);
			
			 for($i=0; $i < count($_FILES['files']['tmp_name']);$i++){
				if(move_uploaded_file($_FILES['files']['tmp_name'][$i],'./'.$nom.'/'.$_FILES['files']['name'][$i]))
				{
					/*** give praise and thanks to the php gods ***/
				   echo 'Upload effectué avec succès !<br/>';
				}
					
				
				else //Sinon (la fonction renvoie FALSE).
				{
					echo $nom.'/'.$_FILES['files']['name'][$i]."--------------<br/>";
					echo 'Echec de l\'upload !<br/>';
				}
			}
			echo "Dossier Cr&eacute;&eacute; pour t&eacute;l&eacute;charger : identifiant : ".$nom."<br/> mot de passe : ".$mdp1;
		}
		else{
			echo "Erreur de mot de passe";
		}
	}
?>
</body>
</html>