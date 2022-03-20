<?php
require_once('./crud_cliente.php');

if (
    $_POST['txtEmail'] == NULL ||
    $_POST['txtSenha'] == NULL
) {

    header('location: error.php?status=access-deny');
    die();
}

$usuario = new stdClass();
$usuario->email = $_POST['txtEmail'];
$usuario->senha = $_POST['txtSenha'];

$result = getLogin($usuario);

//echo "usuario" . var_dump($result);

if ($result) {
    header("location: cliente.access.php?email={$_POST['txtEmail']}&status=success");
    exit;
} else {
    header("location: ../login.html?&status=fail");
    exit;
}
