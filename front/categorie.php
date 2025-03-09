<?php 
    require 'nav_front.php';
    require_once '../include/db.php';
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $sqlState->execute([$id]);
    $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);

    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id_categorie=?');
    $sqlState->execute([$id]);
    $produits = $sqlState->fetchAll(PDO::FETCH_OBJ);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <title>Categorie <?= $categorie['libelle'] ?></title>
</head>
<body>
    <div class="container">
        <h1><?= $categorie['libelle'] ?></h1> 
        <div class="container">
            <div class="row">
                <?php
                    foreach($produits as $produit){
                ?>
                    <div class="card mb-3 col-md-4">
                        <img src="https://picsum.photos/id/237/200/300" style="width: 100%; height: 300px;" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="<?php echo 'produit.php?id_produit='.$produit->id?>" class="btn stretched-link">Afficher détaille</a>
                            <h5 class="card-title"><?= $produit->libelle ?></h5>
                            <p class="card-text"><?= $produit->prix ?>MAD</p>
                            <p class="card-text"><small class="text-body-secondary">Ajouter le : <?= date_format(date_create($produit->date_creation), 'Y/m/d') ?></small></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>   
    </div>
</body>
</html>
