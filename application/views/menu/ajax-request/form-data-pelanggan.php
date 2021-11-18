<form id="form-pelanggan">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" value="" name="id_pelanggan">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pelanggan<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="nama_pelanggan" id="nama_pelanggan">
                        <div id="validationServer03Feedback" class="invalid-feedback nama_pelanggan_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">No Tlp<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="no_tlp" id="no_tlp">
                        <div id="validationServer03Feedback" class="invalid-feedback no_tlp_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">NIK<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="nik" id="nik">
                        <div id="validationServer03Feedback" class="invalid-feedback nik_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Alamat<span class="required text-danger pl-1 text-sm">*</span></label>
                        <textarea class="form-control" value="" id="alamat" name="alamat" row="3"></textarea>
                        <div class="invalid-feedback alamat_error">
                        </div>
                    </div>
                    <input type="hidden" value="" name="id_mobil">
                    <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan_mobil">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Jenis Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="jenis_mobil" id="jenis_mobil">
                        <div id="validationServer03Feedback" class="invalid-feedback jenis_mobil_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tipe Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="tipe_mobil" id="tipe_mobil">
                        <div id="validationServer03Feedback" class="invalid-feedback tipe_mobil_error">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Merk Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="merek_mobil" id="merek_mobil">
                        <div id="validationServer03Feedback" class="invalid-feedback merek_mobil_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Rangka<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="nomor_rangka" id="nomor_rangka">
                        <div id="validationServer03Feedback" class="invalid-feedback nomor_rangka_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Mesin<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="nomor_mesin" id="nomor_mesin">
                        <div id="validationServer03Feedback" class="invalid-feedback nomor_mesin_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Polisi<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="nomor_polisi" id="nomor_polisi">
                        <div id="validationServer03Feedback" class="invalid-feedback nomor_polisi_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Warna Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="warna_mobil" id="warna_mobil">
                        <div id="validationServer03Feedback" class="invalid-feedback warna_mobil_error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tahun Mobil<span class="required text-danger pl-1 text-sm">*</span></label>
                        <input type="text" class="form-control" value="" name="tahun_mobil" id="tahun_mobil">
                        <div id="validationServer03Feedback" class="invalid-feedback tahun_mobil_error">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary proses-ubah-pelanggan">Ubah Data Pelanggan</button>
        <button type="submit" class="btn btn-primary proses-tambah-pelanggan">Tambah Data Pelanggan</button>
        <button type="submit" class="btn btn-primary proses-tambah-mobil">Tambah Data Mobil</button>
    </div>
</form>

