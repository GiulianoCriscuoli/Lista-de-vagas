<?php

    require __DIR__.'/vendor/autoload.php';

    use App\Classes\Work;

    $work =  null;

    if(isset($_GET['id'])) {

        $work = Work::show($_GET['id']);

        if($work instanceof Work) {

            $work->upadateHoWork($work->id);
        }
    }

    header("Location: index.php?status=error");
    exit;
?>