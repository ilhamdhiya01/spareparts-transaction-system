<div class="row">
    <div class="col-md-12 col-sm-12 back">
        <div class="x_panel">
            <div class="x_title">
                <h2>Service</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- <form class="form-horizontal form-label-left"> -->
                <!-- Smart Wizard -->
                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="#step-1">
                                <span class="step_no"><i class="far fa-address-card"></i></span>

                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no"><i class="fas fa-car-side"></i></span>

                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no"><i class="fas fa-tools"></i></span>

                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <span class="step_no"><i class="fas fa-file-alt"></i></span>

                            </a>
                        </li>
                    </ul>
                    <div id="step-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <form id="form_add_customer">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nama<span class="required text-danger pl-1">*</span></label>
                                                <input type="text" class="form-control" value="" name="nama_customer" id="nama_customer">
                                                <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">No Hp / WA<span class="required text-danger pl-1">*</span></label>
                                                <input type="text" class="form-control" value="" name="no_tlp" id="no_tlp">
                                                <div id="validationServer03Feedback" class="invalid-feedback no_tlp_customer_error">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">NIK<span class="required text-danger pl-1">*</span></label>
                                                <input type="text" class="form-control" name="nik" id="nik">
                                                <div id="validationServer03Feedback" class="invalid-feedback nik_customer_error">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationTextarea">Alamat<span class="required text-danger pl-1">*</span></label>
                                                <textarea class="form-control" id="alamat" name="alamat" row="3"></textarea>
                                                <div class="invalid-feedback alamat_customer_error">
                                                </div>
                                            </div>
                                            <button type="submit" id="btn_add_customer" class="btn btn-sm btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#form_add_customer").submit(function(e) {
                                const data = $(this).serialize();
                                // console.log(data);
                                $.ajax({
                                    url: "<?= base_url(); ?>service/add_service",
                                    type: "post",
                                    dataType: "json",
                                    data: data,
                                    success: function(data) {
                                        if (data.error) {
                                            if (data.error.nama_customer) {
                                                $("#nama_customer").addClass("is-invalid");
                                                $(".nama_customer_error").html(data.error.nama_customer);
                                            } else {
                                                $("#nama_customer").removeClass("is-invalid");
                                                $(".nama_customer_error").html("");
                                            }

                                            if (data.error.no_tlp) {
                                                $("#no_tlp").addClass("is-invalid");
                                                $(".no_tlp_customer_error").html(data.error.no_tlp);
                                            } else {
                                                $("#no_tlp").removeClass("is-invalid");
                                                $(".no_tlp_customer_error").html("");
                                            }

                                            if (data.error.nik) {
                                                $("#nik").addClass("is-invalid");
                                                $(".nik_customer_error").html(data.error.nik);
                                            } else {
                                                $("#nik").removeClass("is-invalid");
                                                $(".nik_error").html("");
                                            }

                                            if (data.error.alamat) {
                                                $("#alamat").addClass("is-invalid");
                                                $(".alamat_customer_error").html(data.error.alamat);
                                            } else {
                                                $("#alamat").removeClass("is-invalid");
                                                $(".alamat_customer_error").html("");
                                            }
                                        } else {
                                            $("#nama_customer").removeClass("is-invalid");
                                            $(".nama_customer_error").html("");
                                            $("#no_tlp").removeClass("is-invalid");
                                            $(".no_tlp_customer_error").html("");
                                            $("#nik").removeClass("is-invalid");
                                            $(".nik_error").html("");
                                            $("#alamat").removeClass("is-invalid");
                                            $(".alamat_customer_error").html("");
                                            $("#nama_customer").val("");
                                            $("#no_tlp").val("");
                                            $("#nik").val("");
                                            $("#alamat").val("");
                                            if (data.response == 201) {
                                                iziToast.success({
                                                    title: 'Success',
                                                    message: data.message,
                                                    position: 'topRight'
                                                });
                                            } else {
                                                iziToast.error({
                                                    title: 'Error',
                                                    message: 'Data gagal di tambhakna',
                                                    position: 'topRight'
                                                });
                                            }
                                        }
                                    }
                                });
                                e.preventDefault();
                            });
                        </script>
                    </div>
                    <div id="step-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-9">
                                        <form id="form_data_mobil">
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Jenis Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-car"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="jenis_mobil" name="jenis_mobil">
                                                        <div id="validationServer03Feedback" class="invalid-feedback jenis_mobil_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Tipe Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-car"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="tipe_mobil" name="tipe_mobil">
                                                        <div id="validationServer03Feedback" class="invalid-feedback tipe_mobil_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Merek Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-car"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="merek_mobil" name="merek_mobil">
                                                        <div id="validationServer03Feedback" class="invalid-feedback merek_mobil_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Nomor Rangka<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-sort-numeric-up"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="nomor_rangka" name="nomor_rangka">
                                                        <div id="validationServer03Feedback" class="invalid-feedback nomor_rangka_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Nomor Mesin<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-sort-numeric-up"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="nomor_mesin" name="nomor_mesin">
                                                        <div id="validationServer03Feedback" class="invalid-feedback nomor_mesin_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Nomor Polisi<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-sort-numeric-up"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="nomor_polisi" name="nomor_polisi">
                                                        <div id="validationServer03Feedback" class="invalid-feedback nomor_polisi_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Warna Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="fas fa-palette"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="warna_mobil" name="warna_mobil">
                                                        <div id="validationServer03Feedback" class="invalid-feedback warna_mobil_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="" for="inlineFormInputGroupUsername">Tahun Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text password1"><i class="far fa-calendar-alt"></i></div>
                                                        </div>
                                                        <input type="password" value="" class="form-control" id="tahun_mobil" name="tahun_mobil">
                                                        <div id="validationServer03Feedback" class="invalid-feedback tahun_mobil_error">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Tanggal Service<span class="required text-danger pl-1">*</span></label>
                                                    <input id="tanggal_service" name="tanggal_service" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                    <script>
                                                        function timeFunctionLong(input) {
                                                            setTimeout(function() {
                                                                input.type = 'text';
                                                            }, 60000);
                                                        }
                                                    </script>
                                                </div> -->
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </form>
                                        <script>
                                            $("#form_data_mobil").submit(function(e) {
                                                const data = $(this).serialize();
                                                $.ajax({
                                                    url: "<?= base_url(); ?>service/add_data_mobil",
                                                    type: "post",
                                                    data: data,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        if (data.error) {
                                                            if (data.error.jenis_mobil) {
                                                                $("#jenis_mobil").addClass("is-invalid");
                                                                $(".jenis_mobil_error").html(data.error.jenis_mobil);
                                                            } else {
                                                                $("#jenis_mobil").removeClass("is-invalid");
                                                                $(".jenis_mobil_error").html("");
                                                            }

                                                            if (data.error.tipe_mobil) {
                                                                $("#tipe_mobil").addClass("is-invalid");
                                                                $(".tipe_mobil_error").html(data.error.tipe_mobil);
                                                            } else {
                                                                $("#tipe_mobil").removeClass("is-invalid");
                                                                $(".tipe_mobil_error").html("");
                                                            }

                                                            if (data.error.merek_mobil) {
                                                                $("#merek_mobil").addClass("is-invalid");
                                                                $(".merek_mobil_error").html(data.error.merek_mobil);
                                                            } else {
                                                                $("#merek_mobil").removeClass("is-invalid");
                                                                $(".merek_mobil_error").html("");
                                                            }

                                                            if (data.error.nomor_rangka) {
                                                                $("#nomor_rangka").addClass("is-invalid");
                                                                $(".nomor_rangka_error").html(data.error.nomor_rangka);
                                                            } else {
                                                                $("#nomor_rangka").removeClass("is-invalid");
                                                                $(".nomor_rangka_error").html("");
                                                            }

                                                            if (data.error.nomor_mesin) {
                                                                $("#nomor_mesin").addClass("is-invalid");
                                                                $(".nomor_mesin_error").html(data.error.nomor_mesin);
                                                            } else {
                                                                $("#nomor_mesin").removeClass("is-invalid");
                                                                $(".nomor_mesin_error").html("");
                                                            }

                                                            if (data.error.nomor_polisi) {
                                                                $("#nomor_polisi").addClass("is-invalid");
                                                                $(".nomor_polisi_error").html(data.error.nomor_polisi);
                                                            } else {
                                                                $("#nomor_polisi").removeClass("is-invalid");
                                                                $(".nomor_polisi_error").html("");
                                                            }

                                                            if (data.error.warna_mobil) {
                                                                $("#warna_mobil").addClass("is-invalid");
                                                                $(".warna_mobil_error").html(data.error.warna_mobil);
                                                            } else {
                                                                $("#warna_mobil").removeClass("is-invalid");
                                                                $(".warna_mobil_error").html("");
                                                            }

                                                            if (data.error.tahun_mobil) {
                                                                $("#tahun_mobil").addClass("is-invalid");
                                                                $(".tahun_mobil_error").html(data.error.tahun_mobil);
                                                            } else {
                                                                $("#tahun_mobil").removeClass("is-invalid");
                                                                $(".tahun_mobil_error").html("");
                                                            }
                                                        } else {
                                                            // kosongkan value
                                                            $("#jenis_mobil").val("");
                                                            $("#tipe_mobil").val("");
                                                            $("#nomor_rangka").val("");
                                                            $("#nomor_mesin").val("");
                                                            $("#nomor_polisi").val("");
                                                            $("#merek_mobil").val("");
                                                            $("#warna_mobil").val("");
                                                            $("#tahun_mobil").val("");

                                                            // hilangkan error
                                                            $("#jenis_mobil").removeClass("is-invalid");
                                                            $(".jenis_mobil_error").html("");
                                                            $("#tipe_mobil").removeClass("is-invalid");
                                                            $(".tipe_mobil_error").html("");
                                                            $("#merek_mobil").removeClass("is-invalid");
                                                            $(".merek_mobil_error").html("");
                                                            $("#nomor_rangka").removeClass("is-invalid");
                                                            $(".nomor_rangka_error").html("");
                                                            $("#nomor_mesin").removeClass("is-invalid");
                                                            $(".nomor_mesin_error").html("");
                                                            $("#nomor_polisi").removeClass("is-invalid");
                                                            $(".nomor_polisi_error").html("");
                                                            $("#warna_mobil").removeClass("is-invalid");
                                                            $(".warna_mobil_error").html("");
                                                            $("#tahun_mobil").removeClass("is-invalid");
                                                            $(".tahun_mobil_error").html("");

                                                            // proses tambah
                                                            if (data.status == 201) {
                                                                iziToast.success({
                                                                    title: 'Success',
                                                                    message: data.message,
                                                                    position: 'topRight'
                                                                });
                                                            } else {
                                                                iziToast.error({
                                                                    title: 'Error',
                                                                    message: 'Data gagal di tambahakan',
                                                                    position: 'topRight'
                                                                });
                                                            }
                                                        }
                                                    }
                                                });
                                                e.preventDefault();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="step-3">
                        <h2 class="StepTitle">Step 3 Content</h2>
                        <p>
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div id="step-4">
                    </div>
                </div>
                <!-- End SmartWizard Content -->
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>