<?php
require_once('connexion.php');


$query = 'SELECT id, image_mini, nom, thematique FROM series  ORDER BY id DESC';

if(isset($_GET['search']) AND !empty($_GET['search'])) {
   $search = htmlspecialchars($_GET['search']);

   $query = $bdd->query('SELECT nom,image_mini,id FROM series WHERE nom LIKE "%'.$search.'%" ORDER BY id DESC');
   
   if($query->rowCount() == 0) {
      $query = $bdd->query('SELECT nom, image_mini, id FROM series WHERE CONCAT(nom, thematique) LIKE "%'.$search.'%" ORDER BY id DESC');
   } 
}

$nbNotif = 'SELECT * FROM  relation  WHERE id_receveur = ? AND statut = 1';
$req = $bdd->prepare($nbNotif);
$req->execute(array($_SESSION['id']));
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    </head>
<body>
    <style>
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
	width: 9rem;
	margin: 5px;
	margin-left : -10px;
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
    font-size: 1.4rem;
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
	margin-right: 95px;
	
}


.fa-user-circle,.fa-user-cog,.fa-bell,.fa-chart-pie
{
	font-size: 1.4em !important;
}
.fa-user-circle:hover,.fa-user-lock:hover,.fa-bell:hover,.fa-user-cog:hover,.fa-chart-pie:hover
{
	color: #E50914;
	transition: 0.4s;
}

.conteneur
{
    padding: 0.90rem 0.75rem 0 0.75rem;
}

.menu-left
{
    margin-left:65px;
}

.notif
{
	width: 20px;
	height: 20px;
	border-radius: 50%;
	background-color:#E50914;
	position: absolute;
    right: 4.5%;
    top: 2%;
   text-align:center;
}
    </style>

<div class="conteneur">
        <div class="hero">
			<div class="header">
				<div class="logo">
					<a href="pageAccueil.php"><img src="images/logo.png" alt=""/></a>
				</div>
				<div class="menu">
					<div class="menu-left">
						<ul>
							<a href="pageAccueil.php">
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
					<div class="menu-right">
						<ul>
						<form method="GET" action="pageAccueil.php">
							<li class="recherche">
								<div class="search-box">
									<input class="search-txt" type="text" name="search" placeholder="Rechercher">
									<a  class="search-btn" type="submit">
										<i class="fas fa-search"></i>
									</a>
								</div>
						</form>
							</li>
							<?php 
							if($_SESSION['admin'] ==1 )
							{
							   echo '<a href="admin.php">
							   <li><i class="fas fa-user-lock"></i></i></li>
						   </a>';
							}
							
							?>
							<a href="profil.php">
								<li><i class="far fa-user-circle "></i></li>
							</a>
							<?php
								if($_SESSION['admin'] ==1 )
								{
							echo '<a href="test.php">
							<li><i class="fas fa-chart-pie"></i></li>
							</a>';
								}
							?>
							<a href="demandes_amis.php">
							<li>
								<?php
								if($req->rowCount()>0)
								{
									echo	'<div class="notif"><span>'.$req->rowCount().'</span></div>
								<i class="fas fa-bell"></i>';
								}
								else
								{
									echo '<i class="fas fa-bell"></i>';
								}
								?>
							</li>
							</a>
						</ul>
					</div>
				</div>
			</div>
    </div>

</body>
</html>