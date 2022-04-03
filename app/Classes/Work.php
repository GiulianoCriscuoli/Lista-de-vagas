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

            header("Location:index?status=success");
            exit;

        }  
    }

    public static function getListAll($where = null, $orderBy, $limit = null, $fields = '*') {
        
        return (new Database('works'))
                    ->select($where, $orderBy, $limit, $fields)
                    ->fetchAll(PDO::FETCH_CLASS,  self::class);
    }

    public static function show($id) {

        return (new Database('works'))
                    ->select('id='.$id, null, null, '*')
                    ->fetchObject(self::class);
    }

    public function update($id) {

        if($id) {

            if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['active'])) {

                $_POST['date'] = date('Y-m-d H:i:s');
                
                $database = new Database('works');
    
                $database->update('id='. $id, [
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'active' => $_POST['active'],
                        'date' => $_POST['date']
                ]);
    
                header("Location:index?status=success");
                exit;
            }
        }
    }

    public function delete($id) {

        $database = new Database('works');

        $return  = $database->delete('id='.$id);

        if($return) {

            header("Location:index?status=success");
            exit;

        } else {

            header("Location:index?status=error");
            exit;
        }
    }
}