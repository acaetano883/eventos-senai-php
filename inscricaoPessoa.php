<?php 
session_start();

$eventoId = $_GET['evento_id'] ?? null;

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $eventoId = $_POST['evento_id'];

    $inscrito = false;

    if (!isset($_SESSION['inscricoes'])) {
        $_SESSION['inscricoes'] = [];
    }

    foreach ($_SESSION['eventos'] as $evento){

        if ($eventoId == $evento['id']){

            foreach($_SESSION['inscricoes'] as $inscricao){

                if ($email === $inscricao['email'] && $eventoId === $inscricao['evento_id']){
                    $inscrito = true;

                    print "Usuário já inscrito no evento!";
                    print "<br>";
                    print "<a href='index.php'>Voltar para eventos</a>";
                }
            }

            if ($inscrito === false){

                $quantidadeInscritos = 0;

                foreach($_SESSION['inscricoes'] as $inscricao){

                    if ($inscricao['evento_id'] == $eventoId){
                        $quantidadeInscritos++;
                    }
                }

                if (isset($evento['capacidade']) && $quantidadeInscritos >= $evento['capacidade']){

                    print "Inscrições esgotadas!";
                    print "<br>";
                    print "<a href='index.php'>Voltar para eventos</a>";

                } else {

                    $_SESSION['inscricoes'][]=[
                        'nome' => $nome,
                        'email' => $email,
                        'evento_id' => $eventoId,
                    ];

                    print "Inscrição realizada com sucesso!";
                    print "<br>";
                    print "<a href='index.php'>Voltar para eventos</a>";
                }
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

<h1>Inscrição</h1>

<?php

foreach ($_SESSION['eventos'] as $evento){

    if (isset($eventoId) && $eventoId == $evento['id']){

        print "Evento: " . $evento['titulo'];
        print "<br>";

        if (isset($evento['capacidade'])){
            print "Limite de inscritos: " . $evento['capacidade'] . " pessoas";
        } else {
            print "Limite de inscritos: Não definido";
        }
    }
}

?>

<br><br>

<?php

$eventoCheio = false;

foreach ($_SESSION['eventos'] as $evento){

    if (isset($eventoId) && $eventoId == $evento['id']){

        $quantidadeInscritos = 0;

        foreach($_SESSION['inscricoes'] as $inscricao){

            if ($inscricao['evento_id'] == $evento['id']){
                $quantidadeInscritos++;
            }
        }

        if (isset($evento['capacidade']) && $quantidadeInscritos >= $evento['capacidade']){

            $eventoCheio = true;

            print "Inscrições esgotadas!";
            print "<br>";
            print "Não há mais vagas disponíveis.";
            print "<br><br>";
            print "<a href='index.php'>Voltar para eventos</a>";
        }
    }
}

?>

<?php if ($eventoCheio === false) { ?>

<form action="inscricaoPessoa.php" method="POST">

    <input type="hidden" name="evento_id" value="<?= $eventoId ?>">

    <br>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>

    <br><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required>

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php } ?>

<h1>Inscritos</h1>

<?php

if (isset($_SESSION['inscricoes'])) {

    foreach ($_SESSION['inscricoes'] as $inscricao) {

        if (isset($eventoId) && $inscricao['evento_id'] == $eventoId) {

            print $inscricao['nome'];
            print " - ";
            print $inscricao['email'];
            print "<br>";

        }
    }
}

?>

<br>

<?php

foreach ($_SESSION['eventos'] as $evento){

    if (isset($eventoId) && $eventoId == $evento['id']){

        $quantidadeInscritos = 0;

        foreach($_SESSION['inscricoes'] as $inscricao){

            if ($inscricao['evento_id'] == $evento['id']){
                $quantidadeInscritos++;
            }
        }

        print "Total de inscritos: " . $quantidadeInscritos;
        print "<br>";

        if (isset($evento['capacidade'])){
            print "Limite de inscritos: " . $evento['capacidade'] . " pessoas";
        } else {
            print "Limite de inscritos: Não definido";
        }
    }
}

?>

</body>
</html>