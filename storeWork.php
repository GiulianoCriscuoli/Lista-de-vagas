<?php

require __DIR__.'/vendor/autoload.php';

use App\Classes\Work;

$work = new Work;

$work->store();

require __DIR__.'/views/includes/header.php';
require __DIR__.'/views/pages/formWork.php';
require __DIR__.'/views/includes/footer.php';
