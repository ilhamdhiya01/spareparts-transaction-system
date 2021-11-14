<table class="table table-striped table-bordered" id="tab1">
    <thead>
        <tr class="text-sm">
            <th scope="col">No</th>
            <th scope="col">Kd Service</th>
            <th scope="col">Tipe Mobil</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">Status Service</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($data_service as $ds) :
        ?>
            <tr class="text-center" id="tr-data-spk">
                <th><?= $no++; ?></th>
                <td><?= $ds['kd_service']; ?></td>
                <td><?= $ds['tipe_mobil']; ?></td>
                <td><?= $ds['nama_pelanggan']; ?></td>
                <td>
                    <?php
                    $this->db->select('tb_status_service.*');
                    $this->db->where('id', $ds['id_status']);
                    $result = $this->db->get('tb_status_service')->row_array();
                    if ($result['kd_status'] == 0) :
                    ?>
                        <div class="form-group">
                            <select class="form-control bg-danger status-service" data-id="<?= $ds['id_service']; ?>" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($ds['id_status'] == $status['id']) : ?>
                                        <option value="<?= $status['id'] ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id'] ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php elseif ($result['kd_status'] == 1) : ?>
                        <div class="form-group">
                            <select class="form-control bg-success status-service" data-id="<?= $ds['id_service']; ?>" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($ds['id_status'] == $status['id']) : ?>
                                        <option value="<?= $status['id'] ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id'] ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <select class="form-control bg-warning status-service" data-id="<?= $ds['id_service']; ?>" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($ds['id_status'] == $status['id']) : ?>
                                        <option value="<?= $status['id'] ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id'] ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item detail-service" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" href="#"><i class="fas fa-info-circle"></i> Detail Service</a>
                            <a class="dropdown-item delete-spk" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" data-idmobil="<?= $ds['id_mobil']; ?>" href="#"><i class="fas fa-trash"></i> Hapus Service</a>
                            <a class="dropdown-item update-spk" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" href="#"><i class="fas fa-edit"></i> Edit Service</a>
                            <a class="dropdown-item cetak-spk" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" href="#"><i class="fas fa-print"></i> Cetak SPK</a>
                            <?php if ($ds['id_status'] == 2) : ?>
                                <a class="dropdown-item cetak-invoice" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" data-status="<?= $ds["id_status"]; ?>" href="#"><i class="fas fa-print"></i> Cetak Invoice</a>
                            <?php else : ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tab1').DataTable();
        // $('.js-example-basic-single').select2();

    });

    // ubah status service
    $(".status-service").change(function() {
        switch ($(this).val()) {
            case "1":
                // $(".cetak-invoice").css("display", "none");
                // $(this).removeClass("bg-warning").removeClass("bg-success").addClass("bg-danger");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("id"),
                        status: $(this).val()
                    },
                    success: function(data) {
                        $.ajax({
                            url: "<?= base_url(); ?>service/loadTableDataSpk",
                            type: "get",
                            beforeSend: function() {
                                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                            },
                            success: function(data) {
                                setTimeout(function() {
                                    $(".view-table-cetak-spk").html(data);
                                }, 500);
                            }
                        });
                    }
                });
                break;
            case "2":
                // $(this).removeClass("bg-warning").removeClass("bg-danger").addClass("bg-success");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("id"),
                        status: $(this).val()
                    },
                    success: function(data) {
                        $.ajax({
                            url: "<?= base_url(); ?>service/loadTableDataSpk",
                            type: "get",
                            beforeSend: function() {
                                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                            },
                            success: function(data) {
                                setTimeout(function() {
                                    $(".view-table-cetak-spk").html(data);
                                }, 500);
                            }
                        });
                    }
                });
                break;
            case "3":
                // $(".cetak-invoice").css("display", "none");
                // $(this).removeClass("bg-danger").removeClass("bg-success").addClass("bg-warning");
                $.ajax({
                    url: "<?= base_url(); ?>service/status_service",
                    type: "post",
                    data: {
                        id_service: $(this).data("id"),
                        status: $(this).val()
                    },
                    success: function(data) {
                        $.ajax({
                            url: "<?= base_url(); ?>service/loadTableDataSpk",
                            type: "get",
                            beforeSend: function() {
                                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                            },
                            success: function(data) {
                                setTimeout(function() {
                                    $(".view-table-cetak-spk").html(data);
                                }, 500);
                            }
                        });
                    }
                });
                break;
            default:
                break;
        }
    });


    $(".detail-service").click(function(e) {
        const id_service = $(this).data("idservice");
        const id_pelanggan = $(this).data("idpelanggan");
        $.ajax({
            url: "<?= base_url(); ?>service/detail_service",
            type: "get",
            data: {
                id_service: id_service,
                id_pelanggan: id_pelanggan
            },
            beforeSend: function() {
                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".view-table-cetak-spk").html(data);
                }, 500);
            }
        });
        e.preventDefault();
    });

    $(".delete-spk").click(function(e) {
        $(this).closest('#tr-data-spk').addClass('hapus-data-spk');
        const id_service = $(this).data("idservice");
        const id_pelanggan = $(this).data("idpelanggan");
        const id_mobil = $(this).data("idmobil");
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
                    url: "<?= base_url(); ?>service/delete_data_spk",
                    type: "post",
                    data: {
                        id_service: id_service,
                        id_pelanggan: id_pelanggan,
                        id_mobil: id_mobil
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $('.hapus-data-spk').fadeOut(1500);
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: 'Data gagal dihapus',
                                position: 'topRight'
                            });
                        }
                    }
                });
            }
        })
        e.preventDefault();
    });

    $(".update-spk").click(function(e) {
        const id_service = $(this).data("idservice");
        const id_pelanggan = $(this).data("idpelanggan");
        // console.log(id_service + " " + id_pelanggan);
        $.ajax({
            url: "<?= base_url(); ?>service/update_data_spk",
            type: "get",
            data: {
                id_service: id_service,
                id_pelanggan: id_pelanggan
            },
            beforeSend: function() {
                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".view-table-cetak-spk").html(data);
                }, 500);
            }
        });
        e.preventDefault();
    });

    $(".cetak-spk").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/cetak_spk",
            type: "get",
            data: {
                id_service: $(this).data("idservice"),
                id_pelanggan: $(this).data("idpelanggan")
            },
            beforeSend: function() {
                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".view-table-cetak-spk").html(data);
                }, 500);
            }
        });
        e.preventDefault();
    });

    $(".cetak-invoice").click(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/cetak_invoice",
            type: "get",
            data : {
                id_service : $(this).data("idservice"),
                id_pelanggan : $(this).data("idpelanggan")
            },
            beforeSend: function() {
                $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".view-table-cetak-spk").html(data);
                }, 500);
            }
        });
        e.preventDefault();
    });
</script>