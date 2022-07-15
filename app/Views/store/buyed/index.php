<table class="table table-dark">
    <tr>
        <th>ID</th>
        <th>Comprado</th>
        <th>Película</th>

    </tr>
    <?php foreach ($payments as $key => $p) : ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->created_at ?></td>
            <td><?= $p->movie ?></td>
        </tr>


    <?php endforeach ?>
</table>