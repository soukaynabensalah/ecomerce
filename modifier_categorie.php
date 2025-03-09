<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modifier categorie</title>
</head>
<body>
    <?php include 'include/nav.php'; ?>
    <div class="container">
        <?php
            require_once 'include/db.php';
            $id = $_GET['id'];
            $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
            $sqlState->execute([$id]);
            $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['modifier'])){
                $libelle = $_POST['libelle'];
                $desc = $_POST['description'];
                if (!empty($libelle) && !empty($desc)) {
                        $sqlState = $pdo->prepare('UPDATE categorie SET libelle = ?, description = ? WHERE id = ?');
                        $sqlState->execute([$libelle, $desc, $id]);
                        header('location:categories.php');
                } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Libelle et description sont obligatoires!
                        </div>
                    <?php
                }
            }
        ?>
        <h1>Modifier categorie</h1>
        <form method="post">
        <div class="mb-3">
                <input name="id" type="hidden" class="form-control" value="<?= $categorie['id']?>" >
            </div>
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input name="libelle" type="text" class="form-control" value="<?= $categorie['libelle']?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" value=""><?= $categorie['description']?></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">
        </form>
    </div>
</body>
</html>

