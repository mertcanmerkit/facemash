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
    include __DIR__ . "/views/" . "header.php";
    switch ($_GET["sef"]) {
        case "main":
            include __DIR__ . "/views/" . "index" . ".php";
            break;
        default:
            include __DIR__ . "/views/" . $_GET["sef"] . ".php";
            break;
    }
    include __DIR__ . "/views/" . "footer.php";
}