<script>
    $("#form-pelanggan").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/proses_tambah_pelanggan",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_pelanggan) {
                        $("[name='nama_pelanggan']").addClass("is-invalid");
                        $(".nama_pelanggan_error").html(data.error.nama_pelanggan);
                    } else {
                        $("[name='nama_pelanggan']").removeClass("is-invalid");
                        $(".nama_pelanggan_error").html("");
                    }
                    if (data.error.no_tlp) {
                        $("[name='no_tlp']").addClass("is-invalid");
                        $(".no_tlp_error").html(data.error.no_tlp);
                    } else {
                        $("[name='no_tlp']").removeClass("is-invalid");
                        $(".no_tlp_error").html("");
                    }
                    if (data.error.nik) {
                        $("[name='nik']").addClass("is-invalid");
                        $(".nik_error").html(data.error.nik);
                    } else {
                        $("[name='nik']").removeClass("is-invalid");
                        $(".nik_error").html("");
                    }
                    if (data.error.alamat) {
                        $("[name='alamat']").addClass("is-invalid");
                        $(".alamat_error").html(data.error.alamat);
                    } else {
                        $("[name='alamat']").removeClass("is-invalid");
                        $(".alamat_error").html("");
                    }
                } else {
                    // hilangkan pesan error
                    $("[name='nama_pelanggan']").removeClass("is-invalid");
                    $(".nama_pelanggan_error").html("");
                    $("[name='no_tlp']").removeClass("is-invalid");
                    $(".no_tlp_error").html("");
                    $("[name='nik']").removeClass("is-invalid");
                    $(".nik_error").html("");
                    $("[name='alamat']").removeClass("is-invalid");
                    $(".alamat_error").html("");

                    // kosongkan inputan
                    $("[name='id_pelanggan']").val("");
                    $("[name='nama_pelanggan']").val("");
                    $("[name='no_tlp']").val("");
                    $("[name='nik']").val("");
                    $("[name='alamat']").val("");

                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                        $(".close").click();
                        $(".add-mobil").removeAttr("style");
                        load_table_pelanggan();
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di ubah',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });

    // proses tambah mobil
    $(".proses-tambah-mobil").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/proses_tambah_mobil",
            type: "post",
            data: {
                id_pelanggan : $("#id_pelanggan_mobil").val(),
                jenis_mobil : $("[name='jenis_mobil']").val(),
                tipe_mobil : $("[name='tipe_mobil']").val(),
                merek_mobil : $("[name='merek_mobil']").val(),
                nomor_rangka : $("[name='nomor_rangka']").val(),
                nomor_mesin : $("[name='nomor_mesin']").val(),
                nomor_polisi : $("[name='nomor_polisi']").val(),
                warna_mobil : $("[name='warna_mobil']").val(),
                tahun_mobil : $("[name='tahun_mobil']").val()
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    if (data.error.jenis_mobil) {
                        $("[name='jenis_mobil']").addClass("is-invalid");
                        $(".jenis_mobil_error").html(data.error.jenis_mobil);
                    } else {
                        $("[name='jenis_mobil']").removeClass("is-invalid");
                        $(".jenis_mobil_error").html("");
                    }
                    if (data.error.tipe_mobil) {
                        $("[name='tipe_mobil']").addClass("is-invalid");
                        $(".tipe_mobil_error").html(data.error.tipe_mobil);
                    } else {
                        $("[name='tipe_mobil']").removeClass("is-invalid");
                        $(".tipe_mobil_error").html("");
                    }
                    if (data.error.merek_mobil) {
                        $("[name='merek_mobil']").addClass("is-invalid");
                        $(".merek_mobil_error").html(data.error.merek_mobil);
                    } else {
                        $("[name='merek_mobil']").removeClass("is-invalid");
                        $(".merek_mobil_error").html("");
                    }
                    if (data.error.nomor_rangka) {
                        $("[name='nomor_rangka']").addClass("is-invalid");
                        $(".nomor_rangka_error").html(data.error.nomor_rangka);
                    } else {
                        $("[name='nomor_rangka']").removeClass("is-invalid");
                        $(".nomor_rangka_error").html("");
                    }
                    if (data.error.nomor_mesin) {
                        $("[name='nomor_mesin']").addClass("is-invalid");
                        $(".nomor_mesin_error").html(data.error.nomor_mesin);
                    } else {
                        $("[name='nomor_mesin']").removeClass("is-invalid");
                        $(".nomor_mesin_error").html("");
                    }
                    if (data.error.nomor_polisi) {
                        $("[name='nomor_polisi']").addClass("is-invalid");
                        $(".nomor_polisi_error").html(data.error.nomor_polisi);
                    } else {
                        $("[name='nomor_polisi']").removeClass("is-invalid");
                        $(".nomor_polisi_error").html("");
                    }
                    if (data.error.warna_mobil) {
                        $("[name='warna_mobil']").addClass("is-invalid");
                        $(".warna_mobil_error").html(data.error.warna_mobil);
                    } else {
                        $("[name='warna_mobil']").removeClass("is-invalid");
                        $(".warna_mobil_error").html("");
                    }
                    if (data.error.tahun_mobil) {
                        $("[name='tahun_mobil']").addClass("is-invalid");
                        $(".tahun_mobil_error").html(data.error.tahun_mobil);
                    } else {
                        $("[name='tahun_mobil']").removeClass("is-invalid");
                        $(".tahun_mobil_error").html("");
                    }
                } else {
                    // hilangkan pesan error
                    $("[name='jenis_mobil']").removeClass("is-invalid");
                    $(".jenis_mobil_error").html("");
                    $("[name='tipe_mobil']").removeClass("is-invalid");
                    $(".tipe_mobil_error").html("");
                    $("[name='merek_mobil']").removeClass("is-invalid");
                    $(".merek_mobil_error").html("");
                    $("[name='nomor_rangka']").removeClass("is-invalid");
                    $(".nomor_rangka_error").html("");
                    $("[name='nomor_mesin']").removeClass("is-invalid");
                    $(".nomor_mesin_error").html("");
                    $("[name='nomor_polisi']").removeClass("is-invalid");
                    $(".nomor_polisi_error").html("");
                    $("[name='warna_mobil']").removeClass("is-invalid");
                    $(".warna_mobil_error").html("");
                    $("[name='tahun_mobil']").removeClass("is-invalid");
                    $(".tahun_mobil_error").html("");

                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight'
                        });
                        $(".close").click();
                        $(".add-mobil").removeAttr("style");
                        load_table_pelanggan();
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di ubah',
                            position: 'topRight'
                        });
                    }
                }
            }
        });
        e.preventDefault();
    })
</script>