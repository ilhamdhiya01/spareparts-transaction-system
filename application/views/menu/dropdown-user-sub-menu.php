<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row" style="display: block;">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="form-title">Tabel Sub Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="btn-sub-menu">
                            <ul>
                                <li><a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Sub Menu</a></li>
                                <li><a href="" class="btn btn-info btn-sm"><i class="fa fa-plus-square"></i> Tambah Dropdown Menu</a></li>
                                <li><a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a></li>
                            </ul>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>User Menu</th>
                                                    <th>Sub Menu</th>
                                                    <th>Url</th>
                                                    <th>Icon</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($subMenu as $sub_menu) :
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++; ?></td>
                                                        <td><?= $sub_menu['nama_menu']; ?></td>
                                                        <td><?= $sub_menu['sub_menu']; ?></td>
                                                        <td><?= $sub_menu['url']; ?></td>
                                                        <td><?= $sub_menu['icon']; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($sub_menu['is_active'] == 1) : ?>
                                                                <span class="badge badge badge-success">Aktif</span>
                                                            <?php else : ?>
                                                                <span class="badge badge badge-danger">Tidak Aktif</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" data-id="<?= $sub_menu['id']; ?>" class="badge badge-danger delete-sub-menu">Delete</a>
                                                            <a href="" class="badge badge-info update-menu">Update</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete-sub-menu').click(function(e) {
        let id = $(this).data('id');
        swal({
                title: 'Hapus data ini ?',
                text: 'Data yang terhapus tidak akan kembali !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url(); ?>menu/delete_subMenu',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.response == 'success') {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight'
                                });
                                setTimeout(() => {
                                    document.location.href = '<?= base_url(); ?>menu/dropdown_subMenu';
                                }, 2000)
                            } else {
                                iziToast.warning({
                                    title: 'Failed',
                                    message: data.message,
                                    position: 'topRight'
                                });
                            }
                        }
                    })
                } else {
                    swal('Membatalkan penghapusan data');
                }
            });
        e.preventDefault();
    })
</script>