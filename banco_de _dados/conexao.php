<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DATABASE", "dev_hstyle");

function getConnection()
{
    try {
        // https://www.php.net/manual/en/function.strval.php
        $key = 'strval'; # strval(HOST) são equivalentes $key(HOST)
        $con = new PDO("mysql:host={$key(HOST)};dbname={$key(DATABASE)}", USER, PASS) or die("Erro ao tentar conectar no banco de dados");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        return $con;
        
    } catch (PDOException $error) { # caso não consiga conectar irá entrar no bloco do catch
        echo "Erro ao conectar ao banco. Erro: {$error->getMessage()}";
        exit;
    }

}  

getConnection();