<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ajouter categorie</title>
</head>
<body>
    <?php include 'include/nav.php'; ?>
    <div class="container">
        <?php
            if (isset($_POST['ajouter'])) {
                $libelle = $_POST['libelle'];
                $desc = $_POST['description'];
                if (!empty($libelle) && !empty($desc)) {
                        require_once 'include/db.php';
                        $sqlState = $pdo->prepare('INSERT INTO categorie(libelle, description) VALUES(?, ?)');
                        $sqlState->execute([$libelle, $desc]);
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
        <h1>Ajouter categorie</h1>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Libelle</label>
                <input name="libelle" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter">
        </form>
    </div>
</body>
</html>

