<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
	try
	{
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Connexion à la base de données
		
		$NOM_BASE_DE_DONNEES = 'mynetflix';
		$UTILISATEUR = 'root';
		$MOT_DE_PASSE = '';	// 'root' sur MAC
		
		//Version avec ERREUR SQL intégrée
		$bdd = new PDO('mysql:host=localhost;dbname='.$NOM_BASE_DE_DONNEES.';charset=utf8', $UTILISATEUR, $MOT_DE_PASSE, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	catch(Exception $e)	//Affichage message erreur éventuelle
	{
		die('<b>Erreur:</b> '.$e->getMessage());
	}

	function query($sql,$data= array())
	 {
		$req = $this->connexion->prepare($sql);
		$req->execute($data);

		return $req;
	 }
?>	
