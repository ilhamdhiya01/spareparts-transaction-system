<table id="table-sub-menu" class="table table-striped table-bordered view-data" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>User Menu</th>
            <th>Sub Menu</th>
            <th>Url</th>
            <th>Icon</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($sub_menu as $sub_menu) :
        ?>
            <tr id="tr-sub-menu">
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $sub_menu['nama_menu']; ?></td>
                <td><?= $sub_menu['sub_menu']; ?></td>
                <td><?= $sub_menu['url']; ?></td>
                <td><?= $sub_menu['icon']; ?></td>
                <td class="text-center">
                    <?php
                    switch ($sub_menu['is_active']) {
                        case 1:
                            echo '<span class="badge badge badge-success">Aktif</span>';
                            break;
                        case 0:
                            echo '<span class="badge badge badge-danger">Tidak Aktif</span>';
                            break;
                        default:
                            'tidak ada';
                    }
                    ?>
                </td>
                <td class="text-center">
                    <a href="" data-id="<?= $sub_menu['id']; ?>" class="badge badge-danger delete-sub-menu">Delete</a>
                    <a href="" data-id="<?= $sub_menu['id']; ?>" data-toggle="modal" data-target="#tambah-sub-menu" class="badge badge-info btn-ubah">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    //  get edit
    $('.btn-ubah').click(function(e) {
        $('#modal-sub-menu-title').html('Ubah Sub Menu');
        $('.tambah-sub-menu').css('display', 'none')
        $('.ubah-sub-menu').css('display', '');
        $('#sub_menu').removeClass('is-invalid');
        $('.sub-menu-error').html('');

        $('#url').removeClass('is-invalid');
        $('.url-menu-error').html('');

        $('#icon').removeClass('is-invalid');
        $('.icon-menu-error').html('');

        const id = $(this).data('id');
        $.ajax({
            url: '<?= base_url(); ?>menu/get_subMenuById',
            type: 'post',
            data: {
                id_sub: id
            },
            dataType: 'json',
            success: function(data) {
                if (data.response == 'success') {
                    $('#id-sub-menu').val(data.subMenu_byId.id);
                    $('#user-menu').val(data.subMenu_byId.menu_id);
                    $('#sub_menu').val(data.subMenu_byId.sub_menu);
                    $('#url').val(data.subMenu_byId.url);
                    $('#icon').val(data.subMenu_byId.icon);
                    $('#is_active').val(data.subMenu_byId.is_active);
                    $('#dropdown').val(data.subMenu_byId.dropdown);

                    if ($('#is_active').val() == 1) {
                        $("#is_active").attr("checked", "checked")
                        $("#status").html("Aktif");
                    } else {
                        $("#is_active").removeAttr("checked", "checked");
                        $("#status").html("Tidak Aktif");
                    }

                    if ($("#dropdown").val() == 1) {
                        $("#dropdown").attr("checked", "checked");
                        $("#dropdown-status").html("Ya");
                    } else {
                        $("#dropdown").removeAttr("checked", "checked");
                        $("#dropdown-status").html("Tidak");
                    }

                    $('.close').click(function() {
                        document.location.href = "<?= base_url(); ?>menu/dropdown_subMenu";
                    });
                }
            }
        });
        e.preventDefault()
    });

    // delete sub menu
    $('.delete-sub-menu').click(function(e) {
        $(this).closest('#tr-sub-menu').addClass('hapus-sub-menu');
        let id = $(this).data('id');
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
                        url: '<?= base_url(); ?>menu/delete_subMenu',
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
                                $('.hapus-sub-menu').fadeOut(1500);
                                // setTimeout(() => {
                                //     document.location.href = '<?= base_url(); ?>menu/dropdown_subMenu';
                                // }, 2000)
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