<?php
	session_start();
	
	require_once('connexion.php');	
    require_once('nav-fonction.php');	
	
	if(!isset($_SESSION['user'])){
		header('Location:index.php');
		exit;
	}
	
	$req = $bdd->prepare("SELECT r.id, u.pseudo, r.id_demandeur,u.id id_utilisateur
		FROM relation r
		INNER JOIN membres u ON u.id = r.id_demandeur
		WHERE r.id_receveur = ? AND r.statut = ?");
		
	$req->execute(array($_SESSION['id'], 1));
				
	$afficher_demandes = $req->fetchAll();

	if(!empty($_POST)){
		extract($_POST);
		$valid = (boolean) true;
		
		if(isset($_POST['accepter'])){
			
			$id_relation = (int) $id_relation;
			
			if($id_relation > 0){
				$req = $bdd->prepare("SELECT id
					FROM relation
					WHERE id = ? AND statut = 1");
				$req->execute(array($id_relation));
			
				$verif_relation = $req->fetch();
				
				if(!isset($verif_relation['id'])){
					$valid = false;
				}
				
				if($valid){
					$req = $bdd->prepare("UPDATE relation SET statut = 2 WHERE id = ? AND id_receveur = ?");
					$req->execute(array($id_relation, $_SESSION['id']));
				}
			}

			header('Location: demandes_amis.php');
			exit;
			
		}elseif(isset($_POST['refuser'])){
			
			$id_relation = (int) $id_relation;
			
			if($id_relation > 0){
				$req = $bdd->prepare("DELETE FROM relation WHERE id = ? AND id_receveur = ?");
				$req->execute(array($id_relation, $_SESSION['id']));		
			}
			
			header('Location: demandes_amis.php');
			exit;
		}
	}
?>
<!doctype html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		

		<link rel="stylesheet" href="style.css">

		<title>Demandes d'amis</title>
	</head>
	<body>
		<style>
        *
{
    padding : 0; 
    margin:0;
    box-sizing:border-box;
}
button
{
    outline:none;
}
a
{
    text-decoration:none;
    color:white;
    font-size:0.8em;
    padding:8px;
}

.img
{
    width:14%;
    padding:15px;
}
body
{
    background-color:#141414;
    font-family: Arial, Helvetica, sans-serif;
}
.container
{
    width:100%;
    margin : auto;
}
.tableau
{
    width:50%;
    color:white;
    text-align:center;
}



td
{
    width:15%;
    border:none;
}

td:nth-child(5)
{
    width:20%;
}
.image_mini
{
    width:65%;
}



    table
    {
        color:white;
        width:90%;
        margin : auto;
        border-collapse:collapse;
        box-shadow : 2px 2px 12px rgba(0,0,0,1);
        font-size:1.4em;
    }

    tr
    {
        transition : all .2s ease-in;
        cursor:pointer;
    }

    .container .tableau tr:hover 
    {
        background:#E50914;
        color: white !important;
        transform : scale(1.04);
        
    }

    th,td
    {
        padding:12px;
       
        text-align:center;
    }

    th
    {
        background:#E50914;
       

    }
    h1
    {
        color:white;
        text-align:center;
        margin:50px;
    }

    input,textarea
{
    
    padding: 16px 20px;
    margin: 5px 0;
    border: none;
    font-size: 16px;
    color: white;
    background-color: #333;
    border-radius: 4px;
    outline: none;
    width: 45%;
    margin: 7px;
    cursor: pointer;
    
}

button[type=submit]
{
    background-color: #E50914;
    font-weight: 700;
    text-transform: uppercase;
    width:40%;
    color:white;
    padding:10px;
    margin-bottom:7px;
    border:hidden;
    border-radius:2px;
    
}



.slideInLeft {

  animation-name: slideInLeft;
  animation-duration: 1s;
  animation-fill-mode: both;
  }


  @keyframes slideInLeft {
  0% {
  transform: translateX(-100%);
  visibility: visible;

  }
  100% {
  transform: translateX(0);
  }
  } 



  .slideInDown {
  animation-name: slideInDown;
  animation-duration: 1.5s;
  animation-fill-mode: both;
  }

  .fa-trash-alt
  {
      font-size:3em;
      text-align:center;
  }


  @keyframes slideInDown {
  0% {
  transform: translateY(-100%);
  visibility: visible;
  }
  100% {
  transform: translateY(0);
  }
  }


  


    @media only screen and (max-width:768px)
    {
        table
        {
            width:90%;
        }
    }

.nbSerie
{
    color:white;text-align:center;margin-top:30px;padding:15px;font-size:1.2em;
}
</style>

        
<h1>Mes demandes d'amis</h1>


<?php
	


foreach($afficher_demandes as $ad){
echo '<div class="container slideInLeft"><table class="tableau">
<tr>
<td><a href="viewUser.php?action=viewUser&id='.$ad['id_demandeur'].'">'.$ad['pseudo'].'</a>
<td><form method="post"> 
<input type="hidden" name="id_relation" value="'.$ad['id'].'"/>
<input style="background-color: green;" type="submit" name="accepter" value="Accepter"/>
<input style="background-color: #e50d13;" type="submit" name="refuser" value="Refuser"/></td>
</form>
</tr><br>'
;
};

echo '</table></div>';


?>
</body>
</html>