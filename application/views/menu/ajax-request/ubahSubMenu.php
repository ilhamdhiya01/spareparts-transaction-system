<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row" style="display: block;">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="form-title">Tabel Sub Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <form action="" method="post" class="form-sub-menu">
                                        <input type="hidden" name="id" data-id="<?= $subMenu_byId['id'] ?>" value="<?= $subMenu_byId['id']; ?>" id="id-sub-menu">
                                        <div class="form-group" id="options">
                                            <label class="control-label ">Pilih Menu<span class="required text-danger pl-1">*</span></label>
                                            <select class="form-control option" name="user-menu" id="user-menu">
                                                <option>-- Pilih --</option>
                                                <?php foreach ($user_menu as $menu) : ?>
                                                    <?php if ($menu['id'] == $subMenu_byId['menu_id']) : ?>
                                                        <option value="<?= $menu['id']; ?>" id="value" selected><?= $menu['nama_menu']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $menu['id']; ?>" id="value"><?= $menu['nama_menu']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Sub Menu<span class="required text-danger pl-1">*</span></label>
                                            <input type="text" class="form-control" value="<?= $subMenu_byId['sub_menu']; ?>" name="sub_menu" id="sub_menu">
                                            <div id="validationServer03Feedback" class="invalid-feedback sub-menu-error">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Url<span class="required text-danger pl-1">*</span></label>
                                            <input type="text" class="form-control" value="<?= $subMenu_byId['url']; ?>"" name=" url" id="url">
                                            <div id="validationServer03Feedback" class="invalid-feedback url-menu-error">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Icon<span class="required text-danger pl-1">*</span></label>
                                            <input type="text" class="form-control" value="<?= $subMenu_byId['icon']; ?>"" name=" icon" id="icon">
                                            <div id="validationServer03Feedback" class="invalid-feedback icon-menu-error">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" id="label">Aktivasi Menu</label>
                                            <div class="custom-control custom-switch">
                                                <?php if ($subMenu_byId['is_active'] > 0) : ?>
                                                    <input type="checkbox" class="custom-control-input aktivasi-menu" data-id="<?= $subMenu_byId['is_active']; ?>" value="0" checked name="is_active" id="is_active">
                                                <?php else : ?>
                                                    <input type="checkbox" class="custom-control-input aktivasi-menu" data-id="0" value="0" name="is_active" id="is_active">
                                                <?php endif; ?>
                                                <label class="custom-control-label" for="is_active" id="status">Tidak Aktif</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dropdown Menu</label>
                                            <div class="custom-control custom-switch">
                                                <?php if ($subMenu_byId['dropdown'] > 0) : ?>
                                                    <input type="checkbox" class="custom-control-input dropdown-menu" data-id="<?= $subMenu_byId['dropdown']; ?>" value="0" checked name="dropdown" id="dropdown">
                                                <?php else : ?>
                                                    <input type="checkbox" class="custom-control-input dropdown-menu" data-id="0" value="0" name="dropdown" id="dropdown">
                                                <?php endif; ?>
                                                <label class="custom-control-label" for="dropdown" id="dropdown-status">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm ubah-sub-menu" id="btn-form">Ubah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        aktivasi_menu();
        dropdown_menu();
    })

    function aktivasi_menu() {
        if ($(".aktivasi-menu").data('id') == 1) {
            $("#status").html("Aktif");
        } else {
            $("#status").html("Tidak Aktif");
        }
    }

    function dropdown_menu() {
        if ($("#dropdown").data('id') == 1) {
            $("#dropdown-status").html("Ya");
        } else {
            $("#dropdown-status").html("Tidak");
        }
    }

    $(".aktivasi-menu").click(function() {
        if ($(this).is(":checked")) {
            $("#status").html("Aktif");
            $(this).attr("data-id", 1);
        } else {
            $("#status").html("Tidak Aktif");
            $(this).attr("data-id", 0);
        }
    });
    $(".dropdown-menu").change(function() {
        if ($(this).is(":checked")) {
            $("#dropdown-status").html("Ya");
            $(this).attr("data-id", 1);
        } else {
            $("#dropdown-status").html("Tidak");
            $(this).attr("data-id", 0);
        }
    });
</script>