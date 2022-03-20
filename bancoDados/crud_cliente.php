<?php

require_once('./conexao.php');

    function create($usuario)
    {

        try {

            $con = getConnection();
            #Insert something

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
                echo " Cliente Cadastrado com sucesso";
            }
        } catch (PDOException $error) {
            echo "Error ao cadastrar o Cliente. Error: {$error->getMessage()}";
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

            $stmt = $con->prepare("SELECT email FROM login WHERE email = :email, senha = :senha");

            $stmt->bindParam(":email", $usuario->email);
            $stmt->bindValue(":senha", md5($usuario->senha));

                return $stmt->fetch(PDO::FETCH_OBJ);
        }
            catch  (PDOException $error) 
        {
                echo "Erro ao efetuar o login. Erro: {$error->getMessage()}";
        }
            finally {
                unset($con);
                unset($stmt);
            }
        }

#getLogin test -
/*getLogin($usuario);
echo "<br><br>---<br><br>";*/

    function get()
        {
            try {
                $con = getConnection();

                $rs = $con->query("SELECT idLogin, nome, cpf, telefone, dataCadastro, email FROM cliente_data");

                while ($clientes = $rs->fetch(PDO::FETCH_OBJ)) {
                    echo $clientes->idLogin . "<br>";
                    echo $clientes->Nome . "<br>";
                    echo $clientes->CPF . "<br>";
                    echo $clientes->Telefone . "<br>";
                    echo $clientes->DataCadastro . "<br>";
                    echo $clientes->Email . "<br>";
                }

            } catch (PDOException $error) {
                echo "Erro ao listar clientes. Erro: {$error->getMessage()}";
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

            $stmt = $con->prepare("SELECT  idLogin, nome, cpf, telefone, dataCadastro, email FROM cliente_data WHERE nome LIKE :nome");
            
            $stmt->bindValue(":nome", "%{$nome}%");

            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($nomes = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $nomes->idLogin . "<br>";
                        echo $nomes->Nome . "<br>";
                        echo $nomes->CPF . "<br>";
                        echo $nomes->Telefone . "<br>";
                        echo $nomes->DataCadastro . "<br>";
                        echo $nomes->Email . "<br>";
                    }                       
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

    function update($usuario)
    {
        try {
        $con = getConnection();
        #Insert something

        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $query = "UPDATE login SET email = :email, senha = :senha WHERE id = :id);";
        $query .= "UPDATE login SET nome = :nome, telefone = :telefone, last_Insert_id() WHERE cpf = :cpf;";

        $stmt = $con->prepare($query);
        
        $stmt->bindParam(":email", $usuario->email);
        $stmt->bindValue(":senha", md5($usuario->senha));
        $stmt->bindParam(":nome", $usuario->nome);
        $stmt->bindParam(":telefone", $usuario->telefone);
        $stmt->bindParam(":idLogin", $usuario->idLogin);
        $stmt->bindParam(":cpf", $usuario->cpf);
        
           if ($stmt->execute())
                echo "Cliente atualizado com sucesso.";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o cliente. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #teste upgrade 
    get();
    echo "<br>---<br>";

    $usuario = new stdClass();
    $usuario->nome = "Clara Maria Cerqueira";
    $usuario->cpf = "356.254.147-54";
    $usuario->email =  "ccerqueira@gmail.com";
    $usuario->senha = "rosada98";
    $usuario->telefone = "(21) 3568 4127";
    $usuario->id = 2;
    update($usuario);

    echo "<br>---<br>";
    get();

    function delete($idLogin)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM cliente WHERE idLogin = ?");
            
            $stmt->bindParam(1, $idLogin); 

            if ($stmt->execute())
                echo "Cliente deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar Cliente. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #delete test
    /*echo "<br><br>---<br><br>";
    delete(3); 
    echo "<br><br>---<br><br>";
 
 
    get();*/




