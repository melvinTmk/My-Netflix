<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <title>Admin</title>
</head>
<body>

<style>
*
{
    padding : 0; 
    margin:0;
    box-sizing:border-box;
}
button
{
    outline:none;
}
a
{
    text-decoration:none;
    color:white;
    font-size:0.8em;
    padding:8px;
}

.img
{
    width:14%;
    padding:15px;
}
body
{
    background-color:#141414;
    font-family: Arial, Helvetica, sans-serif;
}
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
    border:none;
}

td:nth-child(5)
{
    width:20%;
}
.image_mini
{
    width:65%;
}



    table
    {
        color:white;
        width:90%;
        margin : auto;
        border-collapse:collapse;
        box-shadow : 2px 2px 12px rgba(0,0,0,1);
    }

    tr
    {
        transition : all .2s ease-in;
        cursor:pointer;
    }

    .container .tableau tr:hover 
    {
        background:#E50914;
        color: white !important;
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

    input,textarea
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
    margin: 7px;
    
}

button[type=submit]
{
    background-color: #E50914;
    font-weight: 700;
    text-transform: uppercase;
    width:40%;
    color:white;
    padding:10px;
    margin-bottom:7px;
    border:hidden;
    border-radius:2px; 
}

.btn-submit:hover
{
    background-color: #e50d13;
    transition : all 0.3s ease-in-out;
}

.slideInLeft {

  animation-name: slideInLeft;
  animation-duration: 1s;
  animation-fill-mode: both;
  }


  @keyframes slideInLeft {
  0% {
  transform: translateX(-100%);
  visibility: visible;

  }
  100% {
  transform: translateX(0);
  }
  } 



  .slideInDown {
  animation-name: slideInDown;
  animation-duration: 1.5s;
  animation-fill-mode: both;
  }

  .fa-trash-alt
  {
      
      text-align:center;
  }


  @keyframes slideInDown {
  0% {
  transform: translateY(-100%);
  visibility: visible;
  }
  100% {
  transform: translateY(0);
  }
  }


  


    @media only screen and (max-width:768px)
    {
        table
        {
            width:90%;
        }
    }

.nbSerie
{
    color:white;text-align:center;margin-top:30px;padding:15px;font-size:1.2em;
}
</style>



<?php
session_start();
require_once('connexion.php');

if($_SESSION['admin'] == 0)
{
    header('Location:index.php');
}

require_once('nav-fonction.php'); 


$querySerie = 'SELECT id, pseudo, email, date_format(date_creation,\'%d/%m/%Y\') AS date_creation, 
admin, blocked FROM membres ORDER BY date_creation DESC';

