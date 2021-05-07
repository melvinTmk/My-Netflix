<?php   
require_once('connexion.php');

session_start();

require_once('nav-fonction.php');
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyNetflix</title>
</head>
<body>
    
<style>
*
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: "Poppins", sans-serif;
    background-color: #141414;
    overflow: hidden;
  }

  .body
  {
 
  }
  .container {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
 
  }
  .card {
    transform-style: preserve-3d;
    min-height: 80vh;
    width: 35rem;
    border-radius: 30px;
    padding: 0rem 5rem;
    
  }
  .card
  {
    /* box-shadow: 0 20px 20px #E50914, 0px 0px 50px #E509; */
    box-shadow : 8px 8px 38px rgba(0,0,0,1);
    position: absolute;
    top: 12%;
  }
  .avatar {
    min-height: 35vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .avatar img {
    width: 10rem;
    z-index: 2;
    border-radius: 50%;
    transition: all 0.75s ease-out;
  }
  .circle {
    width: 15rem;
    height: 15rem;
    background: linear-gradient(
      to right,
      #E50914,
      rgba(0, 0, 0, 0.75)
    );
    position: absolute;
    border-radius: 50%;
    z-index: 1;
  }
  
  .info h1 {
    font-size: 2rem;
    transition: all 0.75s ease-out;
    color: white;
  }
  .info h3 {
    font-size: 1.3rem;
    padding: 1rem 0rem;
    color: white !important;
    font-weight: lighter;
    transition: all 0.75s ease-out;
  }
  
  button.active {
    background: #585858;
    color: white;
  }
  .deconnexion,.update {
    margin-top: 3rem;
    transition: all 0.75s ease-out;
    
  }
  .deconnexion button {
    width: 72%;
    padding: 1rem 0rem;
    background: #E50914;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 30px;
    font-weight: bolder;
    font-size: 1.2em;
    position: absolute;
    bottom: 3%;
  }

  a{
      text-decoration: none;
      color: white;
  }

  .update button
  {
    width: 100%;
    padding: 1rem 0rem;
    background: #E50914;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 30px;
    font-weight: bolder;
    font-size: 1.2em;
  }


  nav img
  {
      width: 9rem;
  
      margin: 25px;
  }

/* body
{
    font-family: "Poppins", sans-serif;
    color: white;
    background-color: #141414;
    perspective: 1000px;
}

.card {
    min-height: 70vh;
    width: 29rem;
    border-radius: 30px;
    padding: 0rem 5rem;
    box-shadow : 8px 8px 38px rgba(0,0,0,1);
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,30%);
    transform-style: preserve-3d;
  }

  .card::before
  {
      content: '';
      background-color:#e50d13;
      position: absolute;
      border-top-left-radius: 30px ; 
      border-top-right-radius:30px;
      top: 0;
      right: 0;
      width: 100%;
      height: 170px;
  }

  .cardImg
  {
      position: absolute;
      bottom: 30%;
      left: 51%;
      transform: translate(-50%,-50%);
      border-radius: 50%;
      width: 200px;
      height: 200px;
      box-shadow: 0px 0px 70px #141414; 
      transition:all 0.3s;
  }

  
  .info1 
  {
      color: white;
      position: absolute;
      top: 56%;
      left: 15%;
      font-size: 1.1em;

  }




  .info2 
  {
      color: white;
      position: absolute;
      top: 65%;
      left: 15%;
      font-size: 1.1em;
      text-overflow: ellipsis;
      width: 60%;
      transition: all 0.7s ;
  }

  .info2 a:hover
  {
     
    color: #E50914;
  }

  .info2 a
  {
    font-size: 1.3em;
  }

  button
  {
      position: absolute;
    bottom: 5%;
      color:white !important;
      height: 45px;
      background-color: #E50914;
      border: none;
      border-radius: 5px;
      color: white !important;
      font-size: 17px;
      text-align: center;
      width:70%;
      cursor: pointer;
      outline: none;
      transition:all 0.3s;
  } */

  /* button:hover
  {
    transform: translateY(-10px);
  } */

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
}

td:nth-child(5)
{
    width:20%;
}


    table
    {
        color:white;
        width:50%;
        margin : auto;
        border-collapse:collapse;
        box-shadow : 2px 2px 12px rgba(0,0,0,1);
        height: 50vh;
    }

    tr
    {
        transition : all .2s ease-in;
        cursor:pointer;
    }

    .container .tableau tr:hover
    {
        background:#E50914;
        transform : scale(1.04);
        
    }

    th,td
    {
        padding:12px;
       
        text-align:center;
    }

    th
    {
        background:#E50914;
       

    }
    h1
    {
        color:white;
        text-align:center;
        margin:50px;
    }

