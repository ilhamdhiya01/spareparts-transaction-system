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
                                <li><a href="" data-toggle="modal" data-target="#tambah-sub-menu" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Sub Menu</a></li>
                                <li><a href="" class="btn btn-info btn-sm"><i class="fa fa-plus-square"></i> Tambah Dropdown Menu</a></li>
                                <li><a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a></li>
                            </ul>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" id="view-data">
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
                                            <tbody id="tbody">
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
<!-- Modal -->
<div class="modal fade" id="tambah-sub-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Tambah Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-sub-menu">
                    <input type="hidden" name="id" value="" id="id-sub-menu">
                    <div class="form-group">
                        <label class="control-label ">Pilih Menu<span class="required text-danger pl-1">*</span></label>
                        <select class="form-control" name="user-menu" id="user-menu">
                            <option>-- Pilih --</option>
                            <?php foreach ($user_menu as $menu) : ?>
                                <option value="<?= $menu['id']; ?>"><?= $menu['nama_menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Sub Menu<span class="required text-danger pl-1">*</span></label>
                        <input type="text" class="form-control" name="sub_menu" id="sub_menu">
                    </div>
                    <div class="form-group">
                        <label for="">Url<span class="required text-danger pl-1">*</span></label>
                        <input type="text" class="form-control" name="url" id="url">
                    </div>
                    <div class="form-group">
                        <label for="">Icon<span class="required text-danger pl-1">*</span></label>
                        <input type="text" class="form-control" name="icon" id="icon">
                    </div>
                    <div class="form-group">
                        <label for="">Aktivasi Menu<span class="required text-danger pl-1">*</span></label><br>
                        <label>
                            <input type="checkbox" class="js-switch aktivasi-menu" value="" name="is_active">
                        </label>
                        <label id="status">Tidak Aktif</label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm tambah-sub-menu">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // data table serverside
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url(); ?>menu/ambilDataSubMenu",
            type : "get",
            success: function(data) {
                $("#tbody").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
    // delete sub menu
    $('.delete-sub-menu').click(function(e) {
        $(this).closest('#tr').addClass('hapus-sub-menu');
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
                        method: 'post',
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
                                $('.hapus-sub-menu').fadeOut(1500);
                                // setTimeout(() => {
                                //     document.location.href = '<?= base_url(); ?>menu/dropdown_subMenu';
                                // }, 2000)
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
    });


    // tambah sub menu
    $('.tambah-sub-menu').on('click', function(e) {
        $('.modal-title').html('Tambah Sub Menu');
        $('.tambah-sub-menu').html('Tambah');
        let data = $('.form-sub-menu').serialize();
        $.ajax({
            url: '<?= base_url(); ?>menu/tambah_subMenu',
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(data) {
                if (data.response == 'success') {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    $('#tambah-sub-menu').modal('hide');
                    setTimeout(() => {
                        document.location.href = '<?= base_url(); ?>menu/dropdown_subMenu';
                    }, 2000)
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            }
        });
        e.preventDefault();
    });

    // // ubah sub menu
    // $('.update-sub-menu').click(function(e){
    //     let id = $(this).data('id');
    //     $('.modal-title').html('Ubah Sub Menu');
    //     $('.tambah-sub-menu').html('Ubah');
    //     $.ajax({
    //         url : '<?= base_url(); ?>menu/get_subMenuById',
    //         type : 'post',
    //         dataType : 'json',
    //         data : {
    //             id : id
    //         },
    //         success : function(data){
    //             $('#id-sub-menu').val(data.id);
    //             $('#sub_menu').val(data.sub_menu);
    //             $('#url').val(data.url);
    //             $('#icon').val(data.icon);
    //             if(data.is_active == 1){
    //                 $('.aktivasi-menu').prop('checked');
    //             }
    //         }
    //     });
    //     e.preventDefault();
    // });

    $('.aktivasi-menu').click(function() {
        if ($(this).is(':checked')) {
            $('#status').html('Aktif');
            $(this).attr('value', 1);
        } else if ($(this).is(':unchecked')) {
            $('#status').html('Tidak Aktif');
            $(this).attr('value', 0);
        }
    })
</script>