<?php

function getIpAdress()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    return $_SERVER["REMOTE_ADDR"];
}

function generateRandomString($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function jsonDie($array)
{
    die(json_encode($array, JSON_PRETTY_PRINT));
}

function htmlDie($html)
{
    die($html);
}
