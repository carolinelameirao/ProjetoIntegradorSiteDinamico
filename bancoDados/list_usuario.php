<?php
require_once('./conexao.php');

$con = getConnection();

$search = $_GET['email'];

$query = "SELECT * FROM cliente_data WHERE email = :email";

$result = $con->prepare($query);

$result->bindParam(":email", $search, PDO::PARAM_STR);
$result->execute();

/*foreach($result as $row)
{
    echo '';
    echo $row['idLogin'] . ", " . $row['Nome'] . ", " . $row['CPF'] . ", " . $row['Telefone'] . ", " . $row['DataCadastro'] . ", " . $row['Email'];
    echo '';
}*/

//echo "usuario <br>" . var_dump($result);