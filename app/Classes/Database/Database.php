<?php

namespace App\Classes\Database;

use PDOException;
use Exception;
use PDO;

require_once './config.php';

class Database {

    private $table;
    private $connect;

    public function __construct($table) {

        $this->table = $table;
        $this->connection();
    }

    private function connection() {

        try {

            $this->connect = new PDO(
                 'mysql:host='.HOST.';
                 dbname='.DB_NAME.';
                 charset='.CHARSET.';',
                 DB_USER,
                 DB_PASSWORD,
                 array(PDO::ATTR_PERSISTENT, true)             
            );

            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        } catch(PDOException $e) {

            die('Erro ao se conectar: '. $e->getMessage());
            exit;
        }
    }

    private function desconnection() {

        $this->connect = null;
    }

    // private function execute(string $query, array $params = []) {

    //     try {

    //         if(isset($params)) {
            
    //             if(gettype($query) === 'string') {
    
    //                 $statement = $this->connect->prepare($query);
    //                 $statement->execute($params);
        
    //                 return $statement;
    //             }
    //         }

    //     } catch(PDOException $e) {

    //         throw new Exception("Erro ao inserir um novo registro: ". $e->getMessage());

    //     }
    // }

    // public function insert(array $values) {

    //     $fields = array_keys($values);
    //     $values = array_values($values);

    //     $binds = array_pad([], count($fields), '?');
    //     $binds = implode(", ", $binds);

    //     $fields = implode(", ", $fields);

    //     $query = 'INSERT INTO '.$this->table. '('.$fields.') VALUES('.$binds.')';

    //     if(!preg_match('/^INSERT/i', $query)) {

    //         throw new Exception("Este não é um método insert");
    //     }
        
    //     $this->execute($query, $values);

    //     return $this->connect->lastInsertId();

    // }

    private function execute($query, array $params = []) {

        // die(print_r($params));

        try {

            $pdo = $this->connect->prepare($query);
            $pdo->execute($params);
        
            return $pdo;

        } catch(PDOException $e) {

            throw new Exception("Erro ao inserir novo registro: ".$e->getMessage());
        }

    }

    public function insert(array $fields = []) {

        $values = array_keys($fields);
        $fields  = array_values($fields);
        $binds = array_pad([], count($values), "?");
        $binds = implode(",", $binds);
        $values = implode(", ", $values);

        $query = "INSERT INTO ".$this->table. "(".$values.") VALUES(".$binds.")";
        

        $this->execute($query, $fields);

        return $this->connect->lastInsertId();
    }

    public function select($where = null, $orderBy = null, $limit = null, string $fields = '*') {

        $where   = strlen($where) ? 'WHERE '.$where : '';
        $orderBy = strlen($orderBy) ? 'ORDER BY '.$orderBy : '';
        $limit   =  strlen($limit) ? 'LIMIT '.$limit : '';

        $query = "SELECT ".$fields. " FROM ".$this->table. " " .$where. " " .$orderBy. " " .$limit;
        
        $results = $this->execute($query);

        return $results;
    }

}