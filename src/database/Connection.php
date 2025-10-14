<?php

namespace  Database;

use PDO;
use Core\Config;
use PDOException;

final class Connection{
    public ?PDO $pdo = null;

    public function __construct(){
       
        //if there is already a databse connection exit the class
        if($this->pdo !== null){
            return;
        }

        $this->connect();
      
    }

    private function connect(): void{
        try{ 
            $host = Config::get("database.host");
            $port = Config::get("database.port");
            $username = Config::get("database.username");
            $password = Config::get("database.password");
            $db_name = Config::get("database.name");

            $dsn = "mysql:host={$host};dbname={$db_name}";
           
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Database connection failed.". $e->getMessage());
        }
    }
}