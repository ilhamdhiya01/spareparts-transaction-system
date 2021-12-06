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
            <th scope="col">Kd_service</th>
            <th scope="col">Nama Pelanggan</th>
            <th scope="col">Tipe Mobil</th>
            <th scope="col">Tgl Service</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="tr-spk" class="text-center">
        <?php
        $no = 1;
        foreach ($data_service as $service) :
        ?>
            <tr class="text-sm">
                <td><?= $no++; ?></td>
                <td><?= $service['kd_service']; ?></td>
                <td><?= $service['nama_pelanggan']; ?></td>
                <td><?= $service['tipe_mobil']; ?></td>
                <td><?= $service['tgl_service'] ?></td>
                <td>
                    <div class="form-group">
                        <?php if ($service['id_status'] == 1) : ?>
                            <select class="form-control text-sm change-status" data-idservice="<?= $service['id_service']; ?>" style="outline:none; outline:2px solid #C83934;" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($status['id'] == $service['id_status']) : ?>
                                        <option value="<?= $status['id']; ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id']; ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ($service['id_status'] == 2) : ?>
                            <select class="form-control text-sm change-status" data-idservice="<?= $service['id_service']; ?>" style="outline:none; outline:2px solid #3F8839;" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($status['id'] == $service['id_status']) : ?>
                                        <option value="<?= $status['id']; ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id']; ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        <?php else : ?>
                            <select class="form-control text-sm change-status" data-idservice="<?= $service['id_service']; ?>" style="outline:none; outline:2px solid #DFA92C;" id="exampleFormControlSelect1">
                                <?php foreach ($status_service as $status) : ?>
                                    <?php if ($status['id'] == $service['id_status']) : ?>
                                        <option value="<?= $status['id']; ?>" selected><?= $status['status_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $status['id']; ?>"><?= $status['status_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Pilih Aksi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Hapus Data Service</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Ubah Data Service</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Cetak SPK</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Cetak Invoice</a>
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