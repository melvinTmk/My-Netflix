<?php
require_once('connexion.php');
require_once('connexion_traitement.php');

if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

//  var_dump($id);
// $req_commentaire = $DB->query("SELECT sc.* , DATE_FORMAT(sc.date_creation, 'Le'%d/%m/%Y') as date_c, u.pseudo 
// FROM avis sc 
// LEFT JOIN membres u on u.id = sc.id_membres 
// WHERE id_serie = ? 
// ORDER BY sc.date_creation DESC"
// , array($get_id));

// $req_commentaire = $req_commentaire->fetch();


// require_once('connexion_traitement.php');
// $query = 'SELECT * FROM avis';
// $req = $bdd->prepare($query);
// $req->execute();


// while($ligne = $req->fetch())
// {
//   if($ligne['id_serie'] == $get_id)
//   {
// 	  echo $ligne['commentaire'];
//   }
	
// }
$id_membre = $_SESSION['id'];
$get_id = $_GET['id'];



$couleur = 'SELECT couleur_avis FROM preferences WHERE id_membre = ?';
$req_couleur = $bdd->prepare($couleur);
$req_couleur->execute(array($id_membre));
$ligne = $req_couleur->fetch();



	
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	<link rel="stylesheet" href="style/viewSerie.css">
	<title>MyNetflix</title>
</head>

<body>

	<div class="header">
		<div class="logo">
			<a href="pageAccueil.php"><img src="images/logo.png" alt="" /></a>
		</div>

		<div class="menu">
			<div class="menu-left">
				<ul>
					<a href="pageAcceuil.php">
						<li>Accueil</li>
					</a>
					<a href="series.php">
						<li>Séries</li>
					</a>
					<a href="films.php">
						<li>Films</li>
					</a>
					<a href="maListe.php">
						<li>Ma Liste</li>
					</a>
				</ul>
			</div>

		</div>
	</div>

<style>
	.fa-heart
	{
		
		font-size:3.3em;
		position:absolute; 
		top:87%; 
		left:60%;
	}
	#coeur
	{
		color:red;
		transition:all 0.2s ease;
	}
	#pasCoeur
	{
		color:white;
		transition:all 0.2s ease;
	}

	.couleurComm
	{
		color:<?=$ligne['couleur_avis']; ?> !important;
	}
</style>

	<!-------------------------------------  SECTION VIDÉO + SUGGESTIONS --------------------------------------------------->
	<?php 

$query = 'SELECT t1.likes, t1.id_serie, t3.id FROM favoris t1, membres t2, series t3 WHERE t1.id_membre = t2.id AND t3.id = t1.id_serie';
$req = $bdd->prepare($query);
$req->execute(); 
$ligne = $req->fetch();


	echo '<a id="coeur" href="actionLike.php?id='.$get_id.'&id_membre='.$id_membre.'"><i class="fas fa-heart"></i></a> ';





	

	
	if(!empty($_GET['action']))
	{
		if($_GET['action'] == 'view')
		{
		 $get_id = $_GET['id'];
		 $id_membre = $_SESSION['id'];
		

			// echo "<h3 style='color:white;'>ID = ".$id. "</h3>";
			$sql = 'SELECT trailer, thematique, id, nom, resume, date_format(date_creation,\'%d/%m/%Y\') AS date_creation FROM series WHERE id = ?';
			$req = $bdd->prepare($sql);
			$req->execute(array($get_id));

			$ligne = $req->fetch();
			echo "<div class='iframe '>".$ligne['trailer']."</div>";
			
			echo "<h1 class='titreSerie'>".$ligne['nom'].'<br> '.'<span> Date de sortie : '.$ligne['date_creation']."</span></h1>";
			
			echo "<div style=' width: 60% ;
			color: white;margin-left:35px; font-size:1.2em;'>".$ligne['resume']."</div>";

			
    
			
		}
		
	}


	$query = 'SELECT id, image_mini, serie_ou_film, thematique FROM series ';
	$req = $bdd->prepare($query);
	$req->execute();
	echo "<br><br><br><br><br>";
	echo '<div class="suggestion ">';
	while($suggestion = $req->fetch())
	{
		if($ligne['thematique'] == $suggestion['thematique'])
		{
			if($ligne['id'] != $suggestion['id'] )
			echo  
		'
			<a href="viewSerie.php?action=view&id='.$suggestion['id'].'">
				<img class="image_mini" src="images/'.$suggestion['image_mini'].'.png"/>
				</a>
			';
		}
		
	};
 
