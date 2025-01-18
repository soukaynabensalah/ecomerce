<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
    <?php include 'include/nav.php' ?>
    <div class="container">
        <?php
            if(isset($_POST['cnx'])){
                $login = $_POST['login'];
                $pwd = $_POST['password'];
                if(!empty($login) && !empty($pwd)){
                    require_once 'include/db.php';
                    $sqlState = $pdo->prepare('SELECT * FROM utilisateur WHERE login=? AND password = ?');
                    $sqlState->execute([$login, $pwd]);
                    if($sqlState->rowCount() >= 1){
                        $_SESSION['utilisateur'] = $sqlState->fetch();
                        header('location:admin.php');
                    }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Login ou password invalid
                        </div>
                    <?php                        
                    }

                }else{
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Login et password sont obligatoires
                        </div>
                    <?php
                };
            }
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
            <input type="submit" class="btn btn-primary " value="Connexion" name="cnx">
        </form>
    </div>
</body>
</html>
