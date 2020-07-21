<?php

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
function removeTasks(){
    return 1;
}

function addTasks(){
    return 1;
}

function getTasks(){
    return 1;
}