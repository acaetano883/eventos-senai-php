<?php
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    echo "ID do formulário recebido: " . $id;
} else {
    echo "Nenhum ID enviado.";
}
echo $id;
if ($id < 0){
    echo "ID INVÁLIDO" . $id;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de validação de ID</title>
</head>
<body>
    <h2>Confirmação de ID</h2>
     <input type="text" id="inputId" placeholder="Digite o ID aqui">
    <button> </button>
    <form>
  <input type="text" name="nome">
  <button type="reset">Cancelar / Limpar</button>
</form>

</body>

