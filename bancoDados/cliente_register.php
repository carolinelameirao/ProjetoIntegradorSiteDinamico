<?php

require_once('./crud_cliente.php');


if (
    $_POST['txtNome'] == NULL ||
    $_POST['txtEmail'] == NULL ||
    $_POST['txtCpf'] == NULL ||
    $_POST['txtTelefone'] == NULL ||
    $_POST['txtSenha'] == NULL
) {

    header('location: error.php?status=access-deny');
    die();
}

$usuario = new stdClass();
$usuario->nome = $_POST['txtNome'];
$usuario->email = $_POST['txtEmail'];
$usuario->cpf = $_POST['txtCpf'];
$usuario->telefone = $_POST['txtTelefone'];
$usuario->senha = $_POST['txtSenha'];

$result = create($usuario);

//echo "usuario" . var_dump($result);

if ($result) {
    header("location: cliente.access.php?email={$_POST['txtEmail']}&status=success");
    exit;
} else {
    header("location: ../cadastro.php?&status=fail");
    exit;
}
