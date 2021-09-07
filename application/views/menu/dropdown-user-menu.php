<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row" style="display: block;">
                <div class="col-md-6 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="form-title-menu">Tambah Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content view-form-user-menu">
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
                            <table class="table table-striped table-bordered text-center view-user-menu">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        readUserMenu();
        readFormUserMenu();
    });

    function readUserMenu() {
        $.ajax({
            url: "<?= base_url(); ?>menu/ambilDataUserMenu",
            type: "get",
            success: function(data) {
                $(".view-user-menu").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function readFormUserMenu() {
        $.ajax({
            url: "<?= base_url(); ?>menu/formUserMenu",
            type: "get",
            success: function(data) {
                $(".view-form-user-menu").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    // $(function() {
    //     $(".update-menu").on('click', function(e) {
    //         $("#form-title").html("Ubah Menu");
    //         $("#btn-menu").html("Ubah");
    //         $("#form").attr("action", "<?= base_url(); ?>menu/ubah_userMenu");
    //         const id = $(this).data('id');
    //         $.ajax({
    //             url: "http://localhost/spareparts-transaction-system/menu/get_userMenuById",
    //             data: {
    //                 id: id
    //             },
    //             type: 'post',
    //             dataType: 'json',
    //             success: function(data) {
    //                 $("#id-menu").val(data.id);
    //                 $("#nama-menu").val(data.nama_menu);
    //             }
    //         });
    //         e.preventDefault();
    //     });
    // });
</script>