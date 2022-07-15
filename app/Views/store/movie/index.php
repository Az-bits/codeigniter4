<?php foreach ($movies as $key => $m) : ?>
    <div class="card mt-3">
        <?php if ($m->image != null) : ?>
            <img src="<?= route_to('get_image', $m->id, $m->image) ?>" class="d-block w-100" alt="...">
        <?php endif ?>
        <div class="card-header bg-danger"></div>
        <div class="card-body">
            <h3><?= $m->title ?></h3>
            <p><?= character_limiter($m->description, 150) ?></p>
            <a class="btn btn-danger btn-sm float-right" href="<?= route_to('store_movie_show', $m->id) ?>"><i class="fa fa-eye"></i> Ver</a>

        </div>
    </div>
<?php endforeach ?>
<?= $pager->links() ?>