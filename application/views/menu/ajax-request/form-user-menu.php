<form action="" method="post" class="form-sub-menu" id="form-user-menu">
    <input type="hidden" class="form-control" value="" name="id-menu" id="id-menu">
    <div class="form-group">
        <label id="label-nama-menu">Nama Menu</label>
        <input type="text" class="form-control" value="" name="nama-menu" id="nama-menu">
        <div id="validationServer03Feedback" class="invalid-feedback nama-menu-error">
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-0   offset-md-12">
            <button type="submit" style="display:none;" class="btn btn-primary btn-sm btn-user-menu-ubah">Update</button>
            <button type="submit" class="btn btn-primary btn-sm  btn-user-menu-tambah">Tambah</button>
            <button type="submit" style="display:none;" class="btn btn-light btn-sm btn-refresh"><i class="fa fa-refresh"></i></button>
        </div>
    </div>
</form>
<script>
    // tambah user menu
    $(".btn-user-menu-tambah").click(function(e) {
        let data = $("#form-user-menu").serialize();
        $.ajax({
            url: "<?= base_url(); ?>menu/tambah_userMenu",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function() {
                $(".btn-user-menu-tambah").attr('disable', 'disabled');
                $(".btn-user-menu-tambah").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $(".btn-user-menu-tambah").removeAttr('disable');
                $(".btn-user-menu-tambah").html('Tambah');
            },
            success: function(data) {
                if (data.response !== 'success') {
                    $('#nama-menu').addClass('is-invalid');
                    $('.nama-menu-error').html(data.nama_menu);
                } else {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    readUserMenu();
                    $('#nama-menu').val('');
                    $('#nama-menu').removeClass('is-invalid');
                    $('.nama-menu-error').html('');
                }
            }
        })
        e.preventDefault();
    });

    // ubah user menu
    $('.update-menu').click(function(e) {
        $("#form-title-menu").html("<i class='fas fa-edit'></i> Ubah Menu");
        $(".btn-user-menu-ubah").css("display", "");
        $(".btn-refresh").css("display", "");
        $(".btn-user-menu-tambah").css("display", "none");
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url(); ?>menu/get_userMenuById",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                $('#id-menu').val(data.menu.id);
                $('#nama-menu').val(data.menu.nama_menu);
                // let id_menu = $('#id-menu').val();
                $('.btn-user-menu-ubah').click(function(event) {
                    let id_menu = $("#id-menu").val();
                    let nama_menu = $("#nama-menu").val();
                    $.ajax({
                        url: "<?= base_url(); ?>menu/proses_ubahUserMenu",
                        type: "post",
                        data: {
                            id_menu: id_menu,
                            nama_menu: nama_menu
                        },
                        beforeSend: function() {
                            $(".btn-user-menu-ubah").attr('disable', 'disabled');
                            $(".btn-user-menu-ubah").html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $(".btn-user-menu-ubah").removeAttr('disable');
                            $(".btn-user-menu-ubah").html('Update');
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.response == 'success') {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });
                                readUserMenu();
                                $('#nama-menu').val('');
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: data.message,
                                    position: 'topRight'
                                });
                            }
                        }
                    });
                    event.preventDefault();
                });
            }
        })
        e.preventDefault();
    });
</script>