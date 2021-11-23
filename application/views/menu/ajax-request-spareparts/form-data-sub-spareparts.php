<form id="form-sub-spareparts">
    <input type="hidden" class="form-control" value="" id="id" name="id">
    <div class="form-group">
        <label for="exampleFormControlInput1">Kode Spareparts<span class="required text-danger pl-1 text-sm">*</span></label>
        <input type="text" class="form-control" value="<?= $jenis_spareparts['kd_spareparts']; ?>" id="kd_spareparts" name="kd_spareparts" readonly>
        <div id="validationServer03Feedback" class="invalid-feedback nama_spareparts_error">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Jenis Spareparts<span class="required text-danger pl-1 text-sm">*</span></label>
        <input type="text" class="form-control" value="<?= $jenis_spareparts['jenis_spareparts']; ?>" id="jenis_spareparts" name="jenis_spareparts" readonly>
        <div id="validationServer03Feedback" class="invalid-feedback nama_spareparts_error">
        </div>
    </div>
    <input type="hidden" class="form-control" value="<?= $jenis_spareparts['id_spareparts']; ?>" id="id_spareparts" name="id_spareparts">
    <div class="form-group">
        <label for="exampleFormControlInput1">Nama Spareparts<span class="required text-danger pl-1 text-sm">*</span></label>
        <input type="text" class="form-control" value="" id="nama_spareparts" name="nama_spareparts">
        <div id="validationServer03Feedback" class="invalid-feedback nama_spareparts_error">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Harga<span class="required text-danger pl-1 text-sm">*</span></label>
        <input type="text" class="form-control" value="" id="harga" name="harga">
        <div id="validationServer03Feedback" class="invalid-feedback harga_error">
        </div>
    </div>
    <button type="submit" class="btn btn-primary proses-tambah-sub-spareparts float-right">Tambah</button>
</form>
<script>
    $(".proses-ubah-sub-spareparts").attr("style", "display:none;");

    $("#form-sub-spareparts").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>spareparts/proses_tambah_sub_spareparts",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $(".proses-tambah-sub-spareparts").attr('disable', 'disabled');
                $(".proses-tambah-sub-spareparts").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $(".proses-tambah-sub-spareparts").removeAttr('disable');
                $(".proses-tambah-sub-spareparts").html('Tambah');
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_spareparts) {
                        $("[name='nama_spareparts']").addClass("is-invalid");
                        $(".nama_spareparts_error").html(data.error.nama_spareparts);
                    } else {
                        $("[name='nama_spareparts']").removeClass("is-invalid");
                        $(".nama_spareparts_error").html("");
                    }

                    if (data.error.harga) {
                        $("[name='harga']").addClass("is-invalid");
                        $(".harga_error").html(data.error.harga);
                    } else {
                        $("[name='harga']").removeClass("is-invalid");
                        $(".harga_error").html("");
                    }
                } else {
                    $("[name='nama_spareparts']").removeClass("is-invalid");
                    $(".nama_spareparts_error").html("");
                    $("[name='harga']").removeClass("is-invalid");
                    $(".harga_error").html("");
                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                        $("#modal-form-sub").modal("hide");
                        $.ajax({
                            url: "<?= base_url(); ?>spareparts/load_tb_sub_spareparts",
                            type: "get",
                            success: function(data) {
                                $(".tb-data-sub-spareparts").html(data);
                            }
                        });
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