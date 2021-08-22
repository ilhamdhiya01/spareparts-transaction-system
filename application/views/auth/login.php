<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-dark">
    <div class="p-4 m-3">
        <img src="<?= base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
        <h4 class="text-white font-weight-normal">Welcome to <span class="font-weight-bold">Stisla</span></h4>
        <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>
        <form method="POST" action="#" class="needs-validation" novalidate="">
            <div class="form-group">
                <label for="email" class="text-white">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Please fill in your email
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label text-white">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>