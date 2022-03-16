<?php

require_once('./conexao.php');

function create($funcaoFuncionario, $funcionario)
{

       try {

        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("INSERT INTO funcaoFuncionario (funcao) VALUES (:funcao);");
        $stmt = $con->prepare("INSERT INTO funcionario (nome,idfuncaoFuncionario) VALUES (:nome, last_insert_id())");
        $stmt->bindParam(":funcao", $funcaoFuncionario->funcao);
        $stmt->bindParam(":nome", $funcionario->nome);


        if ($stmt->execute()) {
            echo "Dados do funcionário criado com sucesso";
        }
    } catch (PDOException $error) {
        echo "Error ao criar os dados do Funcionário. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}


#create test - 
$funcaoFuncionario= new stdClass();

$funcaoFuncionario->funcao =  "cabelereiro";
$funcionario->nome = "Maria de Fátima Araújo"

create($funcaoFuncionario, $funcionario);

echo "<br><br>---<br><br>";




function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT funcao FROM funcaoFuncionario");
            $rs = $con->query("SELECT nome FROM funcionario");


            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
               
                echo $row->funcao . "<br>";
                echo $row->nome . "<br>";
                
            }
        } catch (PDOException $error) {
            echo "Erro ao listar os dados do funcionário. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }

    #get test
    get();

    echo "<br><br>---<br><br>";


    function find($funcao, $nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT funcao FROM funcaoFuncionario WHERE id LIKE :id");
            $stmt = $con->prepare("SELECT nome FROM funcionario WHERE id LIKE :id");

            $stmt->bindValue(":funcao", "%{$funcao}%");
            $stmt->bindValue(":nome", "%{$nome}%");
            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                       
                        echo $row->funcao . "<br>";
                        echo $row->nome . "<br>";
                        }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar os dados do funcionário '{$funcao}' e '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    #teste do find
    find('cabelereiro', 'Maria de Fátima');



    
    function update($funcaoFuncionario , $funcionario)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE funcaoFuncionario SET  funcao = :funcao WHERE id = :id"); 
            $stmt = $con->prepare("UPDATE funcionario SET  nome = :nome WHERE id = :id"); 
            
            $stmt->bindParam(":funcao", $funcaoFuncionario->funcao);
            $stmt->bindParam(":id", $funcaoFuncionario->id); 
            $stmt->bindParam(":nome", $funcionario->nome);
            $stmt->bindParam(":id", $funcionario->id); 

            
            if ($stmt->execute())
                echo "Dados do funcionário atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar os dados do funcionário. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #teste upgrade 
     $funcaoFuncionario = new stdClass();  
     $funcionario = new stdClass(); 
     $funcaoFuncionario->funcao = "manicure";
     $funcaoFuncionario->id = 1;
     $funcionario->nome = "Jorge Luis";
     $funcionario->id = 1;


     get();



    function delete($id)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM funcaoFuncionario WHERE id = ?");
            $stmt->bindParam(1, $id); 
            $stmt = $con->prepare("DELETE FROM funcionario WHERE id = ?");
            $stmt->bindParam(1, $id); 


            if ($stmt->execute())
                echo "Dados do Funcionário deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar os dados do funcionários. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #delete test
    echo "<br><br>---<br><br>";
    delete(1); 
    echo "<br><br>---<br><br>";
 
 
    get();




