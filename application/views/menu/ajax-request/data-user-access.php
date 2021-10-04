<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Access Menu</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($user_access as $access) :
        ?>
            <tr class="text-center">
                <th scope="row"><?= $no++; ?></th>
                <td><?= $access['nama_menu']; ?></td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?= change_access($level_user['id'], $access['id']); ?> data-levelid="<?= $level_user['id']; ?>" data-menu="<?= $access['id']; ?>">
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(".form-check-input").click(function() {
        const levelid = $(this).data("levelid");
        const menuid = $(this).data("menu");

        $.ajax({
            url: "<?= base_url(); ?>menu/change_access",
            type: "post",
            dataType: "json",
            data: {
                level_id: levelid,
                menu_id: menuid
            },
            success: function(data) {
                if (data.response == 'add') {
                    iziToast.success({
                        title: 'Success',
                        message: 'Access ditambahkan',
                        position: 'topRight'
                    });
                    console.log(data);
                } else {
                    iziToast.success({
                        title: 'Success',
                        message: 'Access dihapus',
                        position: 'topRight'
                    });
                    console.log(data);
                }
            }
        });
    });
</script>