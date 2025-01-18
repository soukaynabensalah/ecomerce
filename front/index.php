
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <title>Liste categories</title>
</head>
<body>
    <?php 
        require_once '../include/db.php';
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <h1>Liste des categories</h1>
        <ul class="list-group list-group-flush">
        <?php
            foreach($categories as $categorie){
        ?> 
            <li class="list-group-item">
                <a href="categorie.php?id=<?=$categorie->id?>" class='btn btn-light'><?=$categorie->libelle?></a>
            </li>
            <?php      
            }
        ?>
        </ul>
    </div>
</body>
</html>
