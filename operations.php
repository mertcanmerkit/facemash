<?php

include __DIR__ . "/vendor/autoload.php";
include __DIR__ . "/php/include.php";
$operation = $_POST["operation"];
switch ($operation) {
    case "login":
        $database = new DataBase();
        $user = new User($database->getDb());
        if ($user->checkLoginWithCredentials($_POST["email"], $_POST["pass"], 0)) {
            myDie(array(
                "login" => true,
                "token" => $user->getToken()
            ));
        } else {
            myDie(array("login" => false));
        }
        break;
    case "register":
        $database = new DataBase();
        $user = new User($database->getDb());
        $verify = $user->verifyCredentials($_POST, 0);
        if (!$verify["error"]) {
            myDie($database->addUser($_POST));
        } else {
            myDie($verify);
        }

        break;
    default:
        die(json_encode(array("error" => true)));
}


function myDie($array)
{
    die(json_encode($array, JSON_PRETTY_PRINT));
}