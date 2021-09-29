<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Sub Menu</th>
            <th scope="col">Nama</th>
            <th scope="col">Url</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($dropdown_menu as $dropdown) :
        ?>
            <tr id="tr-dropdown-menu">
                <th scope="row"><?= $no++; ?></th>
                <td><?= $dropdown['sub_menu']; ?></td>
                <td><?= $dropdown['dropdown_nama']; ?></td>
                <td><?= $dropdown['url']; ?></td>
                <td>
                    <a href="" data-id="<?= $dropdown['id']; ?>" class="badge badge-danger delete-dropdown-menu">Delete</a>
                    <a href="" data-id="<?= $dropdown['id']; ?>" class="badge badge-info btn-ubah-dropdown">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(".delete-dropdown-menu").click(function(e) {
        $(this).closest("#tr-dropdown-menu").addClass('hapus-dropdown-menu');
        const id = $(this).data("id");
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
                        url: "<?= base_url(); ?>menu/hapus_dropdown_menu",
                        type: "post",
                        dataType : "json",
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
                                $(".hapus-dropdown-menu").fadeOut(1500);
                            } else {

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