echo "</div>";




if(isset($_POST['commentaire']) && isset($_POST['note']))
{				
				if($_POST['note'] <= 20)
				{
					$commentaire = htmlspecialchars($_POST['commentaire']);
					$note = htmlspecialchars($_POST['note']);

				$check = $bdd->prepare('INSERT INTO avis(id_membre, id_serie, note, commentaire) VALUES(:id_membre, :id_serie, :note, :commentaire)');
				$check->execute(array(
					'id_membre' => $id_membre,
					'id_serie' => $get_id,
					'note' => $note,
					'commentaire' => $commentaire));
				}
				
				else
				{
					echo "<div style='color:red;'>Insérer une note entre 0 et 20</div>";
				}
			
			
				// $data = $check->fetch();
	
}



			$query = "SELECT a.id_serie, a.id_membre, a.note, a.commentaire, a.date_creation, m.pseudo, m.id FROM avis a, membres m WHERE a.id_serie = ? and a.id_membre = m.id";
			$req = $bdd->prepare($query);
			$req->execute(array(
			$get_id,
			));


			// $req = $DB->prepare("SELECT a.*, m.pseudo,  
			// FROM avis a, membres m
			// LEFT JOIN membres m ON m.id = a.id_membre 
			//  ");
			// $req->execute(array($get_id));

		    // $query_id = 'SELECT id, image_mini, nom, thematique FROM series  ORDER BY id DESC';
			// $req_id = $bdd->prepare($query_id);
			// $req_id->execute();
			

			

	?>


	<form class="formulaire-commentaire" method="POST" action="">
		<label class="donnez" for="desc">Donnez votre avis :</label><br>
		<div class="wrapper">
			<div class="input-data">
				<input name="commentaire" type="text" required>
				<div class="underline">
				</div>
				<label>Ajouter un commentaire</label>
			</div>
		</div>
		<br><br>

		<div class="wrapper">
			<div class="input-data">
				<input name="note" type="number" required>
				<div class="underline">
				</div>
				<label>Ajouter une note</label>
			</div>
		</div>
		<br>
		<input type="submit">
	</form>

	<!------------------------------------------------------------------------------------------->
	<br><br><br><br>

	<?php


	echo "<div class='commentContainer'>";
	$nbCommentaire = $req->rowCount();
	echo "<div style='color:white;'>".$nbCommentaire." Commentaire(s)</div><br>";
	while($comm = $req->fetch())
	{	
		
		$mots = $bdd->query('SELECT mot FROM filtre');
		$mots = $mots->fetchAll(PDO::FETCH_COLUMN);
		 
		$rp = $bdd->query('SELECT rp FROM filtre ');
		$rp = $rp->fetchAll(PDO::FETCH_COLUMN);
		 
		
		 
		$comm['commentaire'] = str_replace($mots, $rp, strtolower($comm['commentaire']));
		$comm['commentaire'] = ucfirst($comm['commentaire']);
				 
		echo '<div class="comment">
				<img src="img/avatar-3.png" alt="">
				<ul>
					<li>De :<b>	<a  href="viewUser.php?action=viewUser&id='.$comm['id'].'"> '.$comm['pseudo'].'</b></a></li>
					<li class="comm couleurComm">'.$comm['commentaire'].'</li>
					<li style="font-size:0.7em;color:grey;">Le '.date('d/m/y à H:i:s', strtotime($comm['date_creation'])).'</li>
				</ul>
			</div><br><br><br>';

	}
	
		echo '</div>';

		  
		
	
			
?>

 <!-- <script>
	 const coeur = document.getElementById('coeur');

	 coeur.addEventListener('click', () =>{
		coeur.classList.toggle('active');
    
});

 </script> -->
</body>
</html>