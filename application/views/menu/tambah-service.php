<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <h3 class="card-title" id="card-title-add-service">
                    <i class="fas fa-edit"></i>
                    Tambah Data Pelanggan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tambah-data-pelanggan" data-toggle="pill" href="#tambah-data-pelanggan" role="tab" aria-controls="vert-tabs-home" aria-selected="true"></a>
                            <a class="nav-link" id="vert-tabs-tambah-data-mobil" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false"></a>
                            <a class="nav-link" id="vert-tabs-pilih-service" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"></a>
                            <a class="nav-link" id="vert-tabs-cetak-spk" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false"><i class="fas fa-print"></i> Cetak SPK</a>
                        </div>
                        <script>
                            // cek user membuka lewat hp atau desktop
                            $(document).ready(function() {
                                if (jQuery.browser.mobile) {
                                    $("#vert-tambah-data-pelanggan").html("<i class='fas fa-user-plus'></i>");
                                    $("#vert-tabs-tambah-data-mobil").html("<i class='fas fa-server'></i>");
                                    $("#vert-tabs-pilih-service").html("<i class='fas fa-tools'></i>");
                                    $("#vert-tabs-cetak-spk").html("<i class='fas fa-print'></i>");
                                } else {
                                    $("#vert-tambah-data-pelanggan").html("<i class='fas fa-user-plus'></i> Tambah Data Pelanggan");
                                    $("#vert-tabs-tambah-data-mobil").html("<i class='fas fa-server'></i> Tambah Data Mobil");
                                    $("#vert-tabs-pilih-service").html("<i class='fas fa-tools'></i> Pilih Jenis Service");
                                    $("#vert-tabs-cetak-spk").html("<i class='fas fa-print'></i> Cetak SPK");
                                }
                            });
                        </script>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="tambah-data-pelanggan" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-9">
                                        <div class="view-form-add-customer"></div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $("#vert-tambah-data-pelanggan").click(function() {
                                            $("#card-title-add-service").html("<i class='fas fa-edit'></i> Tambah Data Pelanggan")
                                        });
                                        $.ajax({
                                            url: "<?= base_url(); ?>service/loadFormAddCustomer",
                                            type: "get",
                                            beforeSend: function() {
                                                $(".view-form-add-customer").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                            },
                                            success: function(data) {
                                                setTimeout(function() {
                                                    $(".view-form-add-customer").html(data);
                                                }, 1000);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="view-form-add-mobil">
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#vert-tabs-tambah-data-mobil").click(function() {
                                        $("#card-title-add-service").html("<i class='fas fa-edit'></i> Tambah Data Mobil");
                                        $.ajax({
                                            url: "<?= base_url(); ?>service/loadFormDataMobil",
                                            type: "get",
                                            beforeSend: function() {
                                                $(".view-form-add-mobil").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                            },
                                            success: function(data) {
                                                setTimeout(function() {
                                                    $(".view-form-add-mobil").html(data);
                                                }, 1000);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="view-jenis-service">
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#vert-tabs-pilih-service").click(function() {
                                        $("#card-title-add-service").html("<i class='fas fa-edit'></i> Pilih jenis Service");
                                        $.ajax({
                                            url: "<?= base_url(); ?>service/loadBtnJenisService",
                                            type: "get",
                                            beforeSend: function() {
                                                $(".view-jenis-service").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                            },
                                            success: function(data) {
                                                setTimeout(function() {
                                                    $(".view-jenis-service").html(data);
                                                }, 1000);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
</section>