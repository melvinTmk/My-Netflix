<?php
require_once('connexion.php');
session_start();

if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

if(isset($_POST['couleur_avis']) && isset($_POST['grille']))
{				
    $id_membre = $_SESSION['id'];

    $color = htmlspecialchars($_POST['couleur_avis']);
    $grille = htmlspecialchars($_POST['grille']);

				$check = $bdd->prepare('INSERT INTO preferences(id_membre, grille, couleur_avis) VALUES(:id_membre, :grille, :couleur_avis)');
				$check->execute(array(
					'id_membre' => $id_membre,
					'grille' => $grille,
					'couleur_avis' => $color,));	
			
				// $data = $check->fetch();
	
                header('Location:pageAccueil.php');
}

// if(!empty($_GET['action']))
// {
//     if($_GET['action']=='majok')
//     { 
   
//         $id_membre = $_SESSION['id'];

//         $couleur_avis = htmlspecialchars($_POST['couleur_avis']);
//         $grille = htmlspecialchars($_POST['grille']);

//         $sql = 'UPDATE preferences SET  grille = ? , couleur_avis = ?  WHERE id_membre = ?';
//         $query = $bdd->prepare($sql);
//         $query->execute(array($grille, $couleur_avis, $id_membre));
//     }
//      header('Location:pageAccueil.php?majok');
// }

?>


<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=p">
    <title>Préférences</title>
</head>
<body>
    <form action="preferences.php?action=majok" method="POST">
        <input type="color" id="head" name="couleur_avis" value="#e66465">
        <label for="head">Color</label>
        <input type="number" name="grille">
        <input type="submit">
    </form>
</body>
</html> -->