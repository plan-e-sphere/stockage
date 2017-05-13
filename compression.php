 <?php 
 class Dossier {

	public function securise($nom,$mdp){
		$c_mdp = crypt($mdp);
		$Authorisation = $nom.":".$c_mdp;
		$contenu = 'AuthName "Page d\'administration protégée"
AuthType Basic
AuthUserFile "./.htpasswd"
Require valid-user';
		//création du dossier
		mkdir("./".$nom, 0777);
		//creation du htacess
		$fp = fopen($nom."/.htacess","a+");
		fputs($fp, $contenu);
		//creation du htpasswd
		$fpwd = fopen($nom."/.htpasswd","a+");
		fputs($fpwd, $Authorisation);
	}
 
	public function compress($nom){
		// On instancie la classe.
		  $zip = new ZipArchive();
		  
		  if(is_dir($nom.'/'))
		  {
			// On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
		
			if($zip->open('test.zip', ZipArchive::CREATE) == TRUE)
		{
		  // Ouverture de l’archive réussie.

		  // Récupération des fichiers.
		  $fichiers = scandir($nom.'/');
		  // On enlève . et .. qui représentent le dossier courant et le dossier parent.
		  unset($fichiers[0], $fichiers[1]);
		  
		  foreach($fichiers as $f)
		  {
			// On ajoute chaque fichier à l’archive en spécifiant l’argument optionnel.
			// Pour ne pas créer de dossier dans l’archive.
			if(!$zip->addFile($nom.'/'.$f, $f))
			{
			  echo 'Impossible d&#039;ajouter &quot;'.$f.'&quot;.<br/>';
			}
		  }
		
		  // On ferme l’archive.
		  $zip->close();
		/*
		  // On peut ensuite, comme dans le tuto de DHKold, proposer le téléchargement.
		  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier).
		  header('Content-Disposition: attachment; filename="Archive.zip"'); //Nom du fichier.
		  header('Content-Length: '.filesize('Archive.zip')); //Taille du fichier.
		  
		  readfile('Archive.zip');*/
		}
		else
		{
		  // Erreur lors de l’ouverture.
		  // On peut ajouter du code ici pour gérer les différentes erreurs.
		  echo 'Erreur, impossible de créer l&#039;archive.';
		}
		  }
		  else
		  {
			// Possibilité de créer le dossier avec mkdir().
			echo 'Le dossier &quot;upload/&quot; n&#039;existe pas.';
		  }
	}
	
}	  ?>