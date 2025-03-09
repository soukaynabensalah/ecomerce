<?php
    require 'include/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('DELETE FROM produit WHERE id = ?');
    $supprimer = $sqlState->execute([$id]);
    if($supprimer){
        header('location:produits.php');
    }else{
        echo 'erreur dans la base de données';
    }
?>