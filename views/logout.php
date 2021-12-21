<?php

session_start();
unset($_COOKIE['__token__']);
setcookie('__token__', '', time() - 3600, '/');
session_destroy();
header("Location: /login");
