<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>menu">Home</a></li>
                    <li class="breadcrumb-item active"><?= $judul; ?></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title" id="card-title-spareparts">
                    <i class="fas fa-edit"></i>
                    Tambah Data Pelanggan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-jenis-spareparts" data-toggle="pill" href="#jenis-spareparts" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><i class="fas fa-cogs"></i> Jenis Spareparts</a>
                            <a class="nav-link" id="vert-tabs-sub-spareparts" data-toggle="pill" href="#sub-spareparts" role="tab" aria-controls="vert-tabs-profile" aria-selected="false"><i class="fas fa-cogs"></i> Sub Spareparts</a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="jenis-spareparts" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class="view-form-add-customer">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-spareparts">

                                            </div>
                                            <script>
                                                $.ajax({
                                                    url: "<?= base_url(); ?>spareparts/load_form_spareparts",
                                                    type: "get",
                                                    success: function(data) {
                                                        $(".form-spareparts").html(data);
                                                    }
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="table-responsive table-jenis-spareparts">
                                            </div>
                                            <script>
                                                $.ajax({
                                                    url: "<?= base_url(); ?>spareparts/load_tb_spareparts",
                                                    type: "get",
                                                    success: function(data) {
                                                        $(".table-jenis-spareparts").html(data);
                                                    }
                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sub-spareparts" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                <div class="view-form-add-mobil">
                                    <h1>sub</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
</section>
