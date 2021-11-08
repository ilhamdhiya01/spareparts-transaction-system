<table id="table-sub-menu" class="table table-striped table-bordered table-hover view-data" style="width:100%">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>User Menu</th>
            <th>Sub Menu</th>
            <th>Url</th>
            <th>Icon</th>
            <th>Status</th>
            <th colspan="2">Aksi</th>
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
                <td class="text-center" width="10px">
                    <a href="" data-id="<?= $sub_menu['id']; ?>" class="delete-sub-menu" data-toggle="delete-sub" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                </td>
                <td class="text-center" width="10px">
                    <a href="" data-id="<?= $sub_menu['id']; ?>" data-toggle="modal" data-placement="top" title="Ubah" data-target="#tambah-sub-menu" class="btn-ubah"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(function() {
        $('[data-toggle="delete-sub"]').tooltip()
        $('[data-toggle="modal"]').tooltip()
    });
    //  get edit
    $('.btn-ubah').click(function(e) {
        $('#modal-sub-menu-title').html('<i class="far fa-edit"></i> Ubah Sub Menu');
        $('.tambah-sub-menu').css('display', 'none')
        $('.ubah-sub-menu').css('display', '');
        $('#sub_menu').removeClass('is-invalid');
        $('.sub-menu-error').html('');

        $('#url').removeClass('is-invalid');
        $('.url-menu-error').html('');

        $('#icon').removeClass('is-invalid');
        $('.icon-menu-error').html('');

        $("#myTab").css("display", "");

        $("#tab-dropdown").attr("style", "");

        const id = $(this).data('id');

        $.ajax({
            url: "<?= base_url(); ?>/menu/ambilDataDropdownMenu",
            type: "get",
            data: {
                id_sub: id,
            },
            success: function(data) {
                $(".view-dropdown-menu").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });

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
                    $('#menu').val(data.subMenu_byId.menu_id);
                    $('#sub_menu').val(data.subMenu_byId.sub_menu);
                    $('#url').val(data.subMenu_byId.url);
                    $('#icon').val(data.subMenu_byId.icon);
                    $('#is_active').val(data.subMenu_byId.is_active);
                    $('#dropdown').val(data.subMenu_byId.dropdown);
                    $('#sub_menu_id').html('<option value="' + data.subMenu_byId.id + '">' + data.subMenu_byId.sub_menu + '</option>');

                    if ($('#is_active').val() == 1) {
                        $("#is_active").attr("checked", "checked")
                        $("#status").html("Aktif");
                    } else {
                        $("#is_active").removeAttr("checked");
                        $("#status").html("Tidak Aktif");
                    }

                    if ($("#dropdown").val() == 1) {
                        $("#dropdown").attr("checked", "checked");
                        $("#dropdown-status").html("Ya");
                    } else {
                        $("#dropdown").removeAttr("checked");
                        $("#dropdown-status").html("Tidak");
                    }
                    // proses ubah
                    $('.ubah-sub-menu').click(function(e) {
                        $.ajax({
                            url: '<?= base_url(); ?>menu/ubah_sub_menu',
                            type: 'post',
                            data: {
                                id: $('#id-sub-menu').val(),
                                menu_id: $('#menu').change().val(),
                                sub_menu: $('#sub_menu').val(),
                                url: $('#url').val(),
                                icon: $('#icon').val(),
                                is_active: $('#is_active').val(),
                                dropdown: $('#dropdown').val()
                            },
                            dataType: 'json',
                            beforeSend: function() {
                                $(".ubah-sub-menu").attr('disable', 'disabled');
                                $(".ubah-sub-menu").html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $(".ubah-sub-menu").removeAttr('disable');
                                $(".ubah-sub-menu").html('Ubah');
                            },
                            success: function(value) {
                                if (value.response == 'success') {
                                    iziToast.success({
                                        title: 'Success',
                                        message: value.message,
                                        position: 'topRight'
                                    });
                                    readSubMenu();
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Data gagal diubah',
                                        position: 'topRight'
                                    });
                                }
                            }
                        });
                        e.preventDefault();
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
                        } else {
                            iziToast.warning({
                                title: 'Failed',
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