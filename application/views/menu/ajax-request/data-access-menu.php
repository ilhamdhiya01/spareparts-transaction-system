<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama User</th>
            <th scope="col">Posisi</th>
            <th scope="col">Level</th>
            <th scope="col">Status</th>
            <th scope="col" colspan="2">Aksi</th>
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
                    <a href="" data-id="<?= $am['id']; ?>" class="delete-access"><i class="fa fa-trash"></i></a>
                </td>
                <td>
                    <a href="" data-id="<?= $am['id']; ?>" data-level="<?= $am['level']; ?>" data-levelid="<?= $am['level_id']; ?>" class="get-access-by-id"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(".get-access-by-id").click(function(e) {
        // Ubah tampilan form
        console.log($(this).data("levelid"));
        $("#ubah-user").removeAttr("style");
        $("#form-title-menu").html("Ubah Data User");
        $("#tambah-user").css("display", "none");
        $("#password").attr("readonly", "readonly");
        $(".hide-password").css("display", "none");
        $("#konfirmasi_password").attr("readonly", "readonly");
        $(".hide-konfirmasi-password").css("display", "none");
        const id = $(this).data("id");
        const level = $(this).data("level");

        // Hilangkan tampilan error
        $("#nama").removeClass("is-invalid");
        $(".nama_error").html('');
        $("#posisi").removeClass("is-invalid");
        $(".posisi_error").html('');
        $("#level").removeClass("is-invalid");
        $(".level_error").html('');
        $("#username").removeClass("is-invalid");
        $(".username_error").html('');
        $("#password").removeClass("is-invalid");
        $(".password_error").html('');
        $("#konfirmasi_password").removeClass("is-invalid");
        $(".konfirmasi_password_error").html('');

        // tampilkan tab
        $("#tab-user-access").removeAttr("style");
        $("#level-title").html(level);

        // get ubah
        $.ajax({
            url: "<?= base_url(); ?>menu/get_access_menu_by_id",
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $("#id_access").val(data.data_by_id.id);
                $("#nama").val(data.data_by_id.nama_pegawai);
                $("#posisi").val(data.data_by_id.id_posisi);
                $("#gambar").val(data.data_by_id.gambar);
                $("#username").val(data.data_by_id.username);
                $("#password").val(data.data_by_id.password);
                $("#level").val(data.data_by_id.level_id);
                $("#is_active").val(data.data_by_id.is_active)
                $("#date_created").val(data.data_by_id.date_created)
                $("#konfirmasi_password").val(data.data_by_id.password);

                if ($("#is_active").val() == 1) {
                    $("#is_active").attr("checked", "checked");
                    $("#status").html("Aktif");
                }

                if ($("#is_active").val() == 0) {
                    $("#is_active").removeAttr("checked");
                    $("#status").html("Tidak Aktif");
                }

                // proses ubah
                $("#ubah-user").click(function(e) {
                    $.ajax({
                        url: "<?= base_url(); ?>menu/proses_ubah_access_menu",
                        type: "post",
                        dataType: "json",
                        data: {
                            id: $("#id_access").val(),
                            nama_pegawai: $("#nama").val(),
                            id_posisi: $("#posisi").change().val(),
                            gambar: $("#gambar").val(),
                            username: $("#username").val(),
                            password: $("#password").val(),
                            level_id: $("#level").change().val(),
                            is_active: $("#is_active").val(),
                            date_created: $("#date_created").val()
                        },
                        beforeSend: function() {
                            $("#ubah-user").attr('disable', 'disabled');
                            $("#ubah-user").html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $("#ubah-user").removeAttr('disable');
                            $("#ubah-user").html('Ubah');
                        },
                        success: function(data) {
                            if (data.response == 'success') {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });
                                readAccessMenu();
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: data.message,
                                    position: 'topRight'
                                });
                            }
                        }
                    });
                    e.preventDefault();
                });
            }
        });
        e.preventDefault();
    });

    $("#ubah-password").click(function(e) {
        $("#tab-user-access").css("display", "none");
        $.ajax({
            url: "<?= base_url(); ?>menu/load_form_change_password",
            type: "get",
            success: function(data) {
                $("#ubah_user").html(data)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
        e.preventDefault();
    });

    $(".delete-access").click(function(e) {
        $(this).closest('#tr-access-menu').addClass('hapus-access-menu');
        const id = $(this).data('id');
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
            }
        })
        e.preventDefault();
    });
</script>