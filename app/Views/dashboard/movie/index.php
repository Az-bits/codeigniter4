<a href="/movie/new" class="btn btn-success mb-4"><i class="fa fa-plus"></i> <?= lang('Form.create') ?></a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th><?= lang('form.name') ?></th>
            <th><?= lang('form.category') ?></th>
            <th><?= lang('form.options') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $key => $m) : ?>
            <tr>

                <td><?= $m->id ?></td>
                <td><?= $m->title ?></td>
                <td><?= $m->category ?></td>
                <td>
                    <a data-toggle="tooltip" data-placement="top" title="<?= lang('Form.see_detail') ?>" class="float-right ml-2 btn btn-primary btn-sm" href="/movie/<?= $m->id ?>"><i class="fa fa-user"></i></a>
                    <form action="/movie/delete/<?= $m->id ?>" method="POST">
                        <button data-toggle="tooltip" data-placement="top" title="<?= lang('Form.delete') ?>" class="float-right ml-2 btn btn-danger btn-sm" type="submit"><i class="fa fa-file"></i></button>
                    </form>
                    <a data-toggle="tooltip" data-placement="top" title="<?= lang('Form.edit') ?>" class="float-right ml-2 btn btn-primary btn-sm" href="/movie/<?= $m->id ?>/edit"><i class="fa fa-pencil-alt"></i></a>
                </td>

            </tr>
        <?php endforeach ?>


    </tbody>
</table>
<!-- links es para paginar (se puede acceder a ella con 'pager' => $movie->pager)-->
<?= $pager->links() ?>