<table class="table table-striped" id="table-data-pelanggan">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">No Tlp</th>
            <th scope="col">NIK</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($data_pelanggan as $pelanggan) :
        ?>
            <tr id="tr-data-pelanggan">
                <th scope="row"><?= $no++; ?></th>
                <td><?= $pelanggan['nama_pelanggan']; ?></td>
                <td><?= $pelanggan['no_tlp']; ?></td>
                <td><?= substr($pelanggan['nik'], 0, -7) . 'XXXXX'; ?></td>
                <td><?= $pelanggan['alamat']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item delete-pelanggan" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" data-idmobil="<?= $pelanggan['id_mobil']; ?>" href="#"><i class="fas fa-trash"></i> Hapus Data Pelanggan</a>
                            <a class="dropdown-item update-pelanggan" href="#" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" data-idmobil="<?= $pelanggan['id_mobil']; ?>" data-toggle="modal" data-target="#modal-pelanggan"><i class="fas fa-edit"></i> Ubah Data Pelanggan</a>
                            <a class="dropdown-item add-service-pelanggan" href="#" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" data-idmobil="<?= $pelanggan['id_mobil']; ?>" data-toggle="modal" data-target="#modal-pelanggan"><i class="fas fa-tools"></i> Tambah Service</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $("#table-data-pelanggan").DataTable();
    });

    // hapus pelanggan
    $(".delete-pelanggan").click(function(e) {
        $(this).closest("#tr-data-pelanggan").addClass("hapus-data-pelanggan");
        Swal.fire({
            title: 'Hapus data ini ?',
            text: 'Data yang terhapus tidak akan kembali !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url(); ?>service/hapus_data_pelanggan",
                    type: "post",
                    data: {
                        id_pelanggan: $(this).data("idpelanggan"),
                        id_mobil: $(this).data("idmobil")
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data.status == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $(".hapus-data-pelanggan").fadeOut(1500);
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: 'Data gagal di hapus',
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        })
        e.preventDefault();
    });

    // update data pelanggan
    $(".update-pelanggan").click(function() {
        $("#modal-title-pelanggan").html("<i class='fas fa-user-edit'></i> Ubah Data Pelanggan");
        $(".proses-tambah-pelanggan").attr("style","display:none;");
        $(".proses-tambah-mobil").attr("style","display:none;");
        $(".proses-ubah-pelanggan").removeAttr("style");

        $("#nik").attr("readonly","readonly");
        $("#nomor_mesin").attr("readonly","readonly");
        $("#nomor_rangka").attr("readonly","readonly");
        $("#nomor_polisi").attr("readonly","readonly");
        const id_pelanggan = $(this).data("idpelanggan");
        const id_mobil = $(this).data("idmobil");

        $.ajax({
            url: "<?= base_url(); ?>service/ubah_data_pelanggan",
            type: "post",
            data: {
                id_pelanggan: $(this).data("idpelanggan")
            },
            dataType: "json",
            success: function(data) {
                $("[name='id_pelanggan']").val(data.data_pelanggan_by_id.id_pelanggan);
                $("[name='nama_pelanggan']").val(data.data_pelanggan_by_id.nama_pelanggan);
                $("[name='no_tlp']").val(data.data_pelanggan_by_id.no_tlp);
                $("[name='nik']").val(data.data_pelanggan_by_id.nik);
                $("[name='alamat']").val(data.data_pelanggan_by_id.alamat);
                $("[name='id_mobil']").val(data.data_pelanggan_by_id.id_mobil);
                $("[name='jenis_mobil']").val(data.data_pelanggan_by_id.jenis_mobil);
                $("[name='tipe_mobil']").val(data.data_pelanggan_by_id.tipe_mobil);
                $("[name='merek_mobil']").val(data.data_pelanggan_by_id.merek_mobil);
                $("[name='nomor_rangka']").val(data.data_pelanggan_by_id.nomor_rangka);
                $("[name='nomor_mesin']").val(data.data_pelanggan_by_id.nomor_mesin);
                $("[name='nomor_polisi']").val(data.data_pelanggan_by_id.nomor_polisi);
                $("[name='warna_mobil']").val(data.data_pelanggan_by_id.warna_mobil);
                $("[name='tahun_mobil']").val(data.data_pelanggan_by_id.tahun_mobil);

                // proses update data pelanggan
                $(".proses-ubah-pelanggan").click(function(e) {
                    const nama_pelanggan = $("[name='nama_pelanggan']").val();
                    const no_tlp = $("[name='no_tlp']").val();
                    const nik = $("[name='nik']").val();
                    const alamat = $("[name='alamat']").val();
                    const jenis_mobil = $("[name='jenis_mobil']").val();
                    const tipe_mobil = $("[name='tipe_mobil']").val();
                    const merek_mobil = $("[name='merek_mobil']").val();
                    const nomor_rangka = $("[name='nomor_rangka']").val();
                    const nomor_mesin = $("[name='nomor_mesin']").val();
                    const nomor_polisi = $("[name='nomor_polisi']").val();
                    const warna_mobil = $("[name='warna_mobil']").val();
                    const tahun_mobil = $("[name='tahun_mobil']").val();
                    $.ajax({
                        url: "<?= base_url(); ?>service/proses_ubah_pelanggan",
                        type: "post",
                        data: {
                            id_pelanggan: $("[name='id_pelanggan']").val(),
                            id_mobil: $("[name='id_mobil']").val(),
                            nama_pelanggan: nama_pelanggan,
                            no_tlp: no_tlp,
                            nik: nik,
                            alamat: alamat,
                            jenis_mobil: jenis_mobil,
                            tipe_mobil: tipe_mobil,
                            merek_mobil: merek_mobil,
                            nomor_rangka: nomor_rangka,
                            nomor_mesin: nomor_mesin,
                            nomor_polisi: nomor_polisi,
                            warna_mobil: warna_mobil,
                            tahun_mobil: tahun_mobil
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error) {
                                if (data.error.nama_pelanggan) {
                                    $("[name='nama_pelanggan']").addClass("is-invalid");
                                    $(".nama_pelanggan_error").html(data.error.nama_pelanggan);
                                }
                                if (data.error.no_tlp) {
                                    $("[name='no_tlp']").addClass("is-invalid");
                                    $(".no_tlp_error").html(data.error.no_tlp);
                                }
                                if (data.error.alamat) {
                                    $("[name='alamat']").addClass("is-invalid");
                                    $(".alamat_error").html(data.error.alamat);
                                }
                                if (data.error.jenis_mobil) {
                                    $("[name='jenis_mobil']").addClass("is-invalid");
                                    $(".jenis_mobil_error").html(data.error.jenis_mobil);
                                }
                                if (data.error.tipe_mobil) {
                                    $("[name='tipe_mobil']").addClass("is-invalid");
                                    $(".tipe_mobil_error").html(data.error.tipe_mobil);
                                }
                                if (data.error.merek_mobil) {
                                    $("[name='merek_mobil']").addClass("is-invalid");
                                    $(".merek_mobil_error").html(data.error.merek_mobil);
                                }
                                if (data.error.warna_mobil) {
                                    $("[name='warna_mobil']").addClass("is-invalid");
                                    $(".warna_mobil_error").html(data.error.warna_mobil);
                                }
                                if (data.error.tahun_mobil) {
                                    $("[name='tahun_mobil']").addClass("is-invalid");
                                    $(".tahun_mobil_error").html(data.error.tahun_mobil);
                                }
                            } else {
                                $("[name='nama_pelanggan']").removeClass("is-invalid");
                                $(".nama_pelanggan_error").html("");
                                $("[name='no_tlp']").removeClass("is-invalid");
                                $(".no_tlp_error").html("");
                                $("[name='alamat']").removeClass("is-invalid");
                                $(".alamat_error").html("");
                                $("[name='jenis_mobil']").removeClass("is-invalid");
                                $(".jenis_mobil_error").html("");
                                $("[name='tipe_mobil']").removeClass("is-invalid");
                                $(".tipe_mobil_error").html("");
                                $("[name='merek_mobil']").removeClass("is-invalid");
                                $(".merek_mobil_error").html("");
                                $("[name='warna_mobil']").removeClass("is-invalid");
                                $(".warna_mobil_error").html("");
                                $("[name='tahun_mobil']").removeClass("is-invalid");
                                $(".tahun_mobil_error").html("");

                                if (data.status == 200) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                    $(".close").click();
                                    // tampilkan data realtime
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

            }
        });
    });

    // detail mobil
    $(".add-service-pelanggan").click(function(e) {
        const id_pelanggan = $(this).data("idpelanggan");
        const id_mobil = $(this).data("idmobil");
        $.ajax({
            url: "<?= base_url(); ?>service/loadBtnJenisServicePelanggan",
            type: "get",
            data : {
                id_pelanggan : id_pelanggan,
                id_mobil : id_mobil
            },
            beforeSend: function() {
                $(".modal-pelanggan").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".modal-pelanggan").html(data);
                }, 500);
            }
        });
        e.preventDefault();
    })
</script>