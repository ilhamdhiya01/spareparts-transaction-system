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
                    switch ($ds['status']) {
                        case 0: ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-sm btn-status">Belum Service</button>
                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-icon btn-color" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="0" class="dropdown-item belum-service" href="#">Belum Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="1" class="dropdown-item sudah-service" href="#">Sudah Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="2" class="dropdown-item pending" href="#">Pending</a>
                                </div>
                            </div>
                        <?php break;
                        case 1: ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm btn-status">Sudah Service</button>
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="0" class="dropdown-item belum-service" href="#">Belum Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="1" class="dropdown-item sudah-service" href="#">Sudah Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="2" class="dropdown-item pending" href="#">Pending</a>
                                </div>
                            </div>
                        <?php break;
                        case 2: ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning btn-sm btn-status">Pending</button>
                                <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="0" class="dropdown-item belum-service" href="#">Belum Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="1" class="dropdown-item sudah-service" href="#">Sudah Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="2" class="dropdown-item pending" href="#">Pending</a>
                                </div>
                            </div>
                        <?php break;
                        default:
                        ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">Status</button>
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="0" class="dropdown-item belum-service" href="#">Belum Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="1" class="dropdown-item sudah-service" href="#">Sudah Service</a>
                                    <a data-idservice="<?= $ds['id_service']; ?>" data-status="2" class="dropdown-item pending" href="#">Pending</a>
                                </div>
                            </div>
                    <?php
                            break;
                    }
                    ?>
                </td>
                <td>
                    <a href="" data-toggle="detail-spk" data-placement="top" title="Detail" class="detail-service" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>"><i class="fas fa-info-circle"></i></a>
                    <a href="" data-toggle="delete-spk" data-placement="top" title="Hapus" class="delete-spk" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>" data-idmobil="<?= $ds['id_mobil']; ?>"><i class="fas fa-trash"></i></a>
                    <a href="" data-toggle="edit-spk" data-placement="top" title="Edit" class="update-spk" data-idservice="<?= $ds['id_service']; ?>" data-idpelanggan="<?= $ds['id_pelanggan']; ?>"><i class="fas fa-edit"></i></a>
                    <a href="" data-toggle="cetak-spk" data-placement="top" title="Cetak" class=""><i class="fas fa-print"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tab1').DataTable();
    });



    // ubah status service
    $(".belum-service").click(function() {
        $(".btn-status").removeClass("btn-warning").addClass("btn-danger").html('Belum Service');
        $(".dropdown-icon").removeClass("btn-warning").addClass("btn-danger");
        const id_service = $(this).data("idservice");
        const status = $(this).data("status");
        console.log(status);
        $.ajax({
            url: "<?= base_url(); ?>service/status_belum_service",
            type: "post",
            dataType: "json",
            data: {
                id_service: id_service,
                status: status
            },
            success: function(data) {
                // window.location.reload(true);
                console.log(data.message);
            }
        });
    });

    $(".sudah-service").click(function() {
        const id_service = $(this).data("idservice");
        const status = $(this).data("status");
        console.log(status);
        // $.ajax({
        //     url : "<?= base_url(); ?>service/ubah_status_service",
        //     type : "post",
        //     dataType : "json",
        //     data : {
        //         id_service : id_service
        //     },
        //     success : function(data){

        //     }
        // });
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
</script>