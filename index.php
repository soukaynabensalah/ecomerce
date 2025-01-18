<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ajouter utilisateur</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container">
        <?php
            if(isset($_POST['ajouter'])){
               $login = $_POST['login'];
               $pwd = $_POST['password'];
               if(!empty($login) && !empty($pwd)){
                    require_once 'include/db.php';
                    $date = date('y-m-d');
                    $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUES (NULL, ?, ?, ?)');
                    $sqlState->execute([$login, $pwd, $date]);
                    header('location:connexion.php');
               }else{
                ?>
                    <div class="alert alert-danger" role="alert">
                        Login et password sont obligatoires
                    </div>
                <?php
               };
            };
        ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" class="form-control" name="login">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <input type="submit" class="btn btn-primary " value="Ajouter utilisateur" name="ajouter">
        </form>
    </div>
</body>
</html>
