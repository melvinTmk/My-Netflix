<?php
    require_once('connexion_traitement.php');


if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/utilisateurs.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>My netflix</title>
</head>
<body id="profilPage">
    <nav>
        <img id="logo" src="images/logo.png" alt="">
    </nav>

    <section class="content">
        <h1 style="text-align:center;">Qui est-ce?</h1>
        <div class="row spaceBetween">
            
            <div class="profil">
                <a href="toudoum.html">
                    <img src="img/avatar-3.png" alt="">
                    <p style="padding-right:35px; font-size:1.5em"><?php      
          echo $_SESSION['pseudo'];      
        ?></p>
                </a>
            </div>
        </div>
        <div class="row">
            <a class="boutonProfil" href="profil.php">
                Gérer le profil
            </a>
        </div>
    </section>
</body>
<script src="https://kit.fontawesome.com/56bc5af4cd.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/scrollreveal"></script>
</html>