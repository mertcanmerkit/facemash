<?php
include __DIR__ . "/vendor/autoload.php";

include __DIR__ . "/php/include.php";
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$database = new DataBase();
$isLogged = false;
$user = new User($database->getDb());
if (isset($_COOKIE[COOKIE_NAME])) {
    $isLogged = $user->checkLoginWithToken($_COOKIE[COOKIE_NAME]);
}


if (!str_contains($_GET["sef"], "../")) {
    $file = __DIR__ . "/views/" . $_GET["sef"] . ".php";
    if (file_exists($file)) {
        include __DIR__ . "/views/" . "header.php";
        include $file;
        include __DIR__ . "/views/" . "footer.php";
    }else{
        header("HTTP/1.0 404 Not Found");
        jsonDie(array("error"=>"File not exist!"));
    }
}else{
    header("HTTP/1.0 400 Bad Request");

    jsonDie(array("error"=>"Expolit test detected!"));
}