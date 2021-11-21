<table class="table table-striped table-bordered table-sm" id="tab2">
    <thead>
        <tr class="text-center text-sm">
            <th scope="col">No</th>
            <th scope="col">Kode Sparepart</th>
            <th scope="col">Nama Spareparts</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($jenis_spareparts as $spareparts) :
        ?>
            <tr class="text-center text-sm">
                <th><?= $no++; ?></th>
                <td><?= $spareparts['kd_spareparts']; ?></td>
                <td><?= $spareparts['nama_spareparts']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>