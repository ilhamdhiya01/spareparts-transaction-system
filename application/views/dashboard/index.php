<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul; ?></h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cogs"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Service</span>
                                        <?php
                                        $total_service = $this->db->get('tb_data_service')->result_array();
                                        $result = count($total_service);
                                        ?>
                                        <span class="info-box-number"><?= $result; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users-cog"></i></span>
                                    <?php
                                    $pengguna_sistem = $this->db->get('users')->result_array();
                                    $result = count($pengguna_sistem);
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pengguna Sistem</span>
                                        <span class="info-box-number"><?= $result; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix hidden-md-up"></div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tools"></i></span>
                                    <?php
                                    $service_hari_ini = $this->db->get_where('tb_data_service', ['tgl_service' => date('Y-m-d')])->result_array();
                                    $result = count($service_hari_ini);
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Service Hari Ini</span>
                                        <span class="info-box-number"><?= $result; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                                    <?php
                                    $total_pelanggan = $this->db->get('tb_pelanggan')->result_array();
                                    $result = count($total_pelanggan);
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pelanggan</span>
                                        <span class="info-box-number"><?= $result; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Default box -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">
                                Footer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>