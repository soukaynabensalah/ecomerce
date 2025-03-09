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
            $id = $_GET['id'];
            $res = $pdo->prepare('SELECT * FROM produit WHERE id = ?');
            $res->execute([$id]);
            $r = $res->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST['modifier'])) {
                $libelle = $_POST['libelle'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $categorie = $_POST['categorie'];
                $desc = $_POST['desc'];
                $date = date('y-m-d');
                if(!empty($libelle) && !empty($prix) && !empty($categorie)){
                    $sqlState = $pdo->prepare('UPDATE produit SET 
                                                    libelle = ?,
                                                    prix = ?,
                                                    discount = ?,
                                                    id_categorie = ?, 
                                                    date_creation = ?,
                                                    description = ?
                                                    WHERE id = ?
                    ');
                    $inserted = $sqlState->execute([$libelle, $prix, $discount, $categorie, $date, $desc, $id]);
                    if($inserted){
                    header('location:produits.php');
                    }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            erreur de base données
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
                <input name="libelle" type="text" class="form-control" value='<?= $r['libelle'] ?>'>
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input name="prix" type="number" class="form-control" min='0' step="0.1" value='<?= $r['prix'] ?>'>
            </div>
            <div class="mb-3">
                <label class="form-label">Discount</label>
                <input name="discount" type="range" class="form-control" min='0' max='100' value="<?= $r['discount'] ?>">
            </div>
            <?php
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                $id_c = $r['id_categorie'];
                $c = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
                $c->execute([$id_c]);
                $ctg = $c->fetch(PDO::FETCH_ASSOC);
            ?>
            <label class="form-label">Categorie</label>
            <select name="categorie" class="form-control">
                <option value="<?= $r['id_categorie'] ?>"><?= $ctg['libelle'] ?></option>
                <?php 
                    foreach ($categories as $categorie) {
                        echo '<option value="' . $categorie['id'] . '">' . $categorie['libelle'] . '</option>';
                    }
                ?>
            </select>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="desc" class="form-control"><?php echo htmlspecialchars($r['description']); ?></textarea>
            </div>

            <br><br>
            <input type="submit" class="btn btn-primary" value="Modifier produit" name="modifier">
        </form>
    </div>
</body>
</html>

