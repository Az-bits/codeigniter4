<div class="card">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <ol class="carousel-indicators">
                <?php foreach ($images as $index => $i) : ?>
                    <li data-slide-to="<?= $index ?>" data-target="#carouselExampleControls" data-slide-to="1"></li>
                <?php endforeach ?>
            </ol>
            <?php foreach ($images as $index => $i) : ?>
                <div class="carousel-item <?= $index !== 0 ?: "active" ?>">
                    <img src="<?= route_to('get_image', $i->movie_id, $i->image) ?>" class="d-block w-100" alt="...">
                </div>
            <?php endforeach ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['type'])) : ?>
            <a class="btn btn-danger btn-sm mb-3" href="<?= route_to('store_movie_buy', $movie->id) ?>"><i class="fab fa-paypal"></i> Comprar</a>
        <?php else : ?>
            <a class="btn btn-danger btn-sm mb-3" href="<?= route_to('user_login_get', $movie->id) ?>"><i class="fa fa-user"></i> Debe iniciar sesión para comprar</a>
        <?php endif ?>
        <p class="card-text"><?= $movie->description ?></p>

    </div>

</div>