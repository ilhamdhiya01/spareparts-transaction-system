<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Menu</th>
            <th scope="col">Access</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($user_access as $menu) :
        ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $menu['nama_menu'] ?></td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="" value="<?= $menu['id']; ?>" class="custom-control-input" id="access<?= $menu['id']; ?>">
                        <label class="custom-control-label" for="access<?= $menu['id']; ?>"></label>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>