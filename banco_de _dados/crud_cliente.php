<?php

require_once('./conexao.php');

function create($cliente)
{

       try {

        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("INSERT INTO cliente(nome, cpf, dataNasc, endereco, celular) VALUES (:nome , :cpf , :dataNasc , :endereco , :celular)");

        $stmt->bindParam(":nome", $cliente->nome);
        $stmt->bindParam(":cpf", $cliente->cpf);
        $stmt->bindParam(":dataNasc", $cliente->dataNasc);
        $stmt->bindParam(":endereco", $cliente->endereco);
        $stmt->bindParam(":celular", $cliente->celular);

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
$cliente->dataNasc = 25/06/1997;
$cliente->endereco = "Rua Araguari, 256 - Rio de Janeiro, RJ";
$cliente->celular = "(21) 9935 4851";
create($cliente);

echo "<br><br>---<br><br>";




function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome, cpf, dataNasc, endereco, celular FROM cliente");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->cpf . "<br>";
                echo $row->dataNasc . "<br>";
                echo $row->endereco . "<br>";
                echo $row->celular . "<br>";
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

            $stmt = $con->prepare("SELECT nome, cpf, dataNasc, endereco, celular FROM cliente WHERE cpf LIKE :cpf");
            # o bindParam recebe os parâmetros por referência, não é possível usar literais.
            # para literais usa-se bindValue
            $stmt->bindValue(":cpf", "%{$cpf}%");

            # https://www.php.net/manual/en/pdostatement.debugdumpparams
            // $stmt->debugDumpParams();

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->cpf . "<br>";
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

            $stmt = $con->prepare("UPDATE cliente SET nome= :nome, cpf = :cpf , dataNasc = :dataNasc , endereco = :endereco ,  WHERE celular = :celular"); 
            // *** depois de endereco = :endereco precisa colocar o celular = :celular. Vou atualizar o celular do cliente**//

            $stmt->bindParam(":id", $cliente->id); //*** Precisa colocar? */
            $stmt->bindParam(":nome", $cliente->nome);
            $stmt->bindParam(":cpf", $cliente->cpf);
            $stmt->bindParam(":dataNasc", $cliente->dataNasc);
            $stmt->bindParam(":endereco", $cliente->endereco);
            $stmt->bindParam(":celular", $cliente->celular);

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
     $cliente = new stdClass();   //*** Não coloquei $cliente->id  não sei se precisa*/
     $cliente->nome = "Clara Cerqueira";
     $cliente->cpf = "356.254.147-54";
     $cliente->dataNasc = 25/06/1997;
     $cliente->endereco = "Rua Araguari, 256 - Rio de Janeiro, RJ";
     $cliente->celular = "(21) 99935 4851";

     update($cliente); 


     get();



    function delete($cpf)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM cliente WHERE cpf = ?");
            $stmt->bindParam("356.254.147-54", $cpf); //** É assim que eu passo o valor do cpf? */

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
    delete("356.254.147-54"); //** Não sei se está certo */
    echo "<br><br>---<br><br>";
 
 
    get();




