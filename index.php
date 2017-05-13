<!DOCTYPE html>
<html lang="fr">
<head>

</head>
<body>
	<center><h1>Stock Pahul</h1></center>
	<br/>
	<br/>
	<?php echo getcwd(); ?>
	<br/>
	<?php echo realpath('index.php'); ?>
	<form name = "fomu" action = "script.php" method = "POST">
		<fieldset>
			<legend><i>Information de r&eacute;cup&eacute;ration </i></legend>
			nom du groupe <input type = "text" name="nom"/> <br/>
			mot de passe <input type = "password" name = "pass"/> <br/>
			<input type = "submit" value = "r&eacute;cup&eacute;rer" />
		</fieldset>
		<a href="dossierMaker.php">poster fichiers</a>
	</form>
</body>
</html>