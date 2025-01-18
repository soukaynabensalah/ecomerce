<?php
    require_once('include/db.php');
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('DELETE FROM categorie WHERE id = ?');
    $supprimer = $sqlState->execute([$id]);
    if($supprimer){
        header('location:categories.php');
    }else{
        echo 'erreur dans la base de données';
    }
?>