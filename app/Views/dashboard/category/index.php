<a href="/category/new" class="btn btn-success mb-4"><i class="fa fa-plus"></i><?= lang('Form.create') ?></a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th><?= lang('Form.title') ?></th>
            <th><?= lang('Form.options') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $key => $c) : ?>
            <tr>

                <td><?= $c->id ?></td>
                <td><?= $c->title ?></td>
                <td>
                    <form action="/category/delete/<?= $c->id ?>" method="POST">
                        <button data-toggle="tooltip" data-placement="top" title="<?= lang('Form.delete') ?>" class="float-right ml-2 btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                    <a data-toggle="tooltip" data-placement="top" title="<?= lang('Form.edit') ?>" class="float-right ml-2 btn btn-primary btn-sm" href="/category/<?= $c->id ?>/edit"><i class="fa fa-pencil-alt"></i></a>
                </td>

            </tr>
        <?php endforeach ?>


    </tbody>
</table>
<!-- links es para paginar (se puede acceder a ella con 'pager' => $covie->pager)-->
<?= $pager->links() ?>