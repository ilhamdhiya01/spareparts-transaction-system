<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama User</th>
            <th scope="col">Posisi</th>
            <th scope="col">Level</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($access_menu as $am) :
        ?>
            <tr class="text-center" id="tr-access-menu">
                <th><?= $no++; ?></th>
                <td><?= $am['nama_pegawai']; ?></td>
                <td><?= $am['nama_posisi']; ?></td>
                <td><?= $am['level']; ?></td>
                <td>
                    <?php if ($am['is_active'] > 0) : ?>
                        <small class="badge badge-success">Aktif</small>
                    <?php else : ?>
                        <small class="badge badge-danger"> Tidak Aktif</small>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="" data-id="<?= $am['id']; ?>" class="badge badge-danger delete-access">Delete</a>
                    <a href="" data-id="<?= $am['id']; ?>" class="badge badge-info">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(".delete-access").click(function(e) {
        $(this).closest('#tr-access-menu').addClass('hapus-access-menu');
        const id = $(this).data('id');
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
                        url: '<?= base_url(); ?>menu/delete_access_menu',
                        method: 'post',
                        dataType: 'json',
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
                                $('.hapus-access-menu').fadeOut(1500);
                            } else {
                                iziToast.warning({
                                    title: 'Failed',
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