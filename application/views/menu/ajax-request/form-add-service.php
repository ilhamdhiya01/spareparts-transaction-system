<form id="form_add_customer">
    <?php if (is_null(@$id_pelanggan['id'])) : ?>
        <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan">
    <?php else : ?>
        <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
    <?php endif; ?>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Kode Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?= $kd_service; ?>" name="nama_customer" id="nama_customer">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Jenis Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?= $nama_service; ?>" name="nama_customer" id="nama_customer">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <?php if ($nama_service == "Service Berkala") : ?>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label text-sm">Sub Service<span class="required text-danger pl-1">*</span></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" value="<?= $nama_sub_service; ?>" name="nama_customer" id="nama_customer">
                <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($nama_service == "Service Lain-lain") : ?>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label text-sm">Service Lain-lain<span class="required text-danger pl-1">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="alamat" name="alamat" row="3"></textarea>
                <div class="invalid-feedback alamat_customer_error">
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Tanggal Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" value="" name="no_tlp" id="no_tlp">
            <div id="validationServer03Feedback" class="invalid-feedback no_tlp_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Info Lain-lain<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <textarea class="form-control" id="alamat" name="alamat" row="3"></textarea>
            <div class="invalid-feedback alamat_customer_error">
            </div>
        </div>
    </div>
    <button type="submit" id="btn_add_customer" class="btn btn-sm btn-primary float-right">Simpan</button>
</form>
