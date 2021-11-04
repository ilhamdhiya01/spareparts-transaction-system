<table class="table table-striped table-bordered" id="tab1">
    <thead>
        <tr class="text-sm text-center">
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
            <tr class="text-center">
                <th><?= $no++; ?></th>
                <td><?= $ds['kd_service']; ?></td>
                <td><?= $ds['tipe_mobil']; ?></td>
                <td><?= $ds['nama_pelanggan']; ?></td>
                <td>
                    <?php
                    switch ($ds['status']) {
                        case 0:
                            echo '<span class="badge badge-danger">Belum service</span>';
                            break;
                        case 1:
                            echo '<span class="badge badge-success">Sudah service</span>';
                            break;
                        case 2:
                            echo '<span class="badge badge-warning">Pending</span>';
                            break;
                        default:
                            break;
                    }
                    ?>
                </td>
                <td>
                    <a href=""><i class="fas fa-info-circle"></i></a>
                    <a href=""><i class="fas fa-trash"></i></a>
                    <a href=""><i class="fas fa-edit"></i></a>
                    <a href=""><i class="fas fa-print"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tab1').DataTable();
    });
</script>