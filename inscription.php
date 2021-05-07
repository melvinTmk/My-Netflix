<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/inscription.css">
    <title>My Netflix</title>
    
</head>
<body>
<?php
        require_once('inscription_traitement.php');
            
                ?>


<div class="id">
<img class="logo" src="images/logo.png" alt="">
<a class="subtitle" href="index.php">S'identifier</a>
</div>

<div class="texte">
<h1 class="films">Films, séries TV et bien <br> plus en illimité.</h1><br>
</div>

<br>
<div class="bloc">
<p class="identifier">S'inscrire</p>
<br>
<?php
        require_once('inscription_traitement.php');
            if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger" style="color:red; text-align:center;">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger" style="color:red; text-align:center;">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger" style="color:red; text-align:center;">
                                <strong>Erreur</strong> email trop long
                            </div>
                        <?php 
                        break;

                        case 'pseudo_length':
                        ?>
                            <div class="alert alert-danger" style="color:red; text-align:center;">
                                <strong>Erreur</strong> pseudo trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger" style="color:red; text-align:center;">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
<form action="" method="post">
        <label for="mail"></label><br>
        <input class="mail" type="email" name="email" size="35" placeholder="E-mail ou numéro de téléphone" autofocus required>

        <br><br>

        <input class="mail" type="username" name="pseudo" size="35" placeholder="Pseudo" autofocus required><br>

        <label for="password"></label><br>
        <input class="mail" type="password" name="password" size="35" placeholder="Mot de passe" autofocus required><br>

        <label for="password"></label><br>
        <input class="mail" type="password" name="retype_password" size="35" placeholder="Confirmez votre mot de passe" autofocus required>

        <br><br><br>

        <input class="submit" type="submit" name="submit" size="35" value="Inscription" autofocus required>
</form>


</body>
</html>