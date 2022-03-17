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
        $stmt->bindValue(":senha", md5($login->senha));
        

        if ($stmt->execute()) 
            return true;
        
    } catch (PDOException $error) {
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

//create test - 
/*$login= new stdClass();

$login->email =  "ccerqueira@gmail.com";
$login->senha = "parada98";

create($login);

echo "<br><br>$login->email<br><br>";
echo "<br><br>$login->senha<br><br>";

*/

function getLogin($login)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT email FROM login WHERE email = :email senha = :senha");

        $stmt->bindParam(":email", $login->email);
        $stmt->bindValue(":senha", md5($login->senha));

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
        
    #get test
    /*getLogin($login);

    echo "<br><br>$login->email<br><br>";
    echo "<br><br>$login->senha<br><br>";
    
*/

    function find($email)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT email, senha FROM login WHERE email LIKE :email");
            
            $stmt->bindValue(":email", "%{$email}%");
            
            
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                       
                        echo $row->email . "<br>";
                        echo $row->senha . "<br>"; 
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
    //find ('ccerqueira@gmail.com');

  

     
    function update($login)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE login SET  senha = :senha, email = :email WHERE id = :id"); 

            $stmt->bindParam(":id", $login->id);           
            $stmt->bindParam(":email", $login->email);
            $stmt->bindValue(":senha", md5($login->senha)); 
            
            if ($stmt->execute())
                echo "Dados do Login atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar os dados do login. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

 
    #teste upgdate 
    /* $login = new stdClass();  
     $login->id = 4; 
     $login->email = "ccerqueira@gmail.com";
     $login->senha = "rosad@98";
     
     update($login);

   //getLogin($login);

    echo "<br><br>$login->email<br><br>";
    echo "<br><br>$login->senha<br><br>";

*/
    
    function delete($id)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM login WHERE id = ?");
            $stmt->bindParam(1, $id); 

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
    echo "<br><br>---<br><br>";
    delete(3); 
    echo "<br><br>---<br><br>";
 
 
    //get();*/

