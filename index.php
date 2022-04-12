<?php

require './vendor/autoload.php';

use App\Classes\Work;

$search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING);
// $active = filter_input("INPUT_GET", "active", FILTER_SANITIZE_STRING);

// $active = in_array(['s, n'], $active) ? $active : null;

$conditionSQL = [
    
    isset($search) && strlen($search) ?  ' name LIKE "%'. $search. '%"' : null  
];

$conditionSQL = array_filter($conditionSQL);
$where = implode( ' AND ' , $conditionSQL);

$works = Work::getListAll($where, null, null, '*');

require './views/includes/header.php';
require './views/includes/listAll.php';
require './views/includes/footer.php';

