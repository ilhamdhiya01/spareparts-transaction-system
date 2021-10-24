<form id="form_add_customer">
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Nama<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="" name="nama_customer" id="nama_customer">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">No Hp / WA<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="" name="no_tlp" id="no_tlp">
            <div id="validationServer03Feedback" class="invalid-feedback no_tlp_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">NIK<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nik" id="nik">
            <div id="validationServer03Feedback" class="invalid-feedback nik_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Alamat<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <textarea class="form-control" id="alamat" name="alamat" row="3"></textarea>
            <div class="invalid-feedback alamat_customer_error">
            </div>
        </div>
    </div>
    <button type="submit" id="btn_add_customer" class="btn btn-sm btn-primary float-right">Simpan</button>
</form>
<script>
    $("#form_add_customer").submit(function(e) {
        const data = $(this).serialize();
        // console.log(data);
        $.ajax({
            url: "<?= base_url(); ?>service/add_service",
            type: "post",
            dataType: "json",
            data: data,
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_customer) {
                        $("#nama_customer").addClass("is-invalid");
                        $(".nama_customer_error").html(data.error.nama_customer);
                    } else {
                        $("#nama_customer").removeClass("is-invalid");
                        $(".nama_customer_error").html("");
                    }

                    if (data.error.no_tlp) {
                        $("#no_tlp").addClass("is-invalid");
                        $(".no_tlp_customer_error").html(data.error.no_tlp);
                    } else {
                        $("#no_tlp").removeClass("is-invalid");
                        $(".no_tlp_customer_error").html("");
                    }

                    if (data.error.nik) {
                        $("#nik").addClass("is-invalid");
                        $(".nik_customer_error").html(data.error.nik);
                    } else {
                        $("#nik").removeClass("is-invalid");
                        $(".nik_error").html("");
                    }

                    if (data.error.alamat) {
                        $("#alamat").addClass("is-invalid");
                        $(".alamat_customer_error").html(data.error.alamat);
                    } else {
                        $("#alamat").removeClass("is-invalid");
                        $(".alamat_customer_error").html("");
                    }
                } else {
                    $("#nama_customer").removeClass("is-invalid");
                    $(".nama_customer_error").html("");
                    $("#no_tlp").removeClass("is-invalid");
                    $(".no_tlp_customer_error").html("");
                    $("#nik").removeClass("is-invalid");
                    $(".nik_error").html("");
                    $("#alamat").removeClass("is-invalid");
                    $(".alamat_customer_error").html("");
                    $("#nama_customer").val("");
                    $("#no_tlp").val("");
                    $("#nik").val("");
                    $("#alamat").val("");
                    if (data.response == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di tambhakna',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });
</script>