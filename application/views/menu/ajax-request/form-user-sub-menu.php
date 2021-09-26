<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tambah Sub Menu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tambah Dropdown</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
        booth letterpress, commodo enim craft beer mlkshk aliquip
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
        booth letterpress, commodo enim craft beer mlkshk
    </div>
</div>
<script>
    // proses ubah
    $('#modal-tambah-sub-menu').click(function() {
        $('#modal-sub-menu-title').html('Tambah Sub Menu');
        $('.ubah-sub-menu').css('display', 'none');
        $('.tambah-sub-menu').css('display', '');
        $('#user-menu').val('-- Pilih --');
        $('#sub_menu').val('');
        $('#url').val('');
        $('#icon').val('');

        if ($('.aktivasi-menu').val() == 1) {
            $(this).attr("checked");
            $(this).val(0)
        }

        if ($('#is_active').val() == 1) {
            $(this).removeAttr("checked");
            $(this).val(0)
        }

        if ($('#dropdown').val() == 0) {
            $(this).removeAttr("checked", "checked");
        }

        $('#sub_menu').removeClass('is-invalid');
        $('.sub-menu-error').html('');

        $('#url').removeClass('is-invalid');
        $('.url-menu-error').html('');

        $('#icon').removeClass('is-invalid');
        $('.icon-menu-error').html('');
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