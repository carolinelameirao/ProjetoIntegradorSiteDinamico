<?php

require_once('./crud_cliente.php');

if ($_GET['idLogin'] == NULL) {
    header("location: error.php?status=access-deny");
    die();
}

$result = delete($_GET['idLogin']);

if ($result) {
    header("location: ../login.html?status=success");
    die();
}

header("location: cliente.access.php?email={$_POST['txtEmail']}&status=fail");
die();
