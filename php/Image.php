<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/include.php";
header('Content-type: image/png');
$conn = new Connection("https://instagram.com/" . $_GET["igname"] . "/?__a=1");
$json = json_decode($conn->getBodyWithoutPage(), true);
echo file_get_contents($json["graphql"]["user"]["profile_pic_url_hd"]);