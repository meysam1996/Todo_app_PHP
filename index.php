<?php
include "bootstrap/init.php";

if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deletedCount = deleteFolder($_GET['delete_folder']);
}

if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deletedCount = removeTasks($_GET['delete_task']);
}

$folders = getFolders();

$tasks = getTasks();
//dd($tasks);
include "tpl/tpl-index.php";