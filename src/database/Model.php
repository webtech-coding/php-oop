<?php

namespace Database;

use PDO;
use PDOException;
use PDOStatement;
use Exception;

class Model {
    protected static string $table ="";
    protected static array $fillable = [];

    protected ?PDO $pdo =  null;
    public function __construct() {
        global $database;
        self::$pdo = $database->pdo;
    }

    public static function query(string $query, ?array $params = []): PDOStatement {
        global $database;
        $pdo = $database->pdo;
        try {
            $prepare = $pdo->prepare($query);
            $prepare->execute($params);
            return $prepare;
        } catch (PDOException $e) {
            throw new Exception("Query failed". $e->getMessage());
        }
    }

    public static function all(): array{
       $table = static::$table;
       $sql = "SELECT * FROM $table";
       return self::query($sql, [])->fetchAll(PDO::FETCH_OBJ);
    }

    public static function fetchOne(array $params = []):object | null{
        $table = static::$table;
        $query_string = "";

        $index = 0;
        foreach ($params as $key => $value) {
            $query_string .= ($index !==0 ? " AND ":'').$key."=:".$key;
            $index++;
        }
                      
        $sql = "SELECT * FROM $table WHERE {$query_string}";
        
        
         $data = self::query($sql, $params)->fetch(PDO::FETCH_OBJ);
         
         if($data){
            return $data;
         }else{
            return null;
         }
    }
    public static function findById(int | string $id):object | null{
        $table = static::$table;
        $sql = "SELECT * FROM $table WHERE id=:id";
        $resource = self::query($sql, ['id'=>$id])->fetch(PDO::FETCH_OBJ);
        if($resource){
            return $resource;
        }else{
            return null;
        }
        
    }
    /**
     * Summary of create
     * @param array $data
     * @throws \Exception
     * @return object|null
     */
    public static function create(array $data): object | null{
        $table = static::$table;

        $unknownFields = [];
        foreach($data as $key => $value) {
            if(!in_array($key, static::$fillable)){
                array_push($unknownFields, $key);
            }
        }
        if(count($unknownFields)){
            throw new Exception('Somes fileds are not fillable',1);
        }

        $columns = [];
        $values = [];
        foreach($data as $column => $value) {
            array_push($columns, $column);
            array_push($values, $value);
        }
        $setColumns = implode(',', $columns);
        $dynamicColumns = ':'.implode(', :', $columns);        
      
        $sql="INSERT INTO $table ($setColumns) VALUES($dynamicColumns)";
        $prepare = self::query($sql, $data);

        if($prepare->rowCount()> 0){
            $lastId = static::lastInsertedId();
            return (object)[...$data, 'id'=>$lastId];
        }
        return null;
    }

    protected static function getFields(){
        return implode(",", static::$fillable);
    } 

    protected static function lastInsertedId():int|string{
        global $database;
        $pdo = $database->pdo;
        return $pdo->lastInsertId();
    }

    public static function search(array $columns, string $searchQuery):array{
       if(!$columns || !$searchQuery)return [];

       $table= static::$table;
       $queryString = "";
       $queryParams = [];
       for($i= 0; $i<count($columns); $i++){
        array_push($queryParams, '%'.$searchQuery.'%');
        $queryString .= ($i !==0 ? ' OR ' : ''). $columns[$i]." LIKE ?";        
       };

       $sql ="SELECT *FROM $table WHERE $queryString";
       return self::query($sql, $queryParams)->fetchAll(PDO::FETCH_OBJ);

    }

}