 <?php
class Dossiers {
	function Dossiers(){
		$fp = fopen("./log.txt","a+");
		$contenu = "Dossier cree";
		fputs($fp, $contenu);
	}
	

	public function create($nom,$mdp){
		$c_mdp = crypt($mdp,'$1$rasmusle$');
		
		$Authorisation = $nom.":".$c_mdp;
		$contenu = 'AuthType Basic
AuthName "My Protected Area"
AuthUserFile F:/wamp/www/stockage/'.$nom.'/.htpasswd
Require valid-user
';
		//création du dossier
		mkdir("./".$nom, 0777);
		//creation du htacess
		$fp = fopen($nom.'/.htaccess',"a+");
		fputs($fp, $contenu);
		//creation du htpasswd
		$fpwd = fopen($nom.'/.htpasswd',"a+");
		fputs($fpwd, $Authorisation);
		
		$db = mysql_connect('localhost', 'admin', ''); 
	// on sélectionne la base 
	mysql_select_db('test',$db); 
	// on crée la requête SQL 
	$sql = 'INSERT INTO `test`.`verification` (
`id` ,
`nom_dossier` ,
`password`
)
VALUES (
NULL , "'.$nom.'", "'.$c_mdp.'"
);'; 
	// on envoie la requête 
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 

	}
	
	public function compress($nom){
		// On instancie la classe.
		  $zip = new ZipArchive();
		  
		  if(is_dir($nom.'/'))
		  {
			// On teste si le dossier existe, car sans ça le script risque de provoquer des erreurs.
		
			if($zip->open($nom.'.zip', ZipArchive::CREATE) == TRUE)
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
			$zip->deleteName('.htacess');
			$zip->deleteName('.htpasswd');
			$zip->close();
			echo 'DELETE .. ok';
					
		  // On ferme l’archive.
		 // $zip->close();
		
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
	
	
	public function download($dossier){
		$fichier = $dossier.".zip";
		if(file_exists ($fichier)){
			//set example variables
			$filename = $fichier;
			$filepath = "stockage/";

			// http headers for zip downloads
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"".$filename."\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".filesize($filepath.$filename));
			ob_end_flush();
			@readfile($filepath.$filename);
		}else{
			echo "le fichier n'existe pas !!!!! la putain de ta mere";
		}
}

}
?>