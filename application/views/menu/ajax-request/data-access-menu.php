<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama User</th>
            <th scope="col">Posisi</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($access_menu as $am) :
        ?>
            <tr class="text-center">
                <th><?= $no++; ?></th>
                <td><?= $am['nama_pegawai']; ?></td>
                <td><?= $am['nama_posisi']; ?></td>
                <td>
                    <a href="" data-id="<?= $am['id']; ?>" class="badge badge-danger">Delete</a>
                    <a href="" data-id="<?= $am['id']; ?>" class="badge badge-info">Update</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>