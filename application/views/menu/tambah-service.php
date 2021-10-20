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
                                <span class="step_descr">
                                    Step 1<br />
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no"><i class="fas fa-car-side"></i></span>
                                <span class="step_descr">
                                    Step 2<br />
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no"><i class="fas fa-tools"></i></span>
                                <span class="step_descr">
                                    Step 3<br />
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <span class="step_no"><i class="fas fa-file-alt"></i></span>
                                <span class="step_descr">
                                    Step 4<br />
                                </span>
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
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Jenis Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <select class="select2_single form-control" tabindex="-1">
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="AK">Alaska</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Tipe Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <select class="select2_single form-control" tabindex="-1">
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Merek Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Nomor Rangka<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Nomor Mesin<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Nomor Mesin<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Nomor Mesin<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Warna Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Tahun Mobil<span class="required text-danger pl-1">*</span></label>
                                                    <input type="text" class="form-control" id="inputAddress">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Tanggal Service<span class="required text-danger pl-1">*</span></label>
                                                    <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                    <script>
                                                        function timeFunctionLong(input) {
                                                            setTimeout(function() {
                                                                input.type = 'text';
                                                            }, 60000);
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                            <!-- <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                                                </label>

                                            </div> -->
                                            <!-- <div class="form-group">
                                                <label for="inputAddress">Nomor Rangka</label>
                                                <input type="text" class="form-control" id="inputAddress">
                                            </div> -->
                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                        </form>
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