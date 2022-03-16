<?php

require_once('./conexao.php');

function create($login)
{

       try {

        $con = getConnection();
        #Insert something

        $stmt = $con->prepare("INSERT INTO login (email, senha)
         VALUES (:email , :senha)");
        
        $stmt->bindParam(":email", $login->email);
        $stmt->bindParam(":senha", $login->senha);
        

        if ($stmt->execute()) {
            echo "Login criado com sucesso";
        }
    } catch (PDOException $error) {
        echo "Error ao criar o Login. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}


#create test - 
/*$login= new stdClass();

$login->email =  "ccerqueira@gmail.com";
$login->senha = "rosada987";


create($login);

echo "<br><br>---<br><br>";*/




function get()
{
    try {
        $con = getConnection();

        $rs = $con->query("SELECT email, senha FROM login");

        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
               
            echo $row->email . "<br>";
        
        }
    } catch (PDOException $error) {
        echo "Erro ao listar os dados do Login. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($rs);
    }
}

    #get test
    /*get();

    echo "<br><br>---<br><br>";*/


    function find($email)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT senha FROM login WHERE email LIKE :email");
            
            $stmt->bindValue(":email", "%{$email}%");

            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                       
                        echo $row->email . "<br>";
                        //echo $row->senha . "<br>"; Passamos o valor mas não listamos
                        }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar os dados do Login '{$email}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    #teste do find
    #find("ccerqueira@gmail.com");



    
    function update($login)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE login SET  senha = :senha WHERE email = :email"); 
                        
            $stmt->bindParam(":email", $login->email);
            $stmt->bindParam(":senha", $login->senha); 
            
            if ($stmt->execute())
                echo "Dados do Login atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar os dados do login. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #teste upgrade 
     /*$login = new stdClass();   
     $login->email = "ccerqueira@gmail.com";
     $login->senha = "rosada987";
     


     get();*/



    function delete($email)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM login WHERE email = ?");
            $stmt->bindParam("ccerqueira@gmail.com", $email); 

            if ($stmt->execute())
                echo "Dados do login deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar os dados do Login. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }


    #delete test
   /* echo "<br><br>---<br><br>";
    delete("ccerqueira@gmail.com"); 
    echo "<br><br>---<br><br>";
 
 
    get();*/




