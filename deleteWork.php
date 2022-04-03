<?php

require __DIR__.'/vendor/autoload.php';

use App\Classes\Work;

if(isset($_GET['id'])) {

    $work = Work::show($_GET['id']);
    
    if(!$work instanceof Work) {

        header("Location: index.php?status=error");
        exit;
    }

    $work->delete($work->id);

}
 
