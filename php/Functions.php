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

function encryptOrDecrypt($string, $action = 'encrypt')
{
    if ($action == "encrypt") {
        $string = "_!" . $string;
    }
    $encrypt_method = "AES-256-CBC";
    $secret_key = HASH_KEY; // user define private key
    $secret_iv = "39" . HASH_KEY . "34"; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        $output = substr($output, 2);
    }
    return $output;
}

function contains($str, array $arr)
{
    foreach ($arr as $a) {
        if (stripos($str, $a) !== false) return true;
    }
    return false;
}