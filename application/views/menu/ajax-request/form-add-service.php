<form id="form_add_customer">
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Kode Service<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" readonly  class="form-control" value="<?= $kd_service; ?>" name="nama_customer" id="nama_customer">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Nama<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="" name="nama_customer" id="nama_customer">
            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">No Hp / WA<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="" name="no_tlp" id="no_tlp">
            <div id="validationServer03Feedback" class="invalid-feedback no_tlp_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">NIK<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nik" id="nik">
            <div id="validationServer03Feedback" class="invalid-feedback nik_customer_error">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label text-sm">Alamat<span class="required text-danger pl-1">*</span></label>
        <div class="col-sm-10">
            <textarea class="form-control" id="alamat" name="alamat" row="3"></textarea>
            <div class="invalid-feedback alamat_customer_error">
            </div>
        </div>
    </div>
    <button type="submit" id="btn_add_customer" class="btn btn-sm btn-primary float-right">Simpan</button>
</form>