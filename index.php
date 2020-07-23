<?php
include "bootstrap/init.php";

if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
     deleteFolder($_GET['delete_folder']);
     removeTasks($_GET['delete_folder']);
}

if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
     removeTask($_GET['delete_task']);
}

$folders = getFolders();

$tasks = getTasks();
//dd($tasks);
include "tpl/tpl-index.php";