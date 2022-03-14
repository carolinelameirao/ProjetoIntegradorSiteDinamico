<?php

require_once('./crud_cliente.php');


if($_POST['txtnome'] == NULL || $_POST['txtcpf'] == NULL || $_POST['txtdataNasc'] == NULL || $_POST['txtendereco'] == NULL || $_POST['txtcelular'] == NULL || $_POST['textdataCadastro'])
{
    header('location: ./error.php?status=access-deny'); 
    die(); 

$cliente = new stdClass();
$cliente->nome=$_POST['txtnome'];
$cliente->cpf=$_POST['txtcpf'];
$cliente->dataNasc=$_POST['txtdataNasc'];
$cliente->endereco=$_POST['txtendereco'];
$cliente->celular=$_POST['txtcelular'];
$cliente->dataCadastro=$_POST['txtdataCadastro'];

create($cliente);

?>
