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
        if (!$verify["error"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && preg_match('/^[a-zA-Z0-9._].{1,30}+$/', $_POST["username"]) && preg_match('/^.{5,31}$/', $_POST["pass"])) {
            myDie($database->addUser($_POST));
        }
        myDie($verify);
        break;
    case "reset":
        $database = new DataBase();
        $user = new User($database->getDb());
        $verify = $user->verifyCredentials($_POST, 1);
        if ($verify["error"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            myDie($database->addPassKey($_POST));
            // Sıfırlama maili gönder.
            // myDie(array("reset" => true, "reason" => "Mail sended"));

        }
        myDie(array("reset" => false, "reason" => "Mail undefined"));
        break;
    case "changePass":
        $database = new DataBase();
        $user = new User($database->getDb());
        if(preg_match('/^.{5,31}$/', $_POST["pass"])){
            myDie($database->updatePass($_POST));
        }
        myDie(array("changePass" => false, "reason" => "password problem"));
        break;
    case "addCategory":
        $database = new DataBase();
        $user = new User($database->getDb());
        $category = new Category($database->getDb(),$user);
        if ($user->checkLoginWithToken()) {
            $category->addCategory($_POST["categoryName"], $_POST["firstUsername"]);
        } else {
            myDie(array("error" => true, "reason" => "Please Login."));
        }

        break;
    default:
        die(json_encode(array("error" => true, "reason" => "unexpected operation")));
}

function myDie($array)
{
    die(json_encode($array, JSON_PRETTY_PRINT));
}
