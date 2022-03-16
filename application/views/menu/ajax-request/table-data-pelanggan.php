<style>
    .dropdown-item:hover {
        background-color: #000000;
        color: #ffffff;
        ;
    }
</style>
<table class="table table-bordered table-sm" id="spk">
    <thead class="thead-dark text-center">
        <tr class="text-sm">
            <th scope="col">No</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">No Tlp</th>
            <th scope="col">Jenis Mobil</th>
            <th scope="col">Tipe Mobil</th>
            <th scope="col">Merek Mobil</th>
            <th scope="col">Nomor Polisi</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="tr-spk" class="text-center">
        <?php 
        $no = 1;
        foreach($data_pelanggan as $pelanggan): 
        ?>
            <tr class="text-sm" id=tr-hapus-spk>
                <td><?= $no++; ?></td>
                <td><?= $pelanggan['nama_pelanggan']; ?></td>
                <td><?= $pelanggan['no_tlp']; ?></td>
                <td><?= $pelanggan['jenis_mobil']; ?></td>
                <td><?= $pelanggan['tipe_mobil']; ?></td>
                <td><?= $pelanggan['merek_mobil']; ?></td>
                <td><?= $pelanggan['nomor_polisi']; ?></td>
                <td>
                    <?php if($pelanggan['kd_status'] == 1):?>
                        <span class="badge badge-success">Sudah service</span>
                    <?php elseif($pelanggan['kd_status'] == 0): ?>
                        <span class="badge badge-danger">Belum service</span>
                    <?php else: ?>
                        <span class="badge badge-warning">Sedang proses</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" kd="dropdownMenuOffset" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            <a class="dropdown-item hapus-data-pelanggan" data-idmobil="<?= $pelanggan['id_mobil']; ?>" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" href="#"><i class="fas fa-trash"></i> Hapus Data Service</a>
                            <a class="dropdown-item ubah-data-service" href="#" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" ><i class="fas fa-edit"></i> Ubah Data Service</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#spk').DataTable();
    });

    // delete service
    $(".hapus-data-pelanggan").click(function(e) {
        $(this).closest("#tr-hapus-spk").addClass("hapus-spk");
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
                    dataType: "json",
                    data: {
                        id_pelanggan: $(this).data("idpelanggan"),
                        id_mobil: $(this).data("idmobil")
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $(".hapus-spk").fadeOut(1000);
                        } else {
                            iziToast.error({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                        }
                    }
                })
            }
        });
        e.preventDefault();
    });

    // detail service
    $(".detail-service").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/detail_service",
            type: "get",
            data: {
                id_service: $(this).data("idservice"),
                id_pelanggan: $(this).data("idpelanggan")
            },
            success: function(data) {
                $(".view-table-cetak-spk").html(data);
            }

        });
        e.preventDefault();
    });

    // ubah data service
    $(".ubah-data-service").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/update_data_spk",
            type: "get",
            data: {
                id_service: $(this).data("idservice"),
                id_pelanggan: $(this).data("idpelanggan")
            },
            beforeSend: function() {
                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                $(".view-table-cetak-spk").html(data);
            }
        });
        e.preventDefault();
    });

    $(".change-status").change(function() {
        switch ($(this).val()) {
            case '1':
                $(this).removeAttr("style").attr("style", "outline:2px solid #C83934;");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("idservice"),
                        id_status: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight',
                                timeout: 3000
                            });
                            $.ajax({
                                url: "<?= base_url(); ?>service/loadTableDataSpk",
                                type: "get",
                                beforeSend: function() {
                                    $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                },
                                success: function(data) {
                                    $(".view-table-cetak-spk").html(data);
                                }
                            });
                        }
                    }
                });
                break;
            case '2':
                $(this).removeAttr("style").attr("style", "outline:2px solid #3F8839;");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("idservice"),
                        id_status: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight',
                                timeout: 3000
                            });
                            $.ajax({
                                url: "<?= base_url(); ?>service/loadTableDataSpk",
                                type: "get",
                                beforeSend: function() {
                                    $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                },
                                success: function(data) {
                                    $(".view-table-cetak-spk").html(data);
                                }
                            });
                        }
                    }
                });
                break;
            case '3':
                $(this).removeAttr("style").attr("style", "outline:2px solid #DFA92C;");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("idservice"),
                        id_status: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight',
                                timeout: 3000
                            });
                            $.ajax({
                                url: "<?= base_url(); ?>service/loadTableDataSpk",
                                type: "get",
                                beforeSend: function() {
                                    $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                },
                                success: function(data) {
                                    $(".view-table-cetak-spk").html(data);
                                }
                            });
                        }
                    }
                });
                break;
            default:
                break;
        }
    });
</script>