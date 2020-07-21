<?php

function getCurrentUrl(){
    return 1;
}

function isAjaxRequest(){
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        return true;
    }
    return false;
}

function diePage($msg){
    echo "<div style='padding: 30px;width: 80%;margin: 0 auto;background: #f9dede;border: 1px solid #cca4a4;color: #521717;border-radius: 5px;font-family: sans-serif;'>$msg</div>";
    die();
}