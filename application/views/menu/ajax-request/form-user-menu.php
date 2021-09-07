<form action="" id="form-user-menu" method="post">
    <input type="hidden" class="form-control" value="" name="id-menu" id="id-menu">
    <div class="form-group">
        <label id="label-nama-menu">Nama Menu</label>
        <input type="text" class="form-control" value="" name="nama-menu" id="nama-menu">
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
    // tambah user menu dengan ajax
    $(".btn-user-menu-tambah").click(function(e) {
        let data = $("#form-user-menu").serialize();
        $.ajax({
            url: "<?= base_url(); ?>menu/tambah_userMenu",
            type: "post",
            dataType: "json",
            data: data,
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
        })
        e.preventDefault();
    });

    $('.update-menu').click(function(e) {
        $("#form-title-menu").html("Ubah Menu");
        $(".btn-user-menu-ubah").css("display","");
        $(".btn-refresh").css("display","");
        $(".btn-user-menu-tambah").css("display","none");
        let id = $(this).data('id');
        $.ajax({
            url: "<?= base_url(); ?>menu/get_userMenuById",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {
                $('#nama-menu').val(data.menu.nama_menu);
            }
        })
        e.preventDefault();
    });

    $(".btn-user-menu-ubah").click(function(e){
        e.preventDefault()
    })
</script>