<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/include.php";
$name = $_GET["name"];
$name = encryptOrDecrypt($name, "decrypt");
$db = new DataBase();
$image = new Image($name);
header('Content-type: image/png');
if (!$image->checkImageInDatabase($name)) {
    echo $image->getErrorImage();
    die();
}
echo $image->getImage();
