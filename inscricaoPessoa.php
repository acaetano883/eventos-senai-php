<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] === "POST"){

$nome = $_POST['nome'];
$email = $_POST ['email'];
$eventoId = $_POST ['evento_id'];

$inscrito = false;



if (!isset($_SESSION['inscricoes'])) {
    $_SESSION['inscricoes'] = [];
}

foreach ($_SESSION['eventos'] as $evento){
    if ($eventoId === $evento['id']){

    foreach($_SESSION['inscricoes'] as $inscricao){
        if ($email === $inscricao['email'] && $eventoId === $inscricao['evento_id']){
            $inscrito = true;
            print "Usuário já inscrito no evento!";
        }
    }
        if ($inscrito === false){
            $_SESSION['inscricoes'][]=[
        'nome' => $nome,
        'email' => $email,
        'evento_id' => $eventoId,
        ];

        print "Inscrição realizada com sucesso!";
            }
        }
    }
}




?>






<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscricao</title>
</head>
<body>
    

<form action="inscricaoPessoa.php" method="POST">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome">

    <br><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email">

    <br><br>

    <label for="evento_id">Evento:</label>

    <select name="evento_id" id="evento_id">

        <?php foreach ($_SESSION['eventos'] as $evento) { ?>

            <option value="<?= $evento['id'] ?>">
                <?= $evento['titulo'] ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <button type="submit">Cadastrar</button>

</form>
</body>
</html>