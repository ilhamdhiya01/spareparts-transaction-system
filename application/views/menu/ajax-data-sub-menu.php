<?php
$no = 1;
foreach ($sub_menu as $sub_menu) :
?>
    <tr id="tr">
        <td class="text-center"><?= $no++; ?></td>
        <td><?= $sub_menu['nama_menu']; ?></td>
        <td><?= $sub_menu['sub_menu']; ?></td>
        <td><?= $sub_menu['url']; ?></td>
        <td><?= $sub_menu['icon']; ?></td>
        <td class="text-center">
            <?php
            switch ($sub_menu['is_active']) {
                case 1:
                    echo '<span class="badge badge badge-success">Aktif</span>';
                    break;
                case 0:
                    echo '<span class="badge badge badge-danger">Tidak Aktif</span>';
                    break;
                default:
                    'tidak ada';
            }
            ?>
        </td>
        <td class="text-center">
            <a href="" data-id="<?= $sub_menu['id']; ?>" class="badge badge-danger delete-sub-menu">Delete</a>
            <a href="" data-toggle="modal" data-id="<?= $sub_menu['id']; ?>" data-target="#tambah-sub-menu" class="badge badge-info update-sub-menu">Update</a>
        </td>
    </tr>
<?php endforeach; ?>