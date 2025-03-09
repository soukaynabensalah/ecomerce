<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Liste des produits</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h1>Liste des produits</h1>
        <a href="ajouter_produit.php" class="btn btn-primary">Ajouter produit</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Libelle</th>
                    <th>Prix</th> 
                    <th>Discount</th>
                    <th>Prix final</th>
                    <th>Categorie</th>
                    <th>Date</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'include/db.php';
                    $produits = $pdo->query('SELECT p.*, c.libelle AS libelle_categorie FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id')->fetchAll(PDO::FETCH_ASSOC);
                    foreach($produits as $produit){ 
                        $prix = $produit['prix'];
                        $discount = $produit['discount'];
                        $prixFinale = $prix - (($prix * $discount)/100);
                ?> 
                    <tr>
                        <td><?= $produit['id'] ?></td>
                        <td><?= $produit['libelle'] ?></td>
                        <td><?= $produit['prix'] ?> MAD</td>
                        <td><?= $produit['discount'] ?> %</td>
                        <td><?= $prixFinale ?> MAD</td>
                        <td><?= $produit['libelle_categorie'] ?></td>
                        <td><?= $produit['date_creation'] ?></td>
                        <td>
                            <a href="modifier_produit.php?id=<?= $produit['id'] ?>" class="btn btn-primary btn-sm" >modifier</a>
                            <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('voulez vous vraiment supprimer le produit <?= $produit['libelle']?> ?');">supprimer</a>
                        </td>
                    </tr>
                <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>
