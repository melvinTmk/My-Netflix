<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        width:80%;
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
    </style>
</body>
</html>
<?php
require_once('connexion.php');

 echo "<h1 class='slideInLeft'> Ajouter : </h1>";

 echo '<form class="slideInLeft" method="post">';
 
 echo "<table style='border:hidden !important;'>
 <tr style='border:hidden !important; '><td ><b>Nom : </b></td></tr>
 <tr style='border:hidden !important; '><td><input type='text' name='nom' ></td><tr>
 <tr style='border:hidden !important; '><td><b>Thématique : </b></td></tr>
<tr style='border:hidden   !important; '> <td><input type='text' name='thematique'></td></tr>
<tr style='border:hidden !important; '><td><b>Série (1) ou Film (0) : </b></td></tr>
<tr style='border:hidden   !important; '> <td><input type='number' name='serie_ou_film'></td></tr>
 <tr style='border:hidden !important; '><td><b> Resumé : </b></td></tr>
 <td style='border:hidden !important; '><textarea name='resume'></textarea></td>
 <tr style='border:hidden !important; '><td><b>Trailer : </b></td></tr>
 <td style='border:hidden !important; '><textarea name='trailer'></textarea></td>
 <tr style='border:hidden !important; '>
         <td><input type='date' name='date_creation'></td>
 <tr>
 <tr style='border:hidden !important; '><td><b>Image : </b></td></tr>
 <tr style='border:hidden   !important; '> <td><input type='text' name='image'></td></tr>
 <tr style='border:hidden !important; '><td><b>Image Mini : </b></td></tr>
 <tr style='border:hidden   !important; '> <td><input type='text' name='image_mini'></td></tr>
 <tr style='border:hidden !important; '><td><button type='submit'>Ajouter</button></td></tr>
 </table>    
 </form>
 ";

 if(isset($_POST['nom']) && isset($_POST['thematique']) && isset($_POST['resume']) && isset($_POST['trailer']) && isset($_POST['image'])  && isset($_POST['image_mini']) && isset($_POST['serie_ou_film']) && isset($_POST['date_creation']))
 {
    

     $nom = htmlspecialchars($_POST['nom']);
     $thematique = htmlspecialchars($_POST['thematique']);
     $resume = htmlspecialchars($_POST['resume']);
     $trailer = htmlspecialchars($_POST['trailer']);
     $image = htmlspecialchars($_POST['image']);
     $image_mini = htmlspecialchars($_POST['image_mini']);
     $serie_ou_film = htmlspecialchars($_POST['serie_ou_film']);
     $date_creation = htmlspecialchars($_POST['date_creation']);
     

     $insert = $bdd->prepare('INSERT INTO series(nom, thematique, serie_ou_film, resume, date_creation, image, image_mini, trailer) VALUES(:nom, :thematique, :serie_ou_film, :resume, :date_creation, :image, :image_mini, :trailer)');
     $insert->execute(array(
         'nom' => $nom,
         'thematique' => $thematique,
         'resume' => $resume,
         'trailer' => $trailer,
         'image' => $image,
         'image_mini' => $image_mini,
         'serie_ou_film' => $serie_ou_film,
         'date_creation' => $date_creation,
     ));
     
     header('Location:admin.php?reg_err=success');         
}                           
      
              