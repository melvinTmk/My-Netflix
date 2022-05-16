<?php
session_start();

require_once('connexion.php');

if($_SESSION['admin'] == 0)
{
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <title>Admin</title>
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
        width:80%;
        margin : auto;
        border-collapse:collapse;
        box-shadow : 2px 2px 12px rgba(0,0,0,1);
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
     opacity: .7;
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

.btn-submit:hover
{
    background-color: #e50d13;
    transition : all 0.3s ease-in-out;
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

  .btn-submit:hover
{
    background-color: #e50d13;
    transition : all 0.3s ease-in-out;
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
    color:white;
    text-align:center;
    font-size:1.2em;
}
</style>
<?php require_once('nav-fonction.php'); 



$querySerie = 'SELECT id, image_mini, nom, thematique, date_format(date_creation,\'%d/%m/%Y\') AS date_creation FROM series  ORDER BY id DESC';
if(isset($_GET['searchSerie']) AND !empty($_GET['searchSerie'])) 
{
   $searchSerie = htmlspecialchars($_GET['searchSerie']);

   $querySerie = $bdd->query('SELECT id, image_mini, nom, thematique, date_format(date_creation,\'%d/%m/%Y\') AS date_creation FROM series WHERE nom LIKE "%'.$searchSerie.'%" ORDER BY id DESC');
   
   if($querySerie->rowCount() == 0) 
   {
      $querySerie = $bdd->query('SELECT id, image_mini, nom, thematique, date_format(date_creation,\'%d/%m/%Y\') AS date_creation FROM series WHERE CONCAT(nom) LIKE "%'.$searchSerie.'%" ORDER BY id DESC');
   }
}

?>

<br> <br> <br> <br> 
<!-- <a href="admin.php?action=ajouter"><i class="fas fa-plus-circle fa-5x ajouter"></i></a> -->

<div class="slideInDown" style="display:flex; justify-content:center; font-size:1.3em;">
    <a href="gestion_user.php">Gérer les utilisateurs</a>
    <a href="gestion_commentaire.php">Gérer les commentaires</a>
</div>
<br>
 <div class="barre_serie" style="width:100%; justify-content:center;display:flex;">
     <form method="GET">
        <input type="search-txt" id="search-serie" name="searchSerie">
        <input class="btn-submit" type="submit" value="Chercher une série">
     </form>
 </div>


 <?php 

$query = 'SELECT count(id) AS nbr FROM series';

$req = $bdd->prepare($query);
$req->execute();
$ligne = $req->fetch();
$nombre = $ligne['nbr'];
echo "<h1 class='slideInLeft nbSerie' style=''> Il y a " . $nombre. " séries/films dans le catalogue</h1><br>";

?>

<a href="ajouter.php" style="display:flex;justify-content:center;align-item:center;"><i style="font-size:5em;" class="fas fa-plus-circle"></i></a>
<br>

<?php




//////////////////////////////////////////       TRAITEMENT DES SÉRIES ET FILMS     /////////////////////////////////////////////////

if(!empty($_GET['action']))
{
    if($_GET['action'] == 'fiche')
    {
        $id = $_GET['id'];
        // echo "<h3 style='color:white;'>ID = ".$id. "</h3>";
        $sql = 'SELECT  nom, thematique, resume, trailer FROM series WHERE id =?';
        $req = $bdd->prepare($sql);
        $req->execute(array($id));

        $ligne = $req->fetch();


        echo "<h1 class='slideInLeft'>Fiche : </h1>";

        echo "<table class='slideInLeft'>
        <tr><td><b>Nom : </b>".$ligne['nom']."</td></tr>
        <tr><td><b>Thematique : </b>".$ligne['thematique']."</td></tr>
        <tr><td><b></b>".$ligne['trailer']."</td></tr>
        <tr><td style='font-size:1em;'><b>Resume : </b>".$ligne['resume']."</td></tr>
        </table>
        ";
       exit();
    }
    
}

if(!empty($_GET['action']))
{
    if(!empty($_GET['action'] == "maj"))
    {
        $id = $_GET['id'];
        // echo "<h3 style='color:white;'>ID = ".$id. "</h3>";
        $sql = 'SELECT  nom, thematique, resume, trailer FROM series WHERE id =?';
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $ligne = $req->fetch();

        echo "<h1 class='slideInLeft'>Modifier : </h1>";

        echo '<form class="slideInLeft" method="post" action="admin.php?action=majok&id='.$id.'">';
        
        echo "<table style='border:hidden !important;'>
        <tr style='border:hidden !important; '><td ><b>Nom : </b>".$ligne['nom']."</td></tr>
        <tr style='border:hidden !important; '><td><input type='text' name='nom' value=".$ligne['nom']."></td><tr>
        <tr style='border:hidden !important; '><td><b>Thématique : </b>".$ligne['thematique']."</td></tr>
       <tr style='border:hidden   !important; '> <td><input type='text' name='thematique' value=".$ligne['thematique']."></td></tr>
        <tr style='border:hidden !important; '><td><b> Resumé : </b></td></tr>
        <td style='border:hidden !important; '><textarea name='resume'>".$ligne['resume']."</textarea></td>
        <tr style='border:hidden !important; '><td><b>Trailer : </b></td></tr>
        <td style='border:hidden !important; '><textarea name='trailer'>".$ligne['trailer']."</textarea></td>
        <tr style='border:hidden !important; '><td><button type='submit'>Modifier</button></td></tr>
        </table>    
        </form>
        ";
        exit();

    }

}


if(!empty($_GET['action']))
{
    if($_GET['action']=='majok')
    {
        $id = $_GET['id'];

        $nom = $_POST['nom'];
        $thematique =$_POST['thematique']; 
        $resume =$_POST['resume']; 
        $trailer =$_POST['trailer'];

        $sql = 'UPDATE series SET  nom = ?, thematique = ?, resume = ?, trailer = ?  WHERE id =?';
        $query = $bdd->prepare($sql);
        $query->execute(array($nom,$thematique,$resume,$trailer,$id));

      
    }
   
}




if(!empty($_GET['action']))
{
    if($_GET['action']=='suppr')
     {
        $id = $_GET['id'];

        $sql = 'DELETE FROM series WHERE id = ?';
        $query = $bdd->prepare($sql);
        $query->execute(array($id));

    }
    // header('Location:admin.php');
}



    

if(!empty($_GET['action']))
{
    if($_GET['action']=='majok')
    {
        $id = $_GET['id'];

        $nom = $_POST['nom'];
        $thematique =$_POST['thematique']; 
        $resume =$_POST['resume']; 
        $trailer =$_POST['trailer'];

        $sql = 'UPDATE series SET  nom = ?, thematique = ?, resume = ?, trailer = ?  WHERE id =?';
        $query = $bdd->prepare($sql);
        $query->execute(array($nom,$thematique,$resume,$trailer,$id));
    }
    // header('Location:admin.php');
}


$query = 'SELECT id, nom, thematique, date_format(date_creation,\'%d/%m/%Y\') AS date_creation, 
image_mini FROM series ORDER BY date_creation DESC';
$req = $bdd->prepare($query);
$req->execute();


echo '<div class="container slideInLeft"><table class="tableau">
    <tr>
        <th>Série</th>
        <th>Titre</th>
        <th>Thème</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
';

if(isset($_GET['searchSerie']) AND !empty($_GET['searchSerie'])) 
{
    
    
    
    if($querySerie->rowCount() > 0)
{
    while($serie = $querySerie->fetch())
    {
        echo '  <tr>
        <td><img class="image_mini" src="images/'.$serie['image_mini'].'.png"/>
        <td>'.$serie['nom'].'</td>
        <td>'.$serie['thematique'].'</td> 
        <td>'.$serie['date_creation'].'</td> 
        <td> <a href="admin.php?action=fiche&id='.$serie['id'].'"> <i class="fas fa-eye"></i> </a> 
        <a href="admin.php?action=maj&id='.$serie['id'].'"><i class="far fa-edit"></i></a>  
        <a href="admin.php?action=suppr&id='.$serie['id'].'"><i class="fas fa-trash-alt" "></i> </a> 
       
        </td>
        </tr>';
    }
}
else
{
    echo "Aucun résultat <br>";
}
}



while($ligne = $req->fetch())
{
  
    echo '<tr>
    <td><img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/></td>
    <td>'.$ligne['nom'].'</td>
    <td>'.$ligne['thematique'].'</td>
    <td>'.$ligne['date_creation'].'</td>
     <td> <a href="admin.php?action=fiche&id='.$ligne['id'].'"> <i class="fas fa-eye"></i> </a> 
        <a href="admin.php?action=maj&id='.$ligne['id'].'"><i class="far fa-edit"></i></a>  
        <a href="admin.php?action=suppr&id='.$ligne['id'].'"><i class="fas fa-trash-alt" "></i> </a> 
       
        </td>
    </tr>'
    ;
};


echo '</table></div>';
$req->closeCursor();



?>
<style>

.fa-trash-alt, .fa-edit, .fa-eye
{
    transition:font-size 0.4s;
    transition:transform 0.7s;
}
.fa-trash-alt:hover, .fa-edit:hover, .fa-eye:hover
{
   font-size:1.3em;
   transform: rotate(360deg);
}


.ajouter
{
    color:white;
    position:relative;
    display:flex;
    justify-content:center;
    margin-top:25px;
    overflow:hidden;
}

.ajouter:hover
{
    color:#E50914;
    transition: all 0.4s;
}

</style>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</body>





