<?php 
    require 'nav_front.php';
    require_once '../include/db.php';
    $id = $_GET['id_produit'];
    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id=?');
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <title>produit : <?= $produit['libelle'] ?></title>
</head>
<body>
    <div class="container">
        <h4><?= $produit['libelle'];?></h4> 
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="produit.jpge" alt="<?php $produit['libelle']?>" class="img img-fluid w-75">   
                </div>
                <div class="col-md-6">
                    <h1><?= $produit['libelle'];?></h1>
                    <h5><span class="badge text-bg-secondary bg-secondary"> <?= $produit['prix'];?> MAD</span></h5>
                    <p><span class="badge text-bg-success bg-success"> -<?php
                    if(!empty($produit['discount'])){echo $produit['discount'];};?>%</span></p>
                    <p><?= $produit['description'];?></p>
                    <a href="" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>
        </div>   
    </div>
</body>
</html>
