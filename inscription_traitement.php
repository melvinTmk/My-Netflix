
<?php 
    require_once 'connexion.php';

    if(isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['retype_password']))
    {
        $email = htmlspecialchars($_POST['email']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $retype_password = htmlspecialchars($_POST['retype_password']);

        $check = $bdd->prepare('SELECT pseudo, email, password FROM membres WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 0){ 
                if(strlen($email) <= 50){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if($password == $retype_password){

                            $password = hash('ripemd160', $password);

                            
                            $insert = $bdd->prepare('INSERT INTO membres(pseudo, email, password) VALUES(:pseudo, :email, :password)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'email' => $email,
                            ));

                            header('Location:index.php?reg_err=success');
                        }
                        else header('Location: inscription.php?reg_err=password');
                    }
                    else header('Location: inscription.php?reg_err=email');
                }
                else header('Location: inscription.php?reg_err=email_length');
        }
        else header('Location: inscription.php?reg_err=already');
    }