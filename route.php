<?php
include __DIR__ . "/vendor/autoload.php";
include __DIR__ . "/php/include.php";
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


if (file_exists(__DIR__ . "/views/" . $_GET["sef"] . ".php") and !str_contains($_GET["sef"], "../")) {
    include __DIR__ . "/views/" . "header.php";
    include __DIR__ . "/views/" . $_GET["sef"] . ".php";
    include __DIR__ . "/views/" . "footer.php";
}