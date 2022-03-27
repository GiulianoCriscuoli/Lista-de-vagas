<?php

require './vendor/autoload.php';

use App\Classes\Work;

$works = Work::getListAll(null, null, null, '*');


require './views/includes/header.php';
require './views/includes/listAll.php';
require './views/includes/footer.php';

