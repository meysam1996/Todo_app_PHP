<?php
include_once "../bootstrap/init.php";

if(!isAjaxRequest()){
    diePage("Invalid Request!");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("Invalid Action!");
}

switch($_POST['action']){
    case 'addFolder' :
        if(!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3){
            echo "نام فایل باید از 2 حرف بیشتر باشد!";
            die();
        }
        echo addFolder($_POST['folderName']);
    break;
    case 'addTask' :
        $folderId = $_POST['folderId'];
        $taskTitle = $_POST['taskTitle'];
        if(!isset($folderId) || empty($folderId)){
            echo "Please select a Folder!";
            die();
        }
        if(!isset($taskTitle) || strlen($taskTitle) < 3){
            echo "Task name must be larger than 2 letters!";
        }
        echo addTask($taskTitle,$folderId);
    break;
    default :
    diePage("Invalid Action!!");
}
