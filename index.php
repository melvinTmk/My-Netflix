<?php

require("connexion.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>My Netflix</title>


</head>

<body>
    
<img class="logo" src="images/logo.png" alt="">

<br>
<div class="bloc">
<p class="identifier">S'identifier</p>
<br>

<?php 
        require_once('connexion_traitement.php');


                // if( $_SESSION['blocked']== 1)
                // {
                //     echo "Votre compte est bloqué !!";
                //     header('Location : index.php');
                // }


          
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                <div class="alert alert-danger" style="color:white;text-align:center;margin-bottom:15px; font-size:1.5em;">
                    <strong style="color:#E50914;">Erreur</strong> mot de passe incorrect
                </div>
                <?php
                        break;

                        case 'email':
                        ?>
                <div class="alert alert-danger" style="color:white;text-align:center;margin-bottom:15px; font-size:1.5em;">
                    <strong style="color:#E50914;">Erreur</strong> email incorrect
                </div>
                <?php
                        break;

                        case 'already':
                        ?>
                <div class="alert alert-danger" style="color:white;text-align:center;margin-bottom:15px; font-size:1.5em;">
                    <strong style="color:#E50914;">Erreur</strong> compte non existant
                </div>
                <?php
                        break;
                    }
                }
                ?>
<form action="" method="post">
        <label for="mail"></label><br>
                    <input class="mail" type="email" name="email" size="35" placeholder="E-mail ou numéro de téléphone" autofocus required>

                    <br>


                    <label for="password"></label><br>
                    <input class="mail" type="password" name="password" size="35" placeholder="Mot de passe" autofocus required>

                    <br><br><br>

                    <input class="submit" type="submit" name="submit" size="35" value="Connexion" autofocus required>
        <br><br>

                    <!-- <label for="remember"></label>
                            <input type="checkbox" name="souvenir">
                    <label class="bouton" for="souvenir">Se souvenir de moi</label>
                    <br><br> -->
</form>

<div class="sinscrirefb">
<img class="logofb" src="images/facebooklogo.png" alt="">S'identifier avec Facebook
</div>
                              <br>

                              <p class="visite">Première visite sur Netflix ?</p><a class="inscrivez" href="inscription.php">Inscrivez-vous.</a>
</div>



</body>
</html>