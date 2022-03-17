<?php

require_once('./crud_cliente.php');


if($_POST['txtnome'] == NULL || $_POST['txtcpf'] == NULL || $_POST['txtemail'] == NULL || $_POST['txtsenha'] == NULL ||  $_POST['textdataCadastro'] == NULL || $_POST['texttelefone'] == NULL)
{
    header('location: ./error.php?status=access-deny'); 
    die(); 

$cliente = new stdClass();
$cliente->nome=$_POST['txtnome'];
$cliente->cpf=$_POST['txtcpf'];
$cliente->email=$_POST['txtemail'];
$cliente->senha=$_POST['txtsenha'];
$cliente->dataCadastro=$_POST['txtdataCadastro'];
$cliente->telefone=$_POST['txttelefone'];

create($cliente);

?>
