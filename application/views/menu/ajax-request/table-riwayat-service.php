<div class="info d-flex justify-content-between mb-3">
    <h5 class="font-weight-bold">Tgl service : <?= $jenis_service['tgl_service'] ?></h5>
    <h5 class="font-weight-bold">Jenis service : <?= $jenis_service['jenis_service'] ?></h5>
</div>
<table class="table table-striped table-sm">
    <thead>
        <tr class="text-center">
            <th>Qty</th>
            <th>Spareparts</th>
            <th>Kode</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($latest_service as $latest) : ?>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center"><?= $latest['nama_spareparts']; ?></td>
                <td class="text-center"><?= $latest['kd_spareparts']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>