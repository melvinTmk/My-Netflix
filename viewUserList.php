<?php
session_start();
require_once('connexion.php');

if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

$query = 'SELECT id, image_mini, nom, thematique FROM series  ORDER BY id DESC';

if(isset($_GET['search']) AND !empty($_GET['search'])) {
   $search = htmlspecialchars($_GET['search']);

   $query = $bdd->query('SELECT nom,image_mini,id FROM series WHERE nom LIKE "%'.$search.'%" ORDER BY id DESC');
   
   if($query->rowCount() == 0) {
      $query = $bdd->query('SELECT nom, image_mini, id FROM series WHERE CONCAT(nom, thematique) LIKE "%'.$search.'%" ORDER BY id DESC');
   }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <title>MiniNetflix</title>
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

    .hero {
	width: 100%;
	margin: 0 auto;
	height: 100%;
	padding: 0 3rem;
}
.header {
	display: flex;
	align-items: center;
}
.logo img {
	width: 11rem;
}
.menu {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
	width: 100%;
    align-items: center;
}
.menu-left,
.menu-right {
	display: flex;
	color: #e5e5e5 !important;
    font-size: 1.5rem;
}
a
{
    text-decoration: none;
    color: white;

}
.menu ul {
	display: flex;
	list-style: none;
	align-items: center;
}
.menu ul li {
	padding-right: 0.9rem;
}
.menu .user img {
	width: 2rem;
	margin-right: 0.5rem;
}
.menu .user {
	display: flex;
	align-items: center;
}
.menu i {
	font-size: 20px;
}
.menu-right ul li {
	padding-right: 1.5rem;
}

.menu-left
{
    margin-left: 20px;
}

.search-box
{
    position: absolute;
    transform: translate(-50%,-50%);
    background-color:transparent;
    height: 40px;
    border-radius: 40px;
 
	
	
}
.search-btn
{
    position: relative;
    color: white;
    float: right;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color:transparent;
    display: flex;
    justify-content: center;
    align-items: center;

}

.search-box:hover > .search-txt
{
    width: 170px;
	padding: 0 6px;
}

.search-box:hover > .search-btn
{
	background-color: #E50914;
	
}

.search-txt
{
    border:none;
    background: none;
    outline: none;
    float: left;
    padding: 0;
    color: white;
    font-size: 16px;
    transition: 0.4s;
    line-height: 40px;
    width: 0px;
}

.recherche
{
	width: 100%;
	margin-right: 135px !important;
	
}

.fa-user-circle,.fa-user-cog,.fa-bell
{
	font-size: 1.4em !important;
}
.fa-user-circle:hover,.fa-user-lock:hover,.fa-bell:hover,.fa-user-cog:hover
{
	color: #E50914;
	transition: 0.4s;
}
.fa-trash-alt,.fa-play-circle
{
    font-size: 2em;
}

.fa-trash-alt:hover, .fa-play-circle:hover
{
    transform:rotate(360deg);
    transition:all 1s ease; 
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



@keyframes slideInDown {
0% {
transform: translateY(-100%);
visibility: visible;
}
100% {
transform: translateY(0);
}
}

</style>
<br>
		<div class="hero">
			<div class="header">
			<div class="logo">
			<a href="pageAccueil.php"><img src="images/logo.png" alt="" /></a>
		</div>

		<div class="menu">
			<div class="menu-left">
				<ul>
					<a href="pageAccueil.php">
						<li>Accueil</li>
					</a>
							<a href="series.php">
								<li>Série</li>
							</a>
							<a href="films.php">
								<li>Films</li>
							</a>
							<a href="maListe.php">
								<li>Ma Liste</li>
							</a>
						</ul>
					</div>
					<div class="menu-right">
						<ul>
						<form method="GET" >
							<li class="recherche">
								<div class="search-box">
								
									<input class="search-txt" type="text" name="search" placeholder="Rechercher">
									<a class="search-btn" type="submit">
										<i class="fas fa-search"></i>
									</a>
									
								</div>
								</form>
							</li>
							<?php 
							if($_SESSION['admin'] ==1 )
							{
							   echo '<a href="admin.php">
							   <li><i class="fas fa-user-lock"></i></li>
						  			 </a>';
							}
							
							?>
							<a href="profil.php">
								<li><i class="far fa-user-circle "></i></li>
							</a>
							<a href="">
								<li><i class="fas fa-user-cog"></i></li>
							</a>
							<li><i class="fas fa-bell"></i></li>
						</ul>
					</div>
				</div>
			</div>
            <br><br><br><br>
<?php

$id_membre_connecté = $_SESSION['id'];
$id_fiche_membre =  $_GET['id_membre'];

$query = 'SELECT DISTINCT s.id, s.nom, s.thematique, 
s.image_mini FROM series s, membres t2, favoris t3 WHERE t3.id_membre = ? AND s.id = t3.id_serie ';
$req = $bdd->prepare($query);
$req->execute(array($id_fiche_membre));


if($req->rowCount() > 0)
{
    echo ' <h1 style="text-align:center; font-size:3em; color:white;">Sa Liste </h1><br><br><div class="container slideInLeft"><table class="tableau">
<tr>
    <th>Série</th>
    <th>Titre</th>
    <th>Thème</th>
    <th></th>
</tr>
';




while($ligne = $req->fetch())
{

echo '<tr>
<td><img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/></td>
<td>'.$ligne['nom'].'</td>
<td>'.$ligne['thematique'].'</td>
 <td> 
    <a href="viewSerie.php?action=view&id='.$ligne['id'].'"><i class="far fa-play-circle" "></i> </a> 
    </td>
</tr>'
;
};


echo '</table></div>';
}



else
{
    echo "<h3 style='text-align:center; color:white;font-size:3.5em;'>Liste vide...</h3>";
}


?>

</body>
</html>