<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form>
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-secondary" id="login">Masuk</button>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script>

    $("#login").click(function(e) {
        const username = $("#username").val();
        const password = $("#password").val();

        $.ajax({
            url: "<?= base_url(); ?>auth/login",
            type: "post",
            data: {
                username: username,
                password: password
            },
            dataType: "json",
            beforeSend: function() {
                $("#login").attr("disable", "disabled");
                $("#login").html("<i class='fa fa-spin fa-spinner'></i>");
            },
            complete: function() {
                $("#login").removeAttr("disable");
                $("#login").html("Masuk");
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.username) {
                        iziToast.error({
                            title: 'Login Failed',
                            message: data.error.username,
                            position: 'topRight'
                        });
                    }

                    if (data.error.password) {
                        iziToast.error({
                            title: 'Login Failed',
                            message: data.error.password,
                            position: 'topRight'
                        });
                    }
                } else {
                    if (data.response == 'username_null') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login failed !',
                            text: data.message
                        }).then(() => {
                            $("#username").val("");
                            $("#password").val("");
                        });
                    } else {
                        if (data.users.is_active == 1) {
                            if (data.cek_password) {
                                if (data.users.level_id == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login success',
                                        text: 'Selamat datang ' + data.users.nama_pegawai
                                    }).then(() => {
                                        document.location.href = "<?= base_url(); ?>menu"
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login success',
                                        text: 'Selamat datang ' + data.users.nama_pegawai
                                    }).then(() => {
                                        document.location.href = "<?= base_url(); ?>menu"
                                    });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login failed !',
                                    text: 'Password yang anda masukan salah'
                                }).then(() => {
                                    $("#password").val("");
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Login failed !',
                                text: 'Akun belum teraktivasi'
                            });
                        }
                    }
                }
            }
        });
        e.preventDefault();
    });
    // $('.fa-eye-slash').click(function() {
    //     let input = $('#password').attr('type');
    //     if (input == 'password') {
    //         $('#password').attr('type', 'text');
    //         $('.fa-eye-slash').attr('class', 'fas fa-eye');
    //     } else {
    //         $('#password').attr('type', 'password');
    //         $('.fa-eye').attr('class', 'fas fa-eye-slash');
    //     }
    // })
</script>