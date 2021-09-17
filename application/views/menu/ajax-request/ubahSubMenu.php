<form action="" method="post" class="form-sub-menu">
    <input type="hidden" name="id" value="" id="id-sub-menu">
    <div class="form-group" id="options">
        <label class="control-label ">Pilih Menu<span class="required text-danger pl-1">*</span></label>
        <select class="form-control option" name="user-menu" id="user-menu">
            <option>-- Pilih --</option>
            <?php foreach ($user_menu as $menu) : ?>
                <option value="<?= $menu['id']; ?>" id="value"><?= $menu['nama_menu']; ?></option>
            <?php endforeach; ?>
        </select>
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
        <!-- <button type="submit" class="btn btn-primary btn-sm ubah-sub-menu" id="">Ubah</button> -->
    </div>
</form>
<script>
    // $(".aktivasi-menu").click(function() {
    //     if ($(this).is(":checked")) {
    //         $("#status").html("Aktif");
    //         $(this).attr("data-id", 1);
    //         $(this).attr("value", 1);
    //     } else {
    //         $("#status").html("Tidak Aktif");
    //         $(this).attr("data-id", 0);
    //         $(this).attr("value", 0);
    //     }
    // });
    // $(".dropdown-menu").change(function() {
    //     if ($(this).is(":checked")) {
    //         $("#dropdown-status").html("Ya");
    //         $(this).attr("data-id", 1);
    //         $(this).attr("value", 1);
    //     } else {
    //         $("#dropdown-status").html("Tidak");
    //         $(this).attr("data-id", 0);
    //         $(this).attr("value", 0);
    //     }
    // });
</script>