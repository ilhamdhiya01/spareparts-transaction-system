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
                <a href="" data-id="<?= $menu['id']; ?>" class="hapus-menu"><i class="fa fa-trash"></i></a>
            </td>
            <td width="10px">
                <a href="" data-id="<?= $menu['id']; ?>" class="update-menu"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
<script>
    $('.hapus-menu').click(function(e) {
        $(this).closest('#tr-user-menu').addClass('hapus-user-menu');
        let id = $(this).data("id");
        swal({
                title: 'Hapus data ini ?',
                text: 'Data yang terhapus tidak akan kembali !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
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
                } else {
                    swal('Membatalkan penghapusan data');
                }
            });
        e.preventDefault();
    });
</script>