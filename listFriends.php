<?php
session_start();
require_once('connexion.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <title>Netflix</title>
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
        width:50%;
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
       font-size:1.6em;
        text-align:center;
    }

    th
    {
        background:#E50914;
       
        height: 4vh;
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
    font-size: 1.5em;
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
							<a href="">
								<li>Série</li>
							</a>
							<a href="">
								<li>Films</li>
							</a>
							<a href="">
								<li>Nouveautés</li>
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
                            <a href="demandes_amis.php">
							<li><i class="fas fa-bell"></i></li>
                            </a>
						</ul>
					</div>
				</div>
			</div>
            <br><br><br><br>
<?php

$id_membre_connecté = $_SESSION['id'];

if(!empty($_GET['action']))
{
    if($_GET['action']=='supprFriends')
     {
        $id = $_GET['id'];
        $id_membre = $_SESSION['id'];

        $sql = 'DELETE FROM relation WHERE id_receveur = ? and id_demandeur = ?';
        $query = $bdd->prepare($sql);
        $query->execute(array($id_membre,$id));

   
    }
  
}

    $query = 'SELECT DISTINCT m.pseudo, r.id_demandeur, m.id FROM membres m, relation r WHERE  r.id_demandeur = ?  AND r.statut = 2 AND m.id = r.id_receveur';
    $req = $bdd->prepare($query);
    $req->execute(array($id_membre_connecté));
if($req->rowCount() > 0)
{
    echo ' <h1 style="text-align:center; font-size:3em; color:white;">Vous êtes abonné à  
   '.$req->rowCount().' personne(s)
  <br><br></h1><div class="container slideInLeft"><table class="tableau">
<tr>
    <th></th>
    <th></th>
</tr>
';


// if($ligne['id_receveur'] == $id_membre_connecté || $ligne['id_demandeur'] == $id_membre_connecté )



    while($ligne = $req->fetch())
    {

    echo '<tr>
        <td>
            <a href="viewUser.php?action=viewUser&id='.$ligne['id'].'">'.$ligne['pseudo'].'</a>
        </td>

        <td> 
            <a href="listFriends.php?action=supprFriends&id='.$ligne['id'].'"><i class="fas fa-trash-alt" "></i> </a> 
        </td>
    </tr>'
    ;
    }


echo '</table></div>';
}


else
{
    echo "<h3 style='text-align:center; color:white;font-size:3.5em;'>Pas d'abonnement...</h3>";
}


?>

</body>
</html>