input
{
     opacity: .7;
    padding: 16px 20px;
    margin: 5px 0;
    border: none;
    font-size: 16px;
    color: white;
    background-color: #333;
    border-radius: 4px;
    outline: none;
    width: 45%;
    margin: 0;
    
}

button[type=submit]
{
    background-color: #E50914;
    font-weight: 700;
    text-transform: uppercase;
    width:20%;
    color:white;
    padding:10px;
    margin-bottom:7px;
    border:hidden;
    border-radius:30px;
    position: absolute;
    top: 58%;
    left: 40%;
    cursor: pointer;
}
 
.attente 
{
    background-color: #E50914;
    font-weight: 700;
    text-transform: uppercase;
    width:20%;
    color:white;
    padding:10px;
    margin-bottom:7px;
    border:hidden;
    border-radius:30px;
    position: absolute;
    top: 58%;
    left: 40%;
}

button
{
    outline: none;
}


</style>


<?php




if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

$id_membre_connecté = $_SESSION['id'];
$id_fiche_membre =  $_GET['id'];

$query = 'SELECT pseudo, email,id FROM membres WHERE id = ? ';
$req = $bdd->prepare($query);

$req->execute(array($id_fiche_membre));

$afficher_membre = $req->fetch();

// echo $afficher_membre['pseudo'];
// echo "<br>";
// echo $afficher_membre['email'];

// -------------------------------------------------- FAIRE UNE DEMANDE D'AMI ------------------------------------- //

// $id_membre_connecté = $_SESSION['id'];
//  $id_fiche_membre = $_GET['id'];
   
// $relation = "SELECT * FROM relation WHERE (id_demandeur, id_receveur = :id1,:id2) OR (id_demandeur, id_receveur = :id2, :id1) ";

// $req_relation = $bdd->prepare($relation);

// $req_relation->execute(array(

// 'id1' => $id_membre_connecté, 
// 'id2' => $id_fiche_membre));

// $relationUser = $req_relation->fetch();

  



// $relation = "SELECT m.*, r.id as friends FROM membres m  
// LEFT JOIN relation r ON r.id_receveur = m.id OR r.id_demandeur = m.id WHERE m.id = ? ";

// $req_relation = $bdd->prepare($relation);

//  $req_relation->execute(array($id_fiche_membre));

// $relationUser = $req_relation->fetch();



$relation = $bdd->prepare("SELECT * FROM relation
WHERE (id_demandeur, id_receveur) = (:id1, :id2) OR (id_demandeur, id_receveur) = (:id2, :id1)");

$relation->execute(array('id1' => $id_membre_connecté, 'id2' => $id_fiche_membre));

$relation = $relation->fetch();

if(isset($_POST['demander']))
{
if(!isset($relation['id']))
{
    $query_add = "INSERT INTO relation(id_demandeur, id_receveur, statut) VALUES (?, ?, ?)";
    $req_add = $bdd->prepare($query_add);
    $req_add->execute(array($id_membre_connecté, $id_fiche_membre, 1));

    // header('Location: viewUser.php?action=viewUser');
}
};

 
  
?>

<form method="post" action="viewUser.php?action=viewUser&id=<?=$id_fiche_membre ?>">



<div class="body">
        <div class="container">
            <div class="card">
                <div class="avatar">
                    <div class="circle"></div>
                    <img src="img/avatar-3.png" alt="adidas">
                </div>
                <div class="info">
                    <h1 style="text-transform: uppercase;" class="title"> <?php 
   
        echo $afficher_membre['pseudo']
     ?>
                    </h1>
                    <h3 style="text-align:center; text-transform: uppercase;"><?php 
     echo $afficher_membre['email']?></h3>
  
                    <div class="update">
                         <button><a href="viewUserList.php?id_membre=<?=$afficher_membre['id']  ?>">Voir la liste de <?php echo $afficher_membre['pseudo'] ?>  </a> </button>  
                    </div>
   
                    <?php 
        if(!isset($relation['id']))
        {
           echo '<div class="update"><input type="submit" name="demander" value="Ajouter en ami"/></div>';
        }
        elseif($relation['statut'] == 1){
           echo " <div class='update'><button><span>En attente</span></button></div>";
        }  
         elseif($relation['statut'] == 2){
          echo " <div class='update'><button><span>Vous êtes amis ! 😇</span></button></div>";
       }
            ?>
         
                </div>
            </div>
        </div>
        
       
       
    </div>
</div>

</form>
</body>
</html>