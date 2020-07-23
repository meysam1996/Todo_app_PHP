<?php defined('BASE_PATH') OR die("Permision Denied!");

/*** Folder Functions ***/
function deleteFolder($folder_id){
    global $pdo;
    $sql = "delete from folders where id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolder($folder_name){
    global $pdo;
    $currentUserid = getCurrentUserId();
    $sql = "insert into folders (name,user_id) values (:folder_name,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name'=>$folder_name,':user_id'=>$currentUserid]);
    return $stmt->rowCount();
}

function getFolders(){
    global $pdo;
    $currentUserid = getCurrentUserId();
    $sql = "select * from folders where user_id = $currentUserid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $record;
}

/*** Tasks Functions ***/
function removeTask($task_id){
    global $pdo;
    $sql = "delete from tasks where id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addTask($taskTitle,$folderId){
    global $pdo;
    $currentUserid = getCurrentUserId();
    $sql = "insert into tasks (title,user_id,folder_id) values (:taskTitle,:user_id,:folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskTitle'=>$taskTitle,':user_id'=>$currentUserid,':folder_id'=>$folderId]);
    return $stmt->rowCount();
}

function getTasks(){
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if(isset($folder) && is_numeric($folder)){
        $folderCondition = "and folder_id = $folder";
    }
    $currentUserid = getCurrentUserId();
    $sql = "select * from tasks where user_id = $currentUserid $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $record;
}

/*** Delete Folder with the Task in that Folder ***/
function removeTasks($folder_id){
    global $pdo;
    $sql = "delete from tasks where folder_id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

/*** Done Switch CheckBox ***/
function doneSwitch($task_id){
    global $pdo;
    $currentUserid = getCurrentUserId();
    $sql = "update tasks set is_done = 1 - is_done where user_id = :userId  and id = :taskId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId'=>$currentUserid,':taskId'=>$task_id]);
    return $stmt->rowCount();
}