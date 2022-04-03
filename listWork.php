<?php

require __DIR__.'/vendor/autoload.php';

use App\Classes\Work;

$work =  null;

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

    $work = Work::show($_GET['id']);

} else {

    header("Location: index.php?status=error");
    exit;
}

require __DIR__.'/views/includes/header.php';
require __DIR__.'/views/includes/list.php';
require __DIR__.'/views/includes/footer.php';