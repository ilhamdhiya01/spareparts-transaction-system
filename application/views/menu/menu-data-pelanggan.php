<style>
    .dropdown-item:hover {
        background-color: #F2F2F2;
    }
</style>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-table"></i> </h3>
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
                <button class="btn btn-primary mb-3 add-pelanggan" data-toggle="modal" data-target="#modal-pelanggan"><i class="fas fa-plus"></i> Tambah Pelanggan</button>
                <button class="btn btn-primary mb-3 ml-1 add-mobil" data-toggle="modal" data-target="#modal-pelanggan"><i class="fas fa-plus"></i> Tambah Mobil</button>
                <button class="btn btn-danger mb-3 ml-1 delete-all"><i class="fas fa-trash"></i> Hapus Semua</button>
                <div class="table-responsive view-data-pelanggan">

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="modal-pelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-pelanggan"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-pelanggan">

            </div>
        </div>
    </div>
</div>

<script>
    $.ajax({
        url: "http://localhost/spareparts-transaction-system/service/load_form_data_pelanggan",
        type: "get",
        success: function(data) {
            $(".modal-pelanggan").html(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
    $(".add-mobil").attr("style", "display:none");
    $(".add-pelanggan").click(function() {
        $.ajax({
            url: "http://localhost/spareparts-transaction-system/service/load_form_data_pelanggan",
            type: "get",
            success: function(data) {
                $(".modal-pelanggan").html(data);
                // readonly input mobil
                $("[name='jenis_mobil']").attr("readonly", "readonly");
                $("[name='tipe_mobil']").attr("readonly", "readonly");
                $("[name='merek_mobil']").attr("readonly", "readonly");
                $("[name='nomor_rangka']").attr("readonly", "readonly");
                $("[name='nomor_mesin']").attr("readonly", "readonly");
                $("[name='nomor_polisi']").attr("readonly", "readonly");
                $("[name='warna_mobil']").attr("readonly", "readonly");
                $("[name='tahun_mobil']").attr("readonly", "readonly");

                // tampilkan tombol tambah
                $(".proses-ubah-pelanggan").attr("style", "display:none;");
                $(".proses-tambah-mobil").attr("style", "display:none;");
                $(".proses-tambah-pelanggan").removeAttr("style");

                // ubah titel
                $("#modal-title-pelanggan").html("<i class='fas fa-user-plus'></i> Tambah Data Pelanggan")

                // hilangkan readonly
                $("#nik").removeAttr("readonly");

                // kosongkan form
                $("[name='id_pelanggan']").val("");
                $("[name='nama_pelanggan']").val("");
                $("[name='no_tlp']").val("");
                $("[name='nik']").val("");
                $("[name='alamat']").val("");
                $("[name='id_mobil']").val("");
                $("[name='jenis_mobil']").val("");
                $("[name='tipe_mobil']").val("");
                $("[name='merek_mobil']").val("");
                $("[name='nomor_rangka']").val("");
                $("[name='nomor_mesin']").val("");
                $("[name='nomor_polisi']").val("");
                $("[name='warna_mobil']").val("");
                $("[name='tahun_mobil']").val("");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    });

    $(".add-mobil").click(function() {
        $.ajax({
            url: "http://localhost/spareparts-transaction-system/service/load_form_data_pelanggan",
            type: "get",
            success: function(data) {
                $(".modal-pelanggan").html(data);

                // readonly input mobil
                $("[name='nama_pelanggan']").attr("readonly", "readonly");
                $("[name='no_tlp']").attr("readonly", "readonly");
                $("[name='nik']").attr("readonly", "readonly");
                $("[name='alamat']").attr("readonly", "readonly");

                // tampilkan tombol tambah
                $(".proses-ubah-pelanggan").attr("style", "display:none;");
                $(".proses-tambah-pelanggan").attr("style", "display:none;");
                $(".proses-tambah-mobil").removeAttr("style");

                // ubah titel
                $("#modal-title-pelanggan").html("<i class='fas fa-car'></i> Tambah Data Mobil")

                // hilangkan readonly
                $("#jenis_mobil").removeAttr("readonly");
                $("#tipe_mobil").removeAttr("readonly");
                $("#merek_mobil").removeAttr("readonly");
                $("#nomor_rangka").removeAttr("readonly");
                $("#nomor_mesin").removeAttr("readonly");
                $("#nomor_polisi").removeAttr("readonly");
                $("#warna_mobil").removeAttr("readonly");
                $("#tahun_mobil").removeAttr("readonly");

                // ambil data pelanggan terakhir di tambahkan
                $.ajax({
                    url: "<?= base_url(); ?>service/get_pelanggan_last_input",
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        $("#id_pelanggan_mobil").val(data.id);
                        $.ajax({
                            url: "<?= base_url(); ?>service/get_data_pelanggan_last_input",
                            type: "post",
                            data: {
                                id_pelanggan: $("#id_pelanggan_mobil").val()
                            },
                            dataType: "json",
                            success: function(data) {
                                $("[name='nama_pelanggan']").val(data.nama_pelanggan);
                                $("[name='no_tlp']").val(data.no_tlp);
                                $("[name='nik']").val(data.nik);
                                $("[name='alamat']").val(data.alamat);
                            }
                        });
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    });
</script>