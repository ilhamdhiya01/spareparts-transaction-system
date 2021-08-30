<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row" style="display: block;">
                <div class="col-md-6 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="form-title">Tambah Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <?= $this->session->flashdata('flash'); ?>
                        <div class="x_content">
                            <form action="<?= base_url(); ?>menu/tambah_userMenu" id="form" method="post">
                                <input type="hidden" class="form-control" value="" name="id-menu" id="id-menu">
                                <div class="form-group">
                                    <label id="label-nama-menu">Nama Menu</label>
                                    <input type="text" class="form-control" value="" name="nama-menu" id="nama-menu">
                                    <?= form_error('nama-menu', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12   offset-md-10">
                                        <!-- <button type="reset" class="btn btn-primary btn-sm">Reset</button> -->
                                        <button type="submit" class="btn btn-primary btn-sm ml-1" id="btn-menu">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($user_menu as $menu) :
                                    ?>
                                        <tr>
                                            <th scope="row" id="no"><?= $no++; ?></th>
                                            <td><?= $menu['nama_menu']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>menu/delete_userMenu/<?= $menu['id']; ?>" onclick="return confirm('Hapus data ini ?');" class="badge badge-danger">Delete</a>
                                                <a href="<?= base_url(); ?>menu/update_userMenu/<?= $menu['id']; ?>" data-id="<?= $menu['id']; ?>" class="badge badge-info update-menu">Update</a>
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
<script>
    $(function() {
        $(".update-menu").on('click', function(e) {
            $("#form-title").html("Ubah Menu");
            $("#btn-menu").html("Ubah");
            $("#form").attr("action", "<?= base_url(); ?>menu/ubah_userMenu");
            const id = $(this).data('id');
            $.ajax({
                url: "http://localhost/spareparts-transaction-system/menu/get_userMenuById",
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $("#id-menu").val(data.id);
                    $("#nama-menu").val(data.nama_menu);
                }
            });
            e.preventDefault();
        });
    });
</script>