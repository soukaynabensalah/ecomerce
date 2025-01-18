<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Liste des categories</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container py-2">
        <h1>Liste des categories</h1>
        <a href="ajouter_categorie.php" class="btn btn-primary">Ajouter categorie</a>
        <table class="table table-striped">
            <tr>
                <th>#ID</th>
                <th>Libelle</th>
                <th>Description</th>
                <th>Date</th>
                <th>Operations</th>
            </tr>
            <?php
            include 'include/db.php';
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            foreach($categories as $categorie){
            ?>
                <tr>
                    <td><?= $categorie['id'] ?></td>
                    <td><?= $categorie['libelle'] ?></td>
                    <td><?= $categorie['description'] ?></td>
                    <td><?= $categorie['date_creation'] ?></td>
                    <td>
                        <a href="modifier_categorie.php?id=<?= $categorie['id'] ?>" class='btn btn-primary btn-sm' >Modifier</a>
                        <a href="supprimer_categorie.php?id=<?= $categorie['id'] ?>" class='btn btn-danger btn-sm' onclick="return confirm('Voulez vous  vraiment supprimer categorie : <?= $categorie['libelle'] ?> ?');">Supprimer</a>
                    </td>
                </tr>
            <?php   
            }
        ?>
        </table>
    </div>
</body>
</html>
