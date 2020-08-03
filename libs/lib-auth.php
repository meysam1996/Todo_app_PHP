<?php defined('BASE_PATH') OR die("Permision Denied!");



/*** Auth Functions ***/
function getCurrentUserId(){
    return getLoggedInUser()->id ?? 0;
}

function getLoggedInUser(){
    return $_SESSION['login'] ?? null;
}

function isLoggedIn(){
    return isset($_SESSION['login']) ? true : false;
}

function getUserByEmail($email){
    global $pdo;
    $sql = "select * from users where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email'=>$email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}

function logout(){
    unset($_SESSION['login']);
}

function login($email,$pass){
    $user = getUserByEmail($email);
    #Check Email
    if(is_null($user)){
        return false;
    }

    #Check the password
    if(password_verify($pass,$user->password)){
        #Login is successfull
        $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) );
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

function register($userData){
    global $pdo;
    # validation of $userData here (isValidEmail , isValidUserName , isValidPassword)
    $passHash = password_hash($userData['password'],PASSWORD_BCRYPT);
    $email = $userData['email'];
    $name = $userData['username'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(filter_var($email,FILTER_VALIDATE_EMAIL) and preg_match("/^([a-zA-Z' ]+)$/",$name)){
        $sql = "insert into users (name,email,password) values (:name,:email,:pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name'=>$name,':email'=>$email,':pass'=>$passHash]);
        return  true;
    }else{
        return false;
    }
    
}