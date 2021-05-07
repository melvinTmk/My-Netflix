<?php
require_once('connexion.php');
session_start();
    $id_membre = $_SESSION['id'];
    $get_id = $_GET['id'];
    $likes = 1;
    if(isset($_GET['id_membre'],$_GET['id']) AND !empty($_GET['id_membre']) AND !empty($_GET['id_membre']))
    {
        $check_like = $bdd->prepare('INSERT INTO favoris(id_membre , id_serie, likes) VALUES(:id_membre, :id_serie, :likes)');
          $check_like->execute(array(
              'id_membre' => $id_membre,
              'id_serie' => $get_id,
              'likes' => $likes,
          ));
    }
          
    header('Location: maListe.php');
        



// $del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
// $del->execute(array($get_id, $id_membre));