<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="tab-ubah-sub-menu" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ubah Sub Menu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-tambah-dropdown" data-toggle="tab" href="#tab-dropdown" role="tab" aria-controls="profile" aria-selected="false">Tambah Dropdown</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="sub-menu">
        <form action="" method="post" class="form-sub-menu">
            <input type="hidden" name="id" value="" id="id-sub-menu">
            <div class="form-group" id="options">
                <label class="control-label ">Menu<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="menu" id="menu">
                    <option value="" class="text-center">-- Pilih --</option>
                    <?php foreach ($user_menu as $menu) : ?>
                        <option value="<?= $menu['id']; ?>" id="value"><?= $menu['nama_menu']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="validationServer03Feedback" class="invalid-feedback menu_error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Nama Sub Menu<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="sub_menu" id="sub_menu">
                <div id="validationServer03Feedback" class="invalid-feedback sub-menu-error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Url<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="url" id="url">
                <div id="validationServer03Feedback" class="invalid-feedback url-menu-error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Icon<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="icon" id="icon">
                <div id="validationServer03Feedback" class="invalid-feedback icon-menu-error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Aktivasi Menu</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input aktivasi-menu" value="0" name="is_active" id="is_active">
                    <label class="custom-control-label" for="is_active" id="status">Tidak Aktif</label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Dropdown Menu</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input dropdown-menu" value="0" name="dropdown" id="dropdown">
                    <label class="custom-control-label" for="dropdown" id="dropdown-status">Tidak</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm tambah-sub-menu" id="btn-form">Tambah</button>
                <button type="submit" class="btn btn-primary btn-sm ubah-sub-menu" id="btn-form">Ubah</button>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" style="display:none;" id="tab-dropdown" role="tabpanel" aria-labelledby="profile-tab">
        <button type="button" class="btn btn-sm btn-primary" id="tambahDropdown" style="display:none;">Tambah Dropdown</button>
        <form action="" method="post" class="form-dropdown-menu">
            <input type="hidden" name="id_dropdown" id="id_dropdown" value="">
            <div class="form-group" id="options">
                <label class="control-label ">Menu<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="sub_menu_id" id="sub_menu_id" disabled>
                </select>
                <div id="validationServer03Feedback" class="invalid-feedback menu_error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Dropdown Menu<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" required name="nama_dropdown" id="nama_dropdown">
                <div id="validationServer03Feedback" class="invalid-feedback nama_dropdown_error">
                </div>
            </div>
            <div class="form-group">
                <label for="">Url Dropdown<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="url_dropdown" id="url_dropdown">
                <div id="validationServer03Feedback" class="invalid-feedback url_dropdown_error">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" style="display:none;" class="btn btn-primary btn-sm ubah-dropdown">Ubah</button>
                <button type="submit" class="btn btn-primary btn-sm tambah-dropdown">Tambah</button>
            </div>
        </form>
        <div class="table-responsive view-dropdown-menu">

        </div>
    </div>
