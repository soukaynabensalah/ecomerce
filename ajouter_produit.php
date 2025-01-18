<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ajouter produit</title>
</head>
<body>
    <?php 
    require_once 'include/db.php';
    include 'include/nav.php'; ?>
    <div class="container">
        <?php
            if (isset($_POST['ajouter'])) {
                $libelle = $_POST['libelle'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $categorie = $_POST['categorie'];
                $date = date('y-m-d');
                if(!empty($libelle) && !empty($prix) && !empty($categorie)){
                    $sqlState = $pdo->prepare('INSERT INTO produit VALUES(null, ?, ?, ?, ?, ?)');
                    $inserted = $sqlState->execute([$libelle, $prix, $discount, $categorie, $date]);
                    if($inserted){
                    header('location:produits.php');
                    }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Data base erreur
                        </div>
                    <?php   
                    }
                }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Libelle, prix, categorie sont obligatoires!
                        </div>
                    <?php                   
                }
            }
        ?>
        <h1>Ajouter ajouter_produit</h1>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input name="libelle" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input name="prix" type="number" class="form-control" min='0' step="0.1">
            </div>
            <div class="mb-3">
                <label class="form-label">Discount</label>
                <input name="discount" type="range" class="form-control" min='0' max='100' value="0">
            </div>
            <?php
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label class="form-label">Categorie</label>
            <select name="categorie" class="form-control">
                <option value="">Choisissez une catégorie</option>
                <?php 
                    foreach ($categories as $categorie) {
                        echo '<option value="' . $categorie['id'] . '">' . $categorie['libelle'] . '</option>';
                    }
                ?>
            </select>
            <br><br>
            <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter">
        </form>
    </div>
</body>
</html>

