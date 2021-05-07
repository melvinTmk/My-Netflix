<?php
    require_once('preferences.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <link rel="stylesheet" href="style/profil.css">
    <title>Profil</title>
</head>


<style>
.formPreference input
{
    height: 5vh !important;
    width:7vw;
    text-align:center;
}

.formPreference
{
    width:70vw;
}

.valideForm
{
    position:absolute;
    right:5%;
}

</style>

<?php



if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

// require_once('connexion_traitement.php');

//  echo $_SESSION['id'];
//  echo "<br>";
//  echo $_SESSION['pseudo'];
//  echo "<br>";
//  echo $_SESSION['user'];





 if(!empty($_GET['action']))
 {
     if(!empty($_GET['action'] == "maj"))
     {
         $id = $_GET['id'];
         // echo "<h3 style='color:white;'>ID = ".$id. "</h3>";
         $sql = 'SELECT  email, pseudo, password FROM membres WHERE id =?';
         $req = $bdd->prepare($sql);
         $req->execute(array($id));
         $ligne = $req->fetch();
 
         echo "<h1 class='slideInLeft'>Modifier : </h1>";
 
         echo '<form class="slideInLeft" method="post" action="profil.php?action=majok&id='.$id.'">';
         
         echo "<table style='border:hidden !important; '>
        
         <tr style='border:hidden !important; '><td><input type='text' name='pseudo' value=".$ligne['pseudo']."></td>
        <tr style='border:hidden   !important; '> <td><input type='email' name='email' value=".$ligne['email']."></td></tr>
        <tr style='border:hidden   !important; '> <td><input type='password' name='password' value=".$ligne['password']."></td></tr>
        <tr style='border:hidden !important; '><td><button type='submit'>Modifier</button></td></tr>
         </table>    
         </form>
         ";
         exit();
        
     }
 
 
 }

 if(!empty($_GET['action']))
{
    if($_GET['action']=='majok')
    {
        $id = $_SESSION['id'];

        $email = htmlspecialchars($_POST['email']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
       

        $password = hash('ripemd160', $password);

        $sql = 'UPDATE membres SET  email = ?, pseudo = ?, password = ?  WHERE id = ?';
        $query = $bdd->prepare($sql);
        $query->execute(array($email,$pseudo,$password,$id));
        header('Location:profil.php');
    }
   
}


?>



<body>
    <nav>
        <a href="pageAccueil.php"><img src="images/logo.png" alt=""></a>
    </nav>

    <div class="body">
        <div class="container">
            <div class="card">
                <div class="avatar">
                    <div class="circle"></div>
                    <img src="img/avatar-3.png" alt="adidas">
                </div>
                <div class="info">
                    <h1 style="text-transform: uppercase;" class="title"> <?php 
     echo $_SESSION['pseudo']
     ?>
                    </h1>
                    <h3 style="text-align:center; text-transform: uppercase;"><?php 
     echo $_SESSION['user']?></h3>
                    <div class="mesAmis">
                        <a href="listFriends.php"><i
                                style="position:absolute;width:72%;top:50%;left:70%;font-size:2.5em;"
                                class="fas fa-user-friends" style=""></i></a>
                    </div>

                    <div class="mesAmis">
                        <a href="listAbonnes.php"><i class="fas fa-users" style="position:absolute;width:72%;top:50%;left:85%;font-size:2.5em;"></i></a>
                    </div>

                    <form class="formPreference" method="POST">
                        <input type="color" id="head" name="couleur_avis" value="#e66465">
                        <input type="number" name="grille" >
                        <input class="valideForm" type="submit" >
                    </form>
                    </a>
                    <div class="update">
                        <a href="profil.php?action=maj&id=<?php echo $_SESSION['id'] ?>"><button>Modifier le mot de
                                passe</button></a>
                    </div>
   
                    <div class="deconnexion">
                        <a href="deconnexion.php"><button>Déconnexion</button></a>

                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- <script>
    //Movement Animation to happen
const card = document.querySelector(".card");
const container = document.querySelector(".container");
//Items
const title = document.querySelector(".title");
const avatar = document.querySelector(".avatar");
const deconnexion = document.querySelector(".info .deconnexion");
const description = document.querySelector(".info h3");
const date = document.querySelector(".date");

//Moving Animation Event
container.addEventListener("mousemove", (e) => {
  let xAxis = (window.innerWidth / 2 - e.pageX) / 25;
  let yAxis = (window.innerHeight / 2 - e.pageY) / 25;
  card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
});
//Animate In
container.addEventListener("mouseenter", (e) => {
  card.style.transition = "none";
  //Popout
  title.style.transform = "translateZ(150px)";
  avatar.style.transform = "translateZ(200px) ";
  description.style.transform = "translateZ(145px)";
  date.style.transform = "translateZ(130px)";
  deconnexion.style.transform = "translateZ(145px)";
});
//Animate Out
container.addEventListener("mouseleave", (e) => {
  avatar.style.transition = "all 0.7s ease-in-out";
  card.style.transition = "all 0.7s ease-in-out";
  card.style.transform = `rotateY(0deg) rotateX(0deg)`;
  //Popback
  title.style.transform = "translateZ(0px)";
  avatar.style.transform = "translateZ(0px) rotateZ(0deg)";
  description.style.transform = "translateZ(0px)";
  date.style.transform = "translateZ(0px)";
  deconnexion.style.transform = "translateZ(0px)";
});
    </script> -->
</body>

</html>