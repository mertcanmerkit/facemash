
<?php
if ($isLogged){
    echo "isloged";
    echo $user->user["username"];
}

?>

<div class="fixed-bottom mb-3">
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <button type="button"
                        class="btn btn-outline-primary random-btn fw-bold d-flex justify-content-around align-items-center float-end"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" id="random-btn">
                    <i class="fas fa-dice" style="font-size: 24px;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header header-mash">
                <h5 class="modal-title blue-text" id="exampleModalToggleLabel">Card title 🚀</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mash-bg d-flex justify-content-center align-content-center  align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <a href="" class="card-a">
                                <img src="views/img/pp/pp%20(2).jpg" class="card__image" alt=""/>
                                <div class="card__overlay">
                                    <div class="card__header">
                                        <img class="card__thumb" src="views/img/pp/pp%20(2).jpg" alt=""/>
                                        <div class="card__header-text">
                                            <h3 class="card__title">Jessica Parker</h3>
                                            <span class="card__status">1 hour ago</span>
                                        </div>
                                    </div>
                                    <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing
                                        elit. Asperiores, blanditiis?</p>
                                </div>
                            </a>

                        </div>
                        <div class="col-md-6 mb-3">

                            <a href="" class="card-a">
                                <div class="card__overlay">
                                    <div class="card__header">
                                        <img class="card__thumb" src="views/img/pp/pp%20(1).jpg" alt=""/>
                                        <div class="card__header-text">
                                            <h3 class="card__title">Jessica Parker</h3>
                                            <span class="card__status">1 hour ago</span>
                                        </div>
                                    </div>
                                    <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing
                                        elit. Asperiores, blanditiis?</p>
                                </div>
                                <img src="views/img/pp/pp%20(1).jpg" class="card__image" alt=""/>

                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End-->

<div class="container">
    <div class="row mt-3">
        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-blue img-cards">
                <h5 class="blue-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Card title 🚀
                    <a href="add-photo.php">
                        <i class="far fa-plus-square float-end"></i>
                    </a>
                </h5>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(1).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(2).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(3).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(4).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(5).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(6).jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(7).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(8).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/pp/pp%20(9).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(10).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(11).jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/pp/pp%20(12).jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary start-btn blue-border blue-text fw-bold"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">START
                </button>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-yellow img-cards">
                <h5 class="yellow-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Card title 🚀<i
                            class="far fa-plus-square float-end"></i></h5>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn yellow-btn yellow-border yellow-text fw-bold">START
                </button>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-green img-cards">
                <h5 class="green-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Card title 🚀<i
                            class="far fa-plus-square float-end"></i></h5>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn green-border green-text fw-bold">START
                </button>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-red img-cards">
                <h5 class="red-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Card title 🚀<i
                            class="far fa-plus-square float-end"></i></h5>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn red-border red-text fw-bold">START
                </button>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3">
            <div class="card card-shadow-pink img-cards">
                <h5 class="pink-text text-break" style="padding: 1rem 1rem 0rem 1rem;">Card title 🚀<i
                            class="far fa-plus-square float-end"></i></h5>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="views/img/150x150.jpg" class="card-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"
                        class="btn btn-outline-primary start-btn pink-border pink-text fw-bold">START
                </button>
            </div>
        </div>
    </div>

