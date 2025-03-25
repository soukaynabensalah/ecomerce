<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Liste categories</title>
</head>
<body>
    <?php 
        require_once '../include/db.php';
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <h1><i class="fa-solid fa-list"></i>  Liste des categories</h1>
        <ul class="list-group list-group-flush">
        <?php
            foreach($categories as $categorie){
        ?> 
            <li class="list-group-item">
                <a href="categorie.php?id=<?=$categorie->id?>" class='btn btn-light'><i class="<?=$categorie->icone?>"></i> <?=$categorie->libelle?></a>
            </li>
            <?php      
            }
        ?>
        </ul>
    </div>
</body>
</html>
