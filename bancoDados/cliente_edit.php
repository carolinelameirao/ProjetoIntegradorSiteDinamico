<?php
require_once('./crud_cliente.php');

if (
    $_POST['txtIdLogin'] == NULL ||
    $_POST['txtNome'] == NULL ||
    $_POST['txtCpf'] == NULL ||
    $_POST['txtTelefone'] == NULL ||
    $_POST['txtEmail'] == NULL ||
    $_POST['txtSenha'] == NULL
) {
    header('location: error.php?status=access-deny');
    exit;
}

$usuario = new stdClass();
$usuario->idLogin = $_POST['txtIdLogin'];
$usuario->Nome = $_POST['txtNome'];
$usuario->CPF = $_POST['txtCpf'];
$usuario->Telefone = $_POST['txtTelefone'];
$usuario->Email = $_POST['txtEmail'];
$usuario->Senha = $_POST['txtSenha'];

$result = update($usuario);

//echo "usuario" . var_dump($result);

if ($result) {
    header("location: cliente.access.php?email={$_POST['txtEmail']}&status=success");
    exit;
} else {
    header("location: cadastro.php?&status=fail");
    exit;
}
