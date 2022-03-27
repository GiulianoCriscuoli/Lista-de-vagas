<?php

namespace App\Classes;

use App\Classes\Database\Database;
use PDO;

class Work {

    public function store() {

        if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['active'])) {

            $_POST['date'] = date('Y-m-d H:i:s');

            $database = new Database('works');
            $result =  $database->insert([

                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'active' => $_POST['active'],
                'date' => $_POST['date']

            ]);

            die(print_r($result));

            header("Location:index?status=success");
            exit;

        }  
    }

    public static function getListAll($where = null, $orderBy, $limit = null, $fields = '*') {
        
        return (new Database('works'))
        ->select($where, $orderBy, $limit, $fields)
        ->fetchAll(PDO::FETCH_CLASS,  self::class);
    }
}