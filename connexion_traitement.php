<?php
session_start();
require_once('connexion.php');

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $check = $bdd->prepare('SELECT email, password, id, pseudo, admin, blocked  FROM membres WHERE email = ?');

        $check->execute(array($email));

        $data = $check->fetch();

        $row = $check->rowCount();
        
        if($row == 1)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $password = hash('ripemd160', $password);
                if($data['password'] === $password)
                { 
                    if($data['blocked'] == 0)
                    {

                     $_SESSION['user'] = $data['email'];
                     $_SESSION['blocked'] = $data['blocked'];
                     $_SESSION['id'] = $data['id'];
                     $_SESSION['pseudo'] = $data['pseudo'];
                     $_SESSION['admin'] = $data['admin'];
                    header('Location: utilisateurs.php');
                    die();

                    } else
                    {
                        echo '<p style="color:red;">Votre compte est bloqué</p> ';
                    }

                     
                }
                
                else header('Location: index.php?login_err=password');
            }
            else header('Location: index.php?login_err=email');
        }
        else header('Location: index.php?login_err=already');
    
    }
