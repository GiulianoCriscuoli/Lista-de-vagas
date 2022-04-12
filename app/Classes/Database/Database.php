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

    private function execute($query, array $params = []) {

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

    public function update($id, array $values) {

        try {

            if($id) {

                $fields = array_keys($values);
                $setters = [];
    
                foreach($fields as $field) {
    
                    $setters[] .= $field.'=?';
                }
    
                $setters = implode(", ", $setters);
    
                $query = "UPDATE ". $this->table. " SET ".$setters. " WHERE ".$id;
    
                $this->execute($query, array_values($values));

                header("Location: index?status=success");
                exit;
    
                return true;
    
            }

        } catch(PDOException $e) {

            die("Erro ao atualizar o registro". $e->getMessage());
            exit;
        }
    }


    public function delete($id) {

        try {

            if($id) {

                $query = "DELETE FROM " .$this->table. " WHERE ".$id;

                $this->execute($query);

                return true;

            }

        } catch (PDOException $e) {
            
            throw new exception("Erro ao deletar registro. ".$e->getMessage());
        }
    }

    public function updateCustomFields($id, array $values) {

        $fields = array_values($values);
        $binds = array_keys($values);
        foreach($binds as $bind) {

            $setters[] = $bind. '=?';

        }

        $setters = implode(',', $setters);
        
        $query = 'UPDATE '.$this->table. ' SET '.$setters. ' WHERE '.$id;

        $this->execute($query, $fields);

        return true;
    }

}