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
        width:90%;
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



<?php
session_start();
require_once('connexion.php');

if($_SESSION['admin'] == 0)
{
    header('Location:index.php');
}

require_once('nav-fonction.php'); 

echo '<br>';

if(!empty($_GET['action']))
{
    if($_GET['action']=='supprComm')
     {
        $id = $_GET['id'];
    

        $sql = 'DELETE FROM avis WHERE id_serie = ?';
        $query = $bdd->prepare($sql);
        $query->execute(array($id));

    }
  
}

$query = 'SELECT DISTINCT t1.note, t1.id_serie, t1.commentaire, t2.pseudo, t3.id, t3.image_mini FROM avis t1, membres t2, series t3 WHERE t3.id = t1.id_serie AND t1.id_membre = t2.id ';
$req = $bdd->prepare($query);
$req->execute();


echo '<div class="container slideInLeft"><table class="tableau">
<tr>
    <th>Série</th>
    <th>Membre</th>
    <th>Note</th>
    <th>Commentaire</th>
    <th>Action</th>
</tr>
';
while($ligne = $req->fetch())
{
echo '<tr>
<td><img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/></td>
<td>'.$ligne['pseudo'].'</td>
<td>'.$ligne['note'].'</td>
<td>'.$ligne['commentaire'].'</td>
 <td>
    <a href="gestion_commentaire.php?action=supprComm&id='.$ligne['id_serie'].'"><i class="fas fa-trash-alt" "></i> </a> 
   
    </td>
</tr>'
;
};

echo '</table></div>';
$req->closeCursor();


?>
</body>
</html>