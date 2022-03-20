<?php

require_once('./conexao.php');

function create($usuario)
{

    try {
        $con = getConnection();

        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "INSERT INTO login(email, senha) VALUES (:email, :senha);";
        $query .= "INSERT INTO cliente(cpf, nome, telefone, idLogin) VALUES (:cpf, :nome, :telefone, last_Insert_id());";

        $stmt = $con->prepare($query);

        $stmt->bindParam(":email", $usuario->email);
        $stmt->bindValue(":senha", md5($usuario->senha));
        $stmt->bindParam(":cpf", $usuario->cpf);
        $stmt->bindParam(":nome", $usuario->nome);
        $stmt->bindParam(":telefone", $usuario->telefone);

        if ($stmt->execute()) {
            //echo " Cliente Cadastrado com sucesso";
            return true;
        }
    } catch (PDOException $error) {
        //echo "Error ao cadastrar o Cliente. Error: {$error->getMessage()}";
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}


#create test - 
/*$usuario = new stdClass();
$usuario->nome = "Caroline Lameirão";
$usuario->cpf = "11111111111";
$usuario->email =  "carolinelameirao@outlook.com";
$usuario->senha = "1234567";
$usuario->telefone = "21982935810";
create($usuario);
echo "<br><br>---<br><br>";*/

function getLogin($usuario)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT email, senha FROM login WHERE email = :email AND senha = :senha");

        $stmt->bindParam(":email", $usuario->email);
        $stmt->bindValue(":senha", md5($usuario->senha));

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $error) {
        echo "Erro ao efetuar o login. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}

#getLogin test -
/*$usuario = new stdClass();
$usuario->email = "carolinelameirao@outlook.com";
$usuario->senha = "1234567";
echo "<br><br>---<br><br>";

echo "Usuário" . var_dump(getLogin($usuario));*/

function get()
{
    try {
        $con = getConnection();

        $rs = $con->query("SELECT * FROM cliente_data");

        $usuarios = array();

        while ($usuario = $rs->fetch(PDO::FETCH_OBJ)) {
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    } catch (PDOException $error) {
        echo "Erro ao listar o cliente. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($rs);
    }
}

#get test
/*get();

echo "<br><br>---<br><br>";*/

function find($nome)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT  * FROM cliente_data WHERE nome LIKE :nome");
        $stmt->bindValue(":nome", "%{$nome}%");

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $usuarios = array();
                while ($usuario = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($usuarios, $usuario);
                }
                return $usuarios;
            }
        }
    } catch (PDOException $error) {
        echo "Erro ao buscar o nome '{$nome}'. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}

#teste do find
//find("Clara");

function findById($idLogin)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT * FROM cliente_data WHERE idLogin = :idLogin");
        $stmt->bindParam(":idLogin", $idLogin);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        }
    } catch (PDOException $error) {
        echo "Erro ao buscar o client pelo código: '{$idLogin}'. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}



function update($usuario)
{
    try {
        $con = getConnection();

        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "UPDATE login SET email = :email, senha = :senha WHERE id = :idLogin;";
        $query .= "UPDATE cliente SET cpf = :cpf, nome = :nome, telefone = :telefone WHERE idLogin = :idLogin;";

        $stmt = $con->prepare($query);

        $stmt->bindParam(":email", $usuario->Email);
        $stmt->bindValue(":senha", md5($usuario->Senha));
        $stmt->bindParam(":cpf", $usuario->CPF);
        $stmt->bindParam(":nome", $usuario->Nome);
        $stmt->bindParam(":telefone", $usuario->Telefone);
        $stmt->bindParam(":idLogin", $usuario->idLogin);

        if ($stmt->execute())
            //echo "Cliente atualizado com sucesso.";
            return true;
    } catch (PDOException $error) {
        //echo "Erro ao atualizar o cliente. Erro: {$error->getMessage()}";
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

#teste upgrade 
/*get();
    echo "<br>---<br>";

    $usuario = new stdClass();
    $usuario->nome = "Caroline Lameirão";
    $usuario->cpf = "22222222222";
    $usuario->email =  "carolinelameirao@outlook.com";
    $usuario->senha = "1234567";
    $usuario->telefone = "21982935810";
    $usuario->idLogin = 1;
    update($usuario);

    echo "<br>---<br>";
    get();*/

function delete($idLogin)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("DELETE FROM cliente WHERE idLogin = ?");

        $stmt->bindParam(1, $idLogin);

        if ($stmt->execute())
            //echo "Cliente deletado com sucesso";
            return true;
    } catch (PDOException $error) {
        //echo "Erro ao deletar Cliente. Erro: {$error->getMessage()}";
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

    #delete test
    /*get();

    echo "<br><br>---<br><br>";
    delete(4); 
    echo "<br><br>---<br><br>";
 
    get();*/