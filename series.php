<?php
session_start();

require_once('connexion.php');

$query = 'SELECT id, image_mini FROM series ';
$req = $bdd->prepare($query);
$req->execute();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style/series4.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <title>Netflix</title>
</head>
<body>
    
<div class="container">
		<br>
		<div class="hero">
			<div class="header">
				<div class="logo">
					<img src="images/logo.png" alt=""/>
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
									<a href="" class="search-btn" type="submit">
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
							<a href="">
								<li><i class="fas fa-gift"></i></li>
							</a>
							<li><i class="fas fa-bell"></i></li>
						</ul>
					</div>
				</div>
			</div>
<br><br><br>
			<span class="subtitle-category">Séries</span>
			<div class="netflix-slider ">
				<div class="swiper-container">
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-wrapper">
						<?php 
						
						$query = 'SELECT id, image_mini, serie_ou_film FROM series ';
						$req = $bdd->prepare($query);
						$req->execute();
						while($ligne = $req->fetch())
						{
							if($ligne['serie_ou_film'] == 1)
							{
								echo  
								'<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
								<div class="swiper-slide ">
							
									<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
									<i class="far fa-play-circle"></i>
								
								</div>	</a>';
							}
						}

						?>

					</div>
				</div>


</body>
</html>