<form id="form_data_mobil">
    <input type="hidden" value="<?= $id_pelanggan['id'] - 1 ?>" name="id_sebelum" id="id_sebelum">
    <?php if (is_null($id_pelanggan['id'])) : ?>
        <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan">
    <?php else : ?>
        <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
    <?php endif; ?>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Jenis Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="" id="jenis_mobil" name="jenis_mobil">
            <div id="validationServer03Feedback" class="invalid-feedback jenis_mobil_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Tipe Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="tipe_mobil" name="tipe_mobil">
            <div id="validationServer03Feedback" class="invalid-feedback tipe_mobil_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Merek Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="merek_mobil" name="merek_mobil">
            <div id="validationServer03Feedback" class="invalid-feedback merek_mobil_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Nomor Rangka<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="nomor_rangka" name="nomor_rangka">
            <div id="validationServer03Feedback" class="invalid-feedback nomor_rangka_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Nomor Mesin<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="nomor_mesin" name="nomor_mesin">
            <div id="validationServer03Feedback" class="invalid-feedback nomor_mesin_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Nomor Polisi<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="nomor_polisi" name="nomor_polisi">
            <div id="validationServer03Feedback" class="invalid-feedback nomor_polisi_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Warna Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="warna_mobil" name="warna_mobil">
            <div id="validationServer03Feedback" class="invalid-feedback warna_mobil_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Tahun Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
        <div class="col-sm-10">
            <input type="text" value="" class="form-control" id="tahun_mobil" name="tahun_mobil">
            <div id="validationServer03Feedback" class="invalid-feedback tahun_mobil_error">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button>
</form>
<script>
    // $("#id_pelanggan").val("");
    $(document).ready(function() {
        if ($("#id_sebelum").val() == <?= $id_pelanggan['id']; ?>) {
            $.ajax({
                url: "<?= base_url(); ?>service/loadPageError",
                type: "get",
                success: function(data) {
                    $(".view-form-add-mobil").html(data);
                }
            });
        }
    });

    $("#form_data_mobil").submit(function(e) {
        const data = $(this).serialize();
        $.ajax({
            url: "<?= base_url(); ?>service/add_data_mobil",
            type: "post",
            data: data,
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    if (data.error.jenis_mobil) {
                        $("#jenis_mobil").addClass("is-invalid");
                        $(".jenis_mobil_error").html(data.error.jenis_mobil);
                    } else {
                        $("#jenis_mobil").removeClass("is-invalid");
                        $(".jenis_mobil_error").html("");
                    }

                    if (data.error.tipe_mobil) {
                        $("#tipe_mobil").addClass("is-invalid");
                        $(".tipe_mobil_error").html(data.error.tipe_mobil);
                    } else {
                        $("#tipe_mobil").removeClass("is-invalid");
                        $(".tipe_mobil_error").html("");
                    }

                    if (data.error.merek_mobil) {
                        $("#merek_mobil").addClass("is-invalid");
                        $(".merek_mobil_error").html(data.error.merek_mobil);
                    } else {
                        $("#merek_mobil").removeClass("is-invalid");
                        $(".merek_mobil_error").html("");
                    }

                    if (data.error.nomor_rangka) {
                        $("#nomor_rangka").addClass("is-invalid");
                        $(".nomor_rangka_error").html(data.error.nomor_rangka);
                    } else {
                        $("#nomor_rangka").removeClass("is-invalid");
                        $(".nomor_rangka_error").html("");
                    }

                    if (data.error.nomor_mesin) {
                        $("#nomor_mesin").addClass("is-invalid");
                        $(".nomor_mesin_error").html(data.error.nomor_mesin);
                    } else {
                        $("#nomor_mesin").removeClass("is-invalid");
                        $(".nomor_mesin_error").html("");
                    }

                    if (data.error.nomor_polisi) {
                        $("#nomor_polisi").addClass("is-invalid");
                        $(".nomor_polisi_error").html(data.error.nomor_polisi);
                    } else {
                        $("#nomor_polisi").removeClass("is-invalid");
                        $(".nomor_polisi_error").html("");
                    }

                    if (data.error.warna_mobil) {
                        $("#warna_mobil").addClass("is-invalid");
                        $(".warna_mobil_error").html(data.error.warna_mobil);
                    } else {
                        $("#warna_mobil").removeClass("is-invalid");
                        $(".warna_mobil_error").html("");
                    }

                    if (data.error.tahun_mobil) {
                        $("#tahun_mobil").addClass("is-invalid");
                        $(".tahun_mobil_error").html(data.error.tahun_mobil);
                    } else {
                        $("#tahun_mobil").removeClass("is-invalid");
                        $(".tahun_mobil_error").html("");
                    }

                    if (data.error.id_pelanggan) {
                        $.ajax({
                            url: "<?= base_url(); ?>service/loadPageError",
                            type: "get",
                            success: function(data) {
                                $(".view-form-add-mobil").html(data);
                            }
                        });
                    }
                } else {
                    // kosongkan value
                    $("#jenis_mobil").val("");
                    $("#tipe_mobil").val("");
                    $("#nomor_rangka").val("");
                    $("#nomor_mesin").val("");
                    $("#nomor_polisi").val("");
                    $("#merek_mobil").val("");
                    $("#warna_mobil").val("");
                    $("#tahun_mobil").val("");

                    // hilangkan error
                    $("#jenis_mobil").removeClass("is-invalid");
                    $(".jenis_mobil_error").html("");
                    $("#tipe_mobil").removeClass("is-invalid");
                    $(".tipe_mobil_error").html("");
                    $("#merek_mobil").removeClass("is-invalid");
                    $(".merek_mobil_error").html("");
                    $("#nomor_rangka").removeClass("is-invalid");
                    $(".nomor_rangka_error").html("");
                    $("#nomor_mesin").removeClass("is-invalid");
                    $(".nomor_mesin_error").html("");
                    $("#nomor_polisi").removeClass("is-invalid");
                    $(".nomor_polisi_error").html("");
                    $("#warna_mobil").removeClass("is-invalid");
                    $(".warna_mobil_error").html("");
                    $("#tahun_mobil").removeClass("is-invalid");
                    $(".tahun_mobil_error").html("");

                    // proses tambah
                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di tambahakan',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });
</script>