if(isset($_GET['search-user']) AND !empty($_GET['search-user'])) 
{
   $search_user = htmlspecialchars($_GET['search-user']);

   $queryUser = $bdd->query('SELECT id, pseudo, email, date_format(date_creation,\'%d/%m/%Y\') AS date_creation, 
   admin, blocked FROM membres WHERE pseudo LIKE "%'.$search_user.'%" ORDER BY id DESC');
   
   if($queryUser->rowCount() == 0) 
   {
      $queryUser = $bdd->query('SELECT id, pseudo, email, date_format(date_creation,\'%d/%m/%Y\') AS date_creation, 
      admin, blocked FROM membres WHERE CONCAT(pseudo, email) LIKE "%'.$search_user.'%" ORDER BY id DESC');
   }
}


echo '<br>';

if(!empty($_GET['action']))
{
    if(!empty($_GET['action'] == "majUser"))
    {
        $id = $_GET['id'];
        // echo "<h3 style='color:white;'>ID = ".$id. "</h3>";
        $sql = 'SELECT  pseudo, email, admin, blocked FROM membres WHERE id =?';
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $ligne = $req->fetch();

        echo "<h1 class='slideInLeft'>Modifier : </h1>";

        echo '<form class="slideInLeft" method="post" action="gestion_user.php?action=majUserOk&id='.$id.'">';
        
        echo "<table style='border:hidden !important;'>
        <tr style='border:hidden !important; '><td ><b>Pseudo : </b></td></tr>
        <tr style='border:hidden !important; '><td><input type='text' name='pseudo' value=".$ligne['pseudo']."></td><tr>
        <tr style='border:hidden !important; '><td><b>Email : </b></td></tr>
       <tr style='border:hidden   !important; '> <td><input type='email' name='email' value=".$ligne['email']."></td></tr>
       <tr style='border:hidden !important; '><td><b> Admin : </b></td></tr>
       <tr style='border:hidden   !important; '> <td><input type='number' name='admin' value=".$ligne['admin']."></td></tr>
        <tr style='border:hidden !important; '><td><b> Bloqué : </b></td></tr>
        <tr style='border:hidden   !important; '> <td><input type='number' name='blocked' value=".$ligne['blocked']."></td></tr>
        <tr style='border:hidden !important; '><td><button type='submit'>Modifier</button></td></tr>
        </table>    
        </form>
        ";
        exit();

    }

}



if(!empty($_GET['action']))
{
    if($_GET['action']=='supprUser')
     {
        $id = $_GET['id'];

        $sql = 'DELETE FROM membres WHERE id = ?';
        $query = $bdd->prepare($sql);
        $query->execute(array($id));

        header('Location : gestion_user.php?action=user');
    }
}

if(!empty($_GET['action']))
{
    if($_GET['action']=='majUserOk')
    {
        $id = $_GET['id'];

        $pseudo = $_POST['pseudo'];
        $email = $_POST['email']; 
        $admin = $_POST['admin'];
        $blocked = $_POST['blocked'];

        $sql = 'UPDATE membres SET pseudo = ?, email = ?, blocked = ?, admin = ?  WHERE id =?';
        $query = $bdd->prepare($sql);
        $query->execute(array($pseudo,$email,$blocked,$admin,$id));
    }
    // header('Location:gestion_user.php?action=user');
}

$query = 'SELECT count(id) AS nbr FROM membres';

$req = $bdd->prepare($query);
$req->execute();
$ligne = $req->fetch();
$nombre = $ligne['nbr'];
echo "<h1 class='slideInLeft nbSerie' style='font-size:1.3em;'> Il y a " . $nombre. " utilisateurs sur Mynetflix <br>";

?>

<br>

 <div class="barre_serie" style="width:100%; justify-content:center;display:flex;">
    <form method="GET">
        <input type="search-txt" id="search-user" name="search-user">
        <input type="submit" class="btn-submit" value="Chercher un utilisateur">
    </form>
 </div>

<?php
$query = 'SELECT id, pseudo, email, date_format(date_creation,\'%d/%m/%Y\') AS date_creation, 
admin, blocked FROM membres ORDER BY date_creation DESC';
$req = $bdd->prepare($query);
$req->execute();




echo '<div class="container slideInLeft"><table class="tableau">
    <tr>
       
        <th>Pseudo</th>
        <th>Email</th>
        <th>Date</th>
        <th>Admin</th>
        <th>Bloqué</th>
        <th>Action</th>
    </tr>
';
if(isset($_GET['search-user']) AND !empty($_GET['search-user'])) 
{
    
    
    
    if($queryUser->rowCount() > 0)
    {
        while($user = $queryUser->fetch())
        {
            echo '  <tr>
            <td>'.$user['pseudo'].'</td>
            <td>'.$user['email'].'</td> 
            <td>'.$user['date_creation'].'</td> ';
            
            if($user['admin'] == 1)
            {
                echo '<td><i class="fas fa-crown"></i></td>';
            }
            else
            {
                echo '<td><i class="far fa-user"></i></td>';
            }
            if($user['blocked'] == 0)
            {
                echo '<td><i class="fas fa-unlock"></i></td>';
            }
            else
            {
                echo '<td><i class="fas fa-lock"></i></td>';
            }
        
        echo  '<td style="display:flex;"> 
                <a href="gestion_user.php?action=majUser&id='.$user['id'].'"><i class="far fa-edit"></i></a>  
                <a href="gestion_user.php?action=supprUser&id='.$user['id'].'"><i class="fas fa-trash-alt" "></i> </a> 
            
                </td>
            </tr>';
        }
    }
    else
    {
        echo "Aucuns Résultats <br>";
    }
   
}
while($ligne = $req->fetch())
{
    echo '<tr>
    <td>'.$ligne['pseudo'].'</td>
    <td>'.$ligne['email'].'</td>
    <td>'.$ligne['date_creation'].'</td>';

    if($ligne['admin'] == 1)
    {
        echo '<td><i class="fas fa-crown"></i></td>';
    }
    else
    {
        echo '<td><i class="far fa-user"></i></td>';
    }
    if($ligne['blocked'] == 0)
    {
        echo '<td><i class="fas fa-unlock"></i></td>';
    }
    else
    {
        echo '<td><i class="fas fa-lock"></i></td>';
    }

   echo  '<td style="display:flex;"> 
        <a href="gestion_user.php?action=majUser&id='.$ligne['id'].'"><i class="far fa-edit"></i></a>  
        <a href="gestion_user.php?action=supprUser&id='.$ligne['id'].'"><i class="fas fa-trash-alt" "></i> </a> 
       
        </td>
    </tr>'
    ;
};

echo '</table></div>';
$req->closeCursor();


?>
</body>
</html>