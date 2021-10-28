<form id="form_add_service">
    <?php if (is_null(@$id_pelanggan['id'])) : ?>
        <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan">
    <?php else : ?>
        <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
    <?php endif; ?>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Kode Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?= $kd_service; ?>" name="kode_service" id="kode_service">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Jenis Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?= $nama_service; ?>" name="jenis_service" id="jenis_service">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Harga Jasa<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?= rupiah($harga_jasa); ?>" name="harga" id="harga">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>

    <div class="form-group row sub_service">
        <label for="" class="col-sm-2 col-form-label text-sm">Sub Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="" name="sub_service" id="sub_service">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>

    <div class="form-group row service_lain">
        <label for="" class="col-sm-2 col-form-label text-sm">Service Lain-lain<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <textarea class="form-control" value="" id="service_lain" name="service_lain" row="3"></textarea>
            <div class="invalid-feedback alamat_customer_error">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Tanggal Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" value="" name="tanggal_service" id="tanggal_service">
            <div id="validationServer03Feedback" class="invalid-feedback tanggal_service_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Info Lain-lain<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <textarea class="form-control" id="info_lain" name="info_lain" row="3"></textarea>
            <div class="invalid-feedback alamat_customer_error">
            </div>
        </div>
    </div>
    <button type="submit" id="btn_add_service" class="btn btn-sm btn-primary float-right">Simpan</button>
</form>
<script>
    $(document).ready(function() {
        const nama_service = $("#jenis_service").val();
        switch (nama_service) {
            case "Service Berkala":
                $("#sub_service").val("<?= $nama_sub_service; ?>");
                $(".service_lain").css("display", "none");
                break;
            case "Service Tune Up":
                $("#sub_service").val("");
                $(".service_lain").css("display", "none");
                $(".sub_service").css("display", "none");
                break;
            case "Service Lain-lain":
                $("#sub_service").val("");
                $(".sub_service").css("display", "none");
                break;
            default:
                break;
        }
    });
    $("#form_add_service").submit(function(e) {
        // if($("#jenis_service").val() == "Service Tune Up"){
        // }
        const jenis_service = $("#jenis_service").val();
        const data_service = $(this).serialize();
        switch (jenis_service) {
            case "Service Tune Up":
                // console.log(data_service);
                if ($("#tanggal_service").val() == "" || $("#tanggal_service").val() == undefined) {
                    $("#tanggal_service").addClass("is-invalid");
                    $(".tanggal_service_error").html("Tanggal service wajib di isi");
                    break;
                } else {
                    $("#tanggal_service").removeClass("is-invalid");
                    $(".tanggal_service_error").html("");
                    $.ajax({
                        url: "<?= base_url(); ?>service/addTuneUpService",
                        type: "post",
                        data: {
                            id_pelanggan: $("#id_pelanggan").val(),
                            kode_service: $("#kode_service").val(),
                            jenis_service: $("#jenis_service").val(),
                            harga: $("#harga").val(),
                            sub_service: $("#sub_service").val(),
                            service_lain: $("#service_lain").val(),
                            tgl_service: $("#tanggal_service").val(),
                            info_lain: $("#info_lain").val()
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.status == 201) {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Data gagal di tambahkan',
                                    position: 'topRight'
                                });
                            }
                            // if (data.error) {
                            //     if (data.error.tanggal_service) {
                            //         $("#tanggal_service").addClass("is-invalid");
                            //         $(".tanggal_service_error").html(data.error.tanggal_service);
                            //     } else {
                            //         $("#tanggal_service").removeClass("is-invalid");
                            //         $(".tanggal_service_error").html("");
                            //     }
                            // } else {
                            //     $("#tanggal_service").removeClass("is-invalid");
                            //     $(".tanggal_service_error").html("");
                            //     console.log(data);
                            // }
                        }
                    });
                }
                break;
            case "Service Lain-lain":
                alert('lain lain');
                break;
            case "Service Berkala":
                alert('berkala');
                break;
            default:
                break;
        }
        // const data = $(this).serialize();
        // $.ajax({
        //     url: "<?= base_url(); ?>service/addJenisService",
        //     type: "post",
        //     data: data,
        //     dataType: "json",
        //     success: function(data) {

        //     }
        // })
        e.preventDefault();
    })
</script>