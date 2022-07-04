<?php 
include('conexao.php');

if (isset($_POST['email']) || isset($_POST['password'])) {

    if (strlen($_POST['email']) == 0) {
        echo 'Preencha o campo email';
    } else if (strlen($_POST['password']) == 0) {
        echo 'Preencha o campo senha';
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['password']);

        $exec = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
        $query = $mysqli->query($exec) or die('Falha ao executar consulta! mensagem: '.$mysqli->error);

        $num_rows = $query->num_rows;

        if ($num_rows == 1) {
            $login = $query->fetch_assoc();
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $login['id'];
            //$_SESSION['user'] = $login['email'];

            header('Location: admin.php');

        } else {
            echo 'Email ou senha incorretos!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="email"> Email: </label>
        <input type="email" name="email" placeholder="digite seu email"> <br>
        <label for="password"> Senha: </label>
        <input type="password" name="password" placeholder="digite sua senha"> <br>
        <input type="submit">
    </form>
</body>
</html>