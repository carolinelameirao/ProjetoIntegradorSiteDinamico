<?php

require_once('./conexao.php');

function create($cliente)
{

       try {

        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("INSERT INTO cliente(cpf, nome, telefone) VALUES (:cpf, :nome, :telefone)");

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
$cliente = new stdClass();
$cliente->nome = "Clara Cerqueira";
$cliente->cpf = "356.254.147-54";
$cliente->email =  "ccerqueira@gmail.com";
$cliente->senha = "rosada987";
$cliente->telefone = "(21) 3568 4127";

create($cliente);

echo "<br><br>---<br><br>";




function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome, cpf, email, senha, telefone, dataCadastro FROM cliente");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->cpf . "<br>";
                echo $row->email . "<br>";
                //echo $row->senha . "<br>"; Passamos o valor mas não listamos
                echo $row->telefone . "<br>";
                echo $row->dataCadastro . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar cliente. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }

    #get test
    get();

    echo "<br><br>---<br><br>";


    function find($cpf)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT nome, cpf, email, senha, telefone, dataCadastro FROM cliente WHERE cpf LIKE :cpf");
            
            $stmt->bindValue(":cpf", "%{$cpf}%");

            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->cpf . "<br>";
                        echo $row->email . "<br>";
                        //echo $row->senha . "<br>"; Passamos o valor mas não listamos
                        echo $row->telefone . "<br>";
                        echo $row->dataCadastro . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar o cliente '{$cpf}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    #teste do find
    find("356.254.147-54");



    
    function update($cliente)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE cliente SET nome= :nome, email = :email , senha = :senha , telefone = :telefone,
             dataCadastro = :dataCadastro WHERE cpf = :cpf"); 
            
            
             
            $stmt->bindParam(":nome", $cliente->nome);
            $stmt->bindParam(":cpf", $cliente->cpf);
            $stmt->bindParam(":email", $cliente->email);
            $stmt->bindParam(":senha", $cliente->senha); 
            $stmt->bindParam(":telefone", $cliente->telefone);
            $stmt->bindParam(":dataCadastro", $cliente->dataCadastro);

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
     $cliente = new stdClass();   
     $cliente->cpf = "356.254.147-54";
     $cliente->email = "ccerqueira@gmail.com.br";
     $cliente->senha = "rosada987";
     $cliente->telefone = "(21) 3568 4127";
      


     get();



    function delete($cpf)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM cliente WHERE cpf = ?");
            $stmt->bindParam("356.254.147-54", $cpf); 

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
    delete("356.254.147-54"); 
    echo "<br><br>---<br><br>";
 
 
    get();




