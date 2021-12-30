<!-- <div class="row" style="display: block;">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2 id="form-title"><i class="fas fa-table"></i> Tabel Sub Menu</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fas fa-times"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

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
        <div class="btn-sub-menu">
            <ul>
                <li><a href="" data-toggle="modal" data-target="#tambah-sub-menu" class="btn btn-primary btn-sm" id="modal-tambah-sub-menu"><i class="fa fa-plus-square"></i> Tambah Sub Menu</a></li>
                <li><a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a></li>
                <li><a href="<?= base_url(); ?>menu/dropdown_subMenu" class="btn btn-light btn-sm"><i class="fa fa-refresh"></i></a></li>
            </ul>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" id="form-title"><i class="fas fa-table"></i></h3>
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
                <div class="table-responsive" id="view-sub-menu">

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="tambah-sub-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-sub-menu-title">Tambah Sub Menu</h5>
                <button type="button" class="close" style="outline:none;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body view-form-sub-menu">

            </div>
        </div>
    </div>
</div>