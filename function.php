<?php

function getUsersList(){
    $usersArr = require __DIR__ . '/users.php';
    return $usersArr;
};

function existsUser($login){
    $usersArr = getUsersList();
    for ($i=0; $i < 3; $i++) { 
        foreach($usersArr as $login){
            $login = $usersArr[$i]['login'];
            return $login;
    };
    };
};

function checkPassword($login, $password){
        for ($i=0; $i < 3 ; $i++) { 
            if(password_verify($password, getUsersList()[$i]['password']) === true || existsUser($login) === $login){
                return true;
            }
        }
        return false;
    }

function getCurrentUser(){
    if (isset($_SESSION['username'])){
        if (existsUser($_SESSION['username'])){
            return $_SESSION['username'];
        }
    }else{
        return null;
    }
};

?>