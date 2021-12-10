<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="views/css/style.css">

    <title>Hello, world!</title>

</head>

<body>

<div class="header" id="header">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <ul class="nav d-flex align-items-center justify-content-start">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login"><i
                                class="fas fa-user-circle"></i></a>
                    </li>
                    <li class="nav-item search">
                        <div></div>
                        <form class="d-flex align-items-center" action="#">
                            <div class="at-icon hidden mx-auto my-auto" id="at-icon" type="submit"><i
                                    class="fas fa-at"></i></div>
                            <div class="search-icon mx-auto my-auto" id="search-icon" type="submit"><i
                                    class="fas fa-search"></i></div>
                            <input class="search-input" id="search-input" type="search" placeholder="username"
                                   aria-label="Search">
                            <button class="search-btn hidden mx-auto my-auto" id="search-btn" type="submit"><i
                                    class="fas fa-search"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center">
                <a href="index" class="logo"><img src="views/img/logo.svg" alt="logo" height="30"></a>
            </div>
            <div class="col-4">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="add-category"><i
                                class="fas fa-plus-square category-add"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
