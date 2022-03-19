<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan ?>">
        <div class="form-group">
            <label for="nama_pelanggan">Nama pelanggan</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['nama_pelanggan'] ?>" name="nama_pelanggan" id="nama_pelanggan">
            <div class="invalid-feedback nama_pelanggan_error">
            </div>
        </div>
        <div class="form-group">
            <label for="no_tlp">No tlp</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['no_tlp'] ?>" name="no_tlp" id="no_tlp">
            <div class="invalid-feedback no_tlp_error">
            </div>
        </div>
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['nik'] ?>" name="nik" id="nik">
            <div class="invalid-feedback nik_error">
            </div>
        </div>
        <div class="mb-3">
            <label for="validationTextarea" class="text-sm">Alamat</label>
            <textarea class="form-control" name="alamat" value="<?= $data_pelanggan_by_id['alamat'] ?>" id="alamat"><?= $data_pelanggan_by_id['alamat'] ?></textarea>
            <div class="invalid-feedback alamat_error">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <input type="hidden" value="<?= $data_pelanggan_by_id['id_mobil'] ?>" name="id_mobil">
        <div class="form-group">
            <label for="jenis_mobil" class="text-sm">Jenis Mobil</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['jenis_mobil'] ?>" name="jenis_mobil" id="jenis_mobil">
            <div class="invalid-feedback jenis_mobil_error">
            </div>
        </div>
        <div class="form-group">
            <label for="tipe_mobil" class="text-sm">Tipe Mobil</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['tipe_mobil'] ?>" name="tipe_mobil" id="tipe_mobil">
            <div class="invalid-feedback tipe_mobil_error">
            </div>
        </div>
        <div class="form-group">
            <label for="merek_mobil" class="text-sm">Merek Mobil</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['merek_mobil'] ?>" name="merek_mobil" id="merek_mobil">
            <div class="invalid-feedback merek_mobil_error">
            </div>
        </div>
        <div class="form-group">
            <label for="nomor_rangka" class="text-sm">Nomor Rangka</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['nomor_rangka'] ?>" name="nomor_rangka" id="nomor_rangka">
            <div class="invalid-feedback nomor_rangka_error">
            </div>
        </div>
        <div class="form-group">
            <label for="nomor_mesin" class="text-sm">Nomor Mesin</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['nomor_mesin'] ?>" name="nomor_mesin" id="nomor_mesin">
            <div class="invalid-feedback nomor_mesin_error">
            </div>
        </div>
        <div class="form-group">
            <label for="nomor_polisi" class="text-sm">Nomor Polisi</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['nomor_polisi'] ?>" name="nomor_polisi" id="nomor_polisi">
            <div class="invalid-feedback nomor_polisi_error">
            </div>
        </div>
        <div class="form-group">
            <label for="warna_mobil" class="text-sm">Warna Mobil</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['warna_mobil'] ?>" name="warna_mobil" id="warna_mobil">
            <div class="invalid-feedback warna_mobil_error">
            </div>
        </div>
        <div class="form-group">
            <label for="tahun_mobil" class="text-sm">Tahun Mobil</label>
            <input type="text" class="form-control" value="<?= $data_pelanggan_by_id['tahun_mobil'] ?>" name="tahun_mobil" id="tahun_mobil">
            <div class="invalid-feedback tahun_mobil_error">
            </div>
        </div>
    </div>
    <div class="col-md-4 view-data-spareparts">

    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary proses-ubah-data-pelanggan">Ubah Data Pelanggan</button>
</div>


<script>
    $(".proses-ubah-data-pelanggan").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/proses_ubah_data_pelanggan",
            type: "post",
            dataType: "json",
            data: {
                id_pelanggan: $("[name='id_pelanggan']").val(),
                nama_pelanggan: $("[name='nama_pelanggan']").val(),
                no_tlp: $("[name='no_tlp']").val(),
                nik: $("[name='nik']").val(),
                alamat: $("[name='alamat']").val(),
                id_mobil: $("[name='id_mobil']").val(),
                jenis_mobil: $("[name='jenis_mobil']").val(),
                tipe_mobil: $("[name='tipe_mobil']").val(),
                merek_mobil: $("[name='merek_mobil']").val(),
                nomor_rangka: $("[name='nomor_rangka']").val(),
                nomor_mesin: $("[name='nomor_mesin']").val(),
                nomor_polisi: $("[name='nomor_polisi']").val(),
                warna_mobil: $("[name='warna_mobil']").val(),
                tahun_mobil: $("[name='tahun_mobil']").val(),
            },
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
                    $("[name='nama_pelanggan']").removeClass("is-invalid");
                    $(".nama_pelanggan_error").html("");
                    $("[name='no_tlp']").removeClass("is-invalid");
                    $(".no_tlp_error").html("");
                    $("[name='nik']").removeClass("is-invalid");
                    $(".nik_error").html("");
                    $("[name='alamat']").removeClass("is-invalid");
                    $(".alamat_error").html("");
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

                    if (data.status == 200) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight',
                            timeout: 3000
                        });
                        $("#modal-data-pelanggan").modal('hide');
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: 'Data gagal di ubah',
                            position: 'topRight',
                            timeout: 3000
                        });
                    }
                }
            }
        });
        e.preventDefault();
    });
</script>