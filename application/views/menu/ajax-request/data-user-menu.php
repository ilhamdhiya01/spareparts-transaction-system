<thead>
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th colspan="2">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    foreach ($user_menu as $menu) :
    ?>
        <tr id="tr-user-menu">
            <th scope="row" id="no" width="10px"><?= $no++; ?></th>
            <td><?= $menu['nama_menu']; ?></td>
            <td width="10px">
                <a href="" data-id="<?= $menu['id']; ?>" class="hapus-menu" data-toggle="delete-menu" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
            </td>
            <td width="10px">
                <a href="" data-id="<?= $menu['id']; ?>" class="update-menu" data-toggle="update-menu" data-placement="top" title="Ubah"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
<script>
    $(function() {
        $('[data-toggle="delete-menu"]').tooltip()
        $('[data-toggle="update-menu"]').tooltip()
    });

    $('.hapus-menu').click(function(e) {
        $(this).closest('#tr-user-menu').addClass('hapus-user-menu');
        let id = $(this).data("id");
        Swal.fire({
            title: 'Hapus data ini ?',
            text: 'Data yang terhapus tidak akan kembali !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url(); ?>menu/delete_userMenu",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.response == 'success') {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $('.hapus-user-menu').fadeOut(1500);
                        } else {
                            iziToast.error({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                        }
                    }
                })
            }
        })
        e.preventDefault();
    });
</script>