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
    jsonDie(array("error" => "Exploit test detected!"));

}
if (contains(@$_GET["sef"], $ignoreArr)) {
    include __DIR__ . "/views/header.php";
    include __DIR__ . "/views/index.php";
    include __DIR__ . "/views/footer.php";
    die();
}
if (str_contains($_GET["sef"], "../")) {
    header("HTTP/1.0 400 Bad Request");
    jsonDie(array("error" => "Exploit test detected!"));
}
$file = __DIR__ . "/views/" . $_GET["sef"] . ".php";
if (file_exists($file)) {
    include __DIR__ . "/views/header.php";
    include $file;
    include __DIR__ . "/views/footer.php";
    die();
}
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
    case "add-photo":
        if (empty($explodedUrl[1] || !is_numeric($explodedUrl[1]))) {
            header("HTTP/1.0 301 Redirect");
            header("Location: /");
            die();
        }
        $_GET["id"] = $explodedUrl[1];
        include __DIR__ . "/views/header.php";
        include __DIR__ . "/views/add-photo-in.php";
        include __DIR__ . "/views/footer.php";
        break;
    case "profile":
        if (!isset($explodedUrl[1]) || empty($explodedUrl[1])) {
            include __DIR__ . "/views/header.php";
            include __DIR__ . "/views/profile-out.php";
            include __DIR__ . "/views/footer.php";
            die();
        }

        $voter = new Voter($database->db, $explodedUrl[1]);
        if (!$voter->checkVoterIsExist()) {
            include __DIR__ . "/views/header.php";
            include __DIR__ . "/views/notfound.php";
            include __DIR__ . "/views/footer.php";
            die();
        }
        include __DIR__ . "/views/header.php";
        include __DIR__ . "/views/profile-in.php";
        include __DIR__ . "/views/footer.php";

        break;
    default:
        header("HTTP/1.0 404 Not Found");
        jsonDie(array("error" => "File not exist!"));
        break;

}
