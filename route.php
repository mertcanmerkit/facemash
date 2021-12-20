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
$ignoreArr = array(".php");
if (!isset($_GET["sef"])) {
    header("HTTP/1.0 400 Bad Request");
    jsonDie(array("error" => "Expolit test detected!"));

}
if (contains(@$_GET["sef"], $ignoreArr)) {
    include __DIR__ . "/views/" . "header.php";
    include __DIR__ . "/views/" . "index" . ".php";
    include __DIR__ . "/views/" . "footer.php";
    die();
}
if (!str_contains($_GET["sef"], "../")) {
    $file = __DIR__ . "/views/" . $_GET["sef"] . ".php";
    if (file_exists($file)) {
        include __DIR__ . "/views/" . "header.php";
        include $file;
        include __DIR__ . "/views/" . "footer.php";
    } else {
        $explodedUrl = explode("/", $_GET["sef"]);
        switch ($explodedUrl[0]) {
            case "category":
                if (empty($explodedUrl[1]) || !is_numeric($explodedUrl[1])) {
                    header("HTTP/1.0 301 Redirect");
                    header("Location: /");
                    die();
                }
                $category = new Category($database->db);
                include __DIR__ . "/views/header.php";
                include __DIR__ . "/views/category-in.php";
                include __DIR__ . "/views/footer.php";


                break;
            default:
                header("HTTP/1.0 404 Not Found");
                jsonDie(array("error" => "File not exist!"));
                break;
        }
    }
} else {
    header("HTTP/1.0 400 Bad Request");

    jsonDie(array("error" => "Expolit test detected!"));
}