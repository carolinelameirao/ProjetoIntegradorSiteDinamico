<?php

require_once('./conexao.php');

function create($cliente)
{

       try {

        $con = getConnection();
        #Insert something

        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        
        $query = "INSERT INTO login(email, senha) VALUES (:email, :senha);";
        $query .= "INSERT INTO cliente(cpf, nome, telefone, idLogin) VALUES (:cpf, :nome, :telefone, last_Insert_id());";
        
        $stmt = $con->prepare($query);

        $stmt->bindParam(":email", $cliente->email);
        $stmt->bindParam(":senha", $cliente->senha);
        $stmt->bindParam(":cpf", $cliente->cpf);
        $stmt->bindParam(":nome", $cliente->nome);
        $stmt->bindParam(":telefone", $cliente->telefone);
        

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
/*$cliente = new stdClass();
$cliente->nome = "Clara Cerqueira";
$cliente->cpf = "356.254.147-54";
$cliente->email =  "ccerqueira@gmail.com";
$cliente->senha = "rosada98";
$cliente->telefone = "(21) 3568 4127";

create($cliente);

echo "<br><br>---<br><br>";
*/



function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT * FROM cliente_data");

            $cliente = array();

            while ($clientes = $rs->fetch(PDO::FETCH_OBJ)) {
                array_push($cliente, $clientes);
            }
            return $cliente;

        } catch (PDOException $error) {
            echo "Erro ao listar cliente. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }

    #get test
   // get();

    //echo "<br><br>---<br><br>";


    function find($nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT * FROM cliente_data WHERE nome LIKE :nome");
            
            $stmt->bindValue(":nome", "%{$nome}%");

            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                   
                    $nome = array();

                    while ($nomes = $stmt->fetch(PDO::FETCH_OBJ)) {
                        array_push($nome, $nomes);
                    }
                        //print_r($nome);
                       return $nome;  
                    
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
   // find("Clara");



    
    function update($cliente)
    {
        try {
        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("UPDATE cliente SET nome = :nome, telefone = :telefone WHERE idLogin = :idLogin");
        
        $stmt->bindParam(":nome", $cliente->nome);
        $stmt->bindParam(":telefone", $cliente->telefone);
        $stmt->bindParam(":idLogin", $cliente->idLogin);
        
           if ($stmt->execute())
                echo "Cliente atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o cliente. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #teste upgrade 
    /* $cliente = new stdClass();  
     $cliente->idLogin = 6;
     $cliente->nome = "Clara Cerqueiras";
     $cliente->telefone = "(21) 3568 4128";
     

    update($cliente);
*/


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
    echo "<br><br>---<br><br>";
    delete(6); 
    echo "<br><br>---<br><br>";
 
 
    get();




