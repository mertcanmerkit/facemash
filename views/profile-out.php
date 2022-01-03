<?php
if(!isset($_COOKIE[COOKIE_NAME])){
    header("Location: /login");
    die();
}
$user = new User($database->db);
$username = $user->getUser()["username"];
$id = $user->getUser()["id"];
$color = generateRandomColor();



?>



<!-- Modal -->
<?php
include "modal.php";
?>
<!-- Modal End-->



<div class="container">
    <div class="mt-3">
        <p><a href="logout" class="text-danger float-end ">Logout</a></p>
        <h5 class="<?=$color?>-text text-break d-inline"><?=$username?>'s</h5>
        <h5 class="<?=$color?>-text text-break d-inline">categories</h5>
    </div>

    <div class="row mt-3 user-categories">
        <p class="yellow-text category-empty text-center"></p>
    </div>

</div>