</div>
<script>
    $("#tambahDropdown").click(function(e) {
        $(this).css("display", "none");
        $(".ubah-dropdown").css("display", "none");
        $(".tambah-dropdown").css("display", "");
        $("#id_dropdown").val("");
        $("#nama_dropdown").val("");
        $("#url_dropdown").val("");
        e.preventDefault();
    });

    // tambah dropdown menu
    $(".tambah-dropdown").click(function(e) {
        const sub_menu_id = $("#sub_menu_id").val();
        const dropdown_menu = $("#nama_dropdown").val();
        const url_dropdown = $("#url_dropdown").val();
        const id = $("#id-sub-menu").val();

        $.ajax({
            url: "<?= base_url(); ?>menu/cek_dropdown_aktif_atau_tidak",
            type: "post",
            dataType: "json",
            data: {
                id: $("#id-sub-menu").val()
            },
            success: function(data) {
                if (data.response == 'success') {
                    if (data.aktivasi_dropdown.dropdown == 0) {
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            position: 'topRight'
                        });
                    } else {
                        $.ajax({
                            url: "<?= base_url(); ?>menu/tambah_dropdown_menu",
                            type: "post",
                            dataType: "json",
                            data: {
                                sub_menu_id: sub_menu_id,
                                dropdown_menu: dropdown_menu,
                                url_dropdown: url_dropdown
                            },
                            success: function(data) {
                                if (data.response !== 'success') {
                                    if ($("#nama_dropdown").val() == "") {
                                        $("#nama_dropdown").addClass("is-invalid");
                                        $(".nama_dropdown_error").html("Nama dropdown tidak boleh kososng");
                                    } else {
                                        $("#nama_dropdown").removeClass("is-invalid");
                                        $(".nama_dropdown_error").html('');
                                    }

                                    if ($("#url_dropdown").val() == "") {
                                        $("#url_dropdown").addClass("is-invalid");
                                        $(".url_dropdown_error").html(data.url_dropdown);
                                    } else {

                                        $("#url_dropdown").removeClass("is-invalid");
                                        $(".url_dropdown_error").html('');
                                    }

                                } else {
                                    iziToast.success({
                                        title: 'Success',
                                        message: 'Data berhasil ditambahkan',
                                        position: 'topRight'
                                    });

                                    $.ajax({
                                        url: "http://localhost/spareparts-transaction-system/menu/ambilDataDropdownMenu",
                                        type: "get",
                                        data: {
                                            id_sub: id,
                                        },
                                        success: function(data) {
                                            $(".view-dropdown-menu").html(data);
                                            console.log(data);
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                        },
                                    });

                                    $("#nama_dropdown").removeClass("is-invalid");
                                    $("#nama_dropdown").val("");
                                    $(".nama_dropdown_error").html('');

                                    $("#url_dropdown").removeClass("is-invalid");
                                    $("#url_dropdown").val("");
                                    $(".url_dropdown_error").html('');
                                }
                            }
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });

    $('#modal-tambah-sub-menu').click(function() {
        $('.ubah-sub-menu').css('display', 'none');
        $('.tambah-sub-menu').css('display', '');
        $('#modal-sub-menu-title').html('Tambah Sub Menu');
        $("#myTab").css("display", "none");
        $('#sub_menu').val('');
        $('#url').val('');
        $('#icon').val('');
        $("#tab-dropdown").css("display", "none");

        if ($('.aktivasi-menu').val() == 1) {
            $(this).removeAttr("checked");
            $(this).val(0)
        }

        if ($('#is_active').val() == 1) {
            $(this).removeAttr("checked");
            $(this).val(0)
        }

        $('#sub_menu').removeClass('is-invalid');
        $('.sub-menu-error').html('');

        $('#url').removeClass('is-invalid');
        $('.url-menu-error').html('');

        $('#icon').removeClass('is-invalid');
        $('.icon-menu-error').html('');
    });

    $("#tab-tambah-dropdown").click(function() {
        $('#modal-sub-menu-title').html('Tambah Dropdown Menu');
    });
    $("#tab-ubah-sub-menu").click(function() {
        $('#modal-sub-menu-title').html('Ubah Sub Menu');
    });
    // tambah sub menu
    $('.tambah-sub-menu').click(function(e) {
        $('.modal-title').html('Tambah Sub Menu');
        $.ajax({
            url: '<?= base_url(); ?>menu/tambah_subMenu',
            method: 'post',
            dataType: 'json',
            data: {
                menu: $("#menu").val(),
                sub_menu: $("#sub_menu").val(),
                url: $("#url").val(),
                icon: $("#icon").val(),
                is_active: $("#is_active").val(),
                dropdown: $("#dropdown").val()
            },
            beforeSend: function() {
                $(".tambah-sub-menu").attr('disable', 'disabled');
                $(".tambah-sub-menu").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $(".tambah-sub-menu").removeAttr('disable');
                $(".tambah-sub-menu").html('Tambah');
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.menu_user) {
                        $('#menu').addClass('is-invalid');
                        $('.menu_error').html(data.error.menu_user);
                    } else {
                        $('#menu').removeClass('is-invalid');
                        $('.menu_error').html('');
                    }

                    if (data.error.sub_menu) {
                        $('#sub_menu').addClass('is-invalid');
                        $('.sub-menu-error').html(data.error.sub_menu);
                    } else {
                        $('#sub_menu').removeClass('is-invalid');
                        $('.sub-menu-error').html('');
                    }

                    if (data.error.url) {
                        $('#url').addClass('is-invalid');
                        $('.url-menu-error').html(data.error.url);
                    } else {
                        $('#url').removeClass('is-invalid');
                        $('.url-menu-error').html('');
                    }

                    if (data.error.icon) {
                        $('#icon').addClass('is-invalid');
                        $('.icon-menu-error').html(data.error.icon);
                    } else {
                        $('#icon').removeClass('is-invalid');
                        $('.icon-menu-error').html('');
                    }
                } else {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    $('.close').click();
                    readSubMenu();
                    $('#user-menu').val('');
                    $('#sub_menu').val('');
                    $('#url').val('');
                    $('#icon').val('');

                    $('#sub_menu').removeClass('is-invalid');
                    $('.sub-menu-error').html('');

                    $('#url').removeClass('is-invalid');
                    $('.url-menu-error').html('');

                    $('#icon').removeClass('is-invalid');
                    $('.icon-menu-error').html('');
                }
            }
        });
        e.preventDefault();
    });

    $(".aktivasi-menu").click(function() {
        if ($(this).is(":checked")) {
            $("#status").html("Aktif");
            $(this).attr("value", 1);
        } else {
            $("#status").html("Tidak Aktif");
            $(this).attr("value", 0);
        }
    });

    $(".dropdown-menu").click(function() {
        if ($(this).is(":checked")) {
            $("#dropdown-status").html("Ya");
            $(this).attr("value", 1);
        } else {
            $("#dropdown-status").html("Tidak");
            $(this).attr("value", 0);
        }
    });
</script>