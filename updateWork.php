<?php

require __DIR__.'/vendor/autoload.php';

use App\Classes\Work;

$work = null;

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

    $work = Work::show($_GET['id']);

    if(!$work instanceof Work) {
            
        header("Location: index.php");
        exit;

    }

    $work->update($work->id);
}

require __DIR__.'/views/includes/header.php';
require __DIR__.'/views/pages/formWork.php';
require __DIR__.'/views/includes/footer.php';