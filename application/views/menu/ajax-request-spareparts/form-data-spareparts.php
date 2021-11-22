<form id="form-jenis-spareparts">
    <div class="form-group">
        <label for="exampleFormControlInput1">Kode Spareparts</label>
        <input type="text" class="form-control" value="<?= $kd_spareparts; ?>" id="kd_spareparts" name="kd_spareparts" readonly>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Nama Spareparts</label>
        <input type="text" class="form-control" value="" id="nama_spareparts" name="nama_spareparts">
        <div id="validationServer03Feedback" class="invalid-feedback nama_spareparts_error">
        </div>
    </div>
    <button type="submit" class="btn btn-primary proses-tambah-spareparts">Tambah</button>
    <button type="submit" class="btn btn-primary proses-ubah-spareparts">Ubah</button>
</form>
<script>
    $(".proses-ubah-spareparts").attr("style", "display:none;");
    // tambah data jenis service
    $("#form-jenis-spareparts").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>spareparts/add_jenis_spareparts",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_spareparts) {
                        $("[name='nama_spareparts']").addClass('is-invalid');
                        $(".nama_spareparts_error").html(data.error.nama_spareparts);
                    } else {
                        $("[name='nama_spareparts']").removeClass('is-invalid');
                        $(".nama_spareparts_error").html("");
                    }
                } else {
                    $("[name='nama_spareparts']").removeClass('is-invalid');
                    $(".nama_spareparts_error").html("");
                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                        // load table spareparts
                        $.ajax({
                            url: "<?= base_url(); ?>spareparts/load_tb_spareparts",
                            type: "get",
                            success: function(data) {
                                $(".table-jenis-spareparts").html(data);
                            }
                        });
                        // load form agar kode berubah otomatis
                        $.ajax({
                            url: "<?= base_url(); ?>spareparts/load_form_spareparts",
                            type: "get",
                            success: function(data) {
                                $(".form-spareparts").html(data);
                            }
                        });
                        $("[name='nama_spareparts']").val("");
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di tambahkan',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });
</script>