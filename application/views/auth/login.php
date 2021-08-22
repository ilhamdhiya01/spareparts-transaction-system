<div id="app">
    <section class="section">
        <div class="container mt-2">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6  offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?= base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header auth-header">
                            <h4>Login</h4>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url(); ?>auth">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" tabindex="1" >
                                    <?= form_error('username', '<small class="text-danger text-error">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>
                                    <div class="form-input">
                                        <input id="password" type="password" class="form-control" name="password" >
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger text-error">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('.fa-eye-slash').click(function(){
        let input = $('#password').attr('type');
        if(input == 'password'){
            $('#password').attr('type','text');
            $('.fa-eye-slash').attr('class','fas fa-eye');
        } else {
            $('#password').attr('type','password');
            $('.fa-eye').attr('class','fas fa-eye-slash');
        }
    })
</script>