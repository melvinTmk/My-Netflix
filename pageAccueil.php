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



$nbNotif = 'SELECT * FROM  relation  WHERE id_receveur = ? AND statut = 1';
$req = $bdd->prepare($nbNotif);
$req->execute(array($_SESSION['id']));



?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Netflix</title>
	<link rel="stylesheet" href="style/pageAccueil2.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
</head>

<body>

	<div class="container">
		<br>
		<div class="hero">
			<div class="header">
				<div class="logo">
					<img src="images/logo.png" alt="" />
				</div>
				<div class="menu">
					<div class="menu-left">
						<ul>
							<a href="">
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
							if($_SESSION['admin'] == 1 )
							{
							   echo '<a href="admin.php">
							   <li><i class="fas fa-user-lock"></i></li>
						  			 </a>';
							}
							
							?>
							<a href="profil.php">
								<li><i class="far fa-user-circle "></i></li>
							</a>
						
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
			<div class="banner">
				<img src="images/lupintitre.png" class="poster" alt="">
				<br><br>
				<span class="subtitle">
				Il y a 25 ans, la vie du jeune Assane Diop est bouleversée lorsque son père meurt après avoir été accusé d'un crime qu'il n'a pas commis. 
				Aujourd'hui, Assane va s'inspirer de son héros, Arsène Lupin, pour le venger.
				</span>
				<div class="buttons">
					<a href="viewSerie.php?action=view&id=7"><button class="btn "><i
								class="fas fa-play"></i>Lecture</button></a>
					<button class="btn "><i class="fas  fa-plus"></i>En savoir plus</button>
				</div>
			</div>
<!---------------------------------------------------------------------------------------------------------------->
<?php if(isset($_GET['search'])){
			$chiffre = $query->rowCount(); ?>
			<span class="subtitle2 category ">Il y a <?=$chiffre." résultat(s) pour votre recheche <span style='font-size:1.1em; color:red;'> $search </span>";?></span>
				<div class="netflix-slider ">
					<div class="swiper-container">
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-wrapper">
							<?php 

							if($query->rowCount() > 0)
							{
								
								while($serie = $query->fetch())
								{
									echo  
									'<div class="swiper-slide">
									<a href="viewSerie.php?action=view&id='.$serie['id'].'">
										<img class="image_mini" src="images/'.$serie['image_mini'].'.png"/>
										<i class="far fa-play-circle"></i>
									</a>
									</div>';
								}
							
							}
							
							else
							{
								echo "<span style='color:white; margin-left:40%; font-size:3em;'> Aucuns Résultats pour </span>";
							}

						?>

						</div>
					</div>
				</div>
					<br>
		<?php } ;?>
<!---------------------------------------------------------------------------------------------------------------->
			<span class="subtitle2 category ">Films</span>
			<div class="netflix-slider ">
				<div class="swiper-container">
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-wrapper">
						<?php 
						
						$query = 'SELECT id, image_mini, serie_ou_film, nom FROM series ';
						$req = $bdd->prepare($query);
						$req->execute();
						while($ligne = $req->fetch())
						{
							if($ligne['serie_ou_film'] == 0)
							{
								echo  
								'<div class="swiper-slide ">
								<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
									<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
									<i class="far fa-play-circle"></i>
									</a>
								</div>';
							}
							
						}

						?>

					</div>
				</div>
				<br>
			</div>

				<span class="subtitle2 category ">Séries</span>
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
								'<div class="swiper-slide">
								<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
									<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
									<i class="far fa-play-circle"></i>
									</a>
								</div>';
							}
							
						}

						?>

						</div>
					</div>
					<br>

				<span class="subtitle2 category ">Drame</span>
				<div class="netflix-slider ">
					<div class="swiper-container">
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-wrapper">
							<?php 

				$query = 'SELECT id, image_mini, serie_ou_film, thematique FROM series ';
				$req = $bdd->prepare($query);
				$req->execute();
				while($ligne = $req->fetch())
				{
					if($ligne['thematique'] == 'Drame')
					{
						echo  
						'<div class="swiper-slide">
						<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
							<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
							<i class="far fa-play-circle"></i>
						</a>
						</div>';
					}
					
				}

				?>

		</div>
	</div>


					<br>

					<span class="subtitle2 category ">Action</span>
					<div class="netflix-slider ">
						<div class="swiper-container">
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
							<div class="swiper-wrapper">
								<?php 
						
						$query = 'SELECT id, image_mini, serie_ou_film, thematique FROM series ';
						$req = $bdd->prepare($query);
						$req->execute();
						while($ligne = $req->fetch())
						{
							if($ligne['thematique'] == 'Action')
							{
								echo  
								'<div class="swiper-slide">
								<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
									<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
									<i class="far fa-play-circle"></i>
									</a>
								</div>';
							}
							
						}

						?>

							</div>
						</div>

				
						<br>

					<span class="subtitle2 category ">Crime</span>
					<div class="netflix-slider ">
						<div class="swiper-container">
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
							<div class="swiper-wrapper">
								<?php 
						
						$query = 'SELECT id, image_mini, serie_ou_film, thematique FROM series ';
						$req = $bdd->prepare($query);
						$req->execute();
						while($ligne = $req->fetch())
						{
							if($ligne['thematique'] == 'Crime')
							{
								echo  
								'<div class="swiper-slide">
								<a href="viewSerie.php?action=view&id='.$ligne['id'].'">
									<img class="image_mini" src="images/'.$ligne['image_mini'].'.png"/>
									<i class="far fa-play-circle"></i>
									</a>
								</div>';
							}
							
						}

						?>

							</div>
						</div>

				


					

							<div class="footer">
								<div class="social">
									<a href=""><i class="fab fa-facebook-square"></i></a>
									<a href=""><i class="fab fa-instagram"></i></a>
									<a href=""><i class="fab fa-twitter"></i></a>
									<a href=""><i class="fab fa-youtube"></i></a>
								</div>
								<div class="flex">
									<div class="info">
										<ul>
											<li>Audio et sous-titre</li>
											<li>Presse</li>
											<li>Confidentialité</li>
											<li>Nous contacter</li>
										</ul>
									</div>
									<div class="info">
										<ul>
											<li>Audiodescription</li>
											<li>Relations Investisseur</li>
											<li>Informations légales</li>
										</ul>
									</div>
									<div class="info">
										<ul>
											<li>Centre d'aide</li>
											<li>Recrutement</li>
											<li>Préférences de cookies</li>
										</ul>
									</div>
									<div class="info">
										<ul>
											<li>Cartes cadeaux</li>
											<li>Conditions d'utilisation</li>
											<li>Mentions légales</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
<?php 

$id_membre = $_SESSION['id'];


$query = 'SELECT grille FROM preferences WHERE id_membre = ?';
$req = $bdd->prepare($query);
$req->execute(array($id_membre));
$ligne = $req->fetch();

// echo $ligne['grille'];?>
			
</body>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
	var swiper = new Swiper('.swiper-container', {
		slidesPerView:<?php 
		if(!empty($ligne['grille']))
		echo $ligne['grille'];
		else
		echo 5;
		
		?> ,
		spaceBetween: 10,
		slidesPerGroup: 2,
		pagination: {
			el: '.swiper-pagination',
			clickable: false,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	var swiper = new Swiper('#swiper-container', {
		slidesPerView: 4,
		spaceBetween: 10,
		slidesPerGroup: 2,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next2',
			prevEl: '.swiper-button-prev2',
		},
	});

	/////////////////////////// SCROLL ANIMATION //////////////////////

	// TweenMax.to(".menu", 1, {
    //         x: 30,
    //         opacity: 1,
    //         ease: Expo.easeInOut
    //         });


    //         TweenMax.from(".logo", 1, {
    //         delay: 1,
    //         y: 0,
    //         opacity: 0,
    //         ease: Expo.easeInOut
    //         });

    //         TweenMax.from(".container", 1, {
    //         delay: 0.5,
    //         y: 20,
    //         opacity: 0,
    //         ease: Expo.easeInOut
    //         });


	// 		TweenMax.from(".banner", 1, {
    //         delay: 1 ,
    //         y: 40,
    //         opacity: 0,
    //         ease: Expo.easeInOut
    //         });

</script>



</html>