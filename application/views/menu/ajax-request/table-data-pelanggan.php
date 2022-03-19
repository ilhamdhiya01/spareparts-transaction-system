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
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="tr-spk" class="text-center">
        <?php
        $no = 1;
        foreach ($data_pelanggan as $pelanggan) :
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
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" kd="dropdownMenuOffset" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            <a class="dropdown-item hapus-data-pelanggan" data-idmobil="<?= $pelanggan['id_mobil']; ?>" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" href="#"><i class="fas fa-trash"></i> Hapus Data Service</a>
                            <a class="dropdown-item ubah-data-pelanggan" href="#" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" data-toggle="modal" data-target="#modal-data-pelanggan"><i class="fas fa-edit"></i> Ubah Data Pelanggan</a>
                            <a class="dropdown-item riwayat-service-pelanggan" href="#" data-idpelanggan="<?= $pelanggan['id_pelanggan'] ?>" data-idmobil="<?= $pelanggan['id_mobil']; ?>" data-idservice="<?= $pelanggan['id_service']; ?>" data-toggle="modal" data-target="#modal-data-pelanggan"><i class="fas fa-edit"></i> Data Service</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modal-data-pelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-data-pelanggan">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-service-body">

                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#spk').DataTable();
    });

    // $.ajax({
    //     url: "<?= base_url(); ?>service/loadPilihSpareparts",
    //     type: "get",
    //     data: {
    //         id_pelanggan: $(".ubah-data-pelanggan").data("idpelanggan")
    //     },
    //     success: function(data) {
    //         $(".view-data-spareparts").html(data);
    //     }
    // });

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

    $(".ubah-data-pelanggan").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/form_data_pelanggan",
            type: "get",
            data: {
                id_pelanggan: $(this).data("idpelanggan"),
            },
            success: (data) => {
                $(".modal-service-body").html(data);
            }
        })
    });


    $(".riwayat-service-pelanggan").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/riwayat_service",
            type: "get",
            data: {
                id_pelanggan: $(this).data("idpelanggan"),
                id_mobil: $(this).data("idmobil"),
                id_service: $(this).data("idservice")
            },
            success: (data) => {
                $(".modal-service-body").html(data);
            }
        })
    });
</script>