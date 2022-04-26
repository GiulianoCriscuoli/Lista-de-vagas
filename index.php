<?php

require './vendor/autoload.php';

use App\Classes\Work;

$search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING);
$activeFilter = filter_input(INPUT_GET, "active", FILTER_SANITIZE_STRING);

$activeFilter = in_array($activeFilter, ['s', 'n']) ? $activeFilter : null;

$conditionSQL = [
    
    isset($search) && strlen($search) ? ' name LIKE "%'. str_replace(' ', '%', $search). '%"' : null,
    isset($activeFilter) && strlen($activeFilter) ? ' active="'. $activeFilter.'"' : null
];

$conditionSQL = array_filter($conditionSQL);
$where = implode( ' AND ' , $conditionSQL);

$works = Work::getListAll($where, null, null, '*');

require './views/includes/header.php';
require './views/includes/listAll.php';
require './views/includes/footer.php';

