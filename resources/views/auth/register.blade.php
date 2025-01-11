<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/bootstrap-5/css/bootstrap.min.css') }}">
</head>
<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    <img src="{{ asset('assets/logo-images/logo_magangku_seme8.png') }}" alt="logo" width="150">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                        <form method="POST" class="needs-validation" action="{{ route('register') }}" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">Nama lengkap:</label>
                                <input id="name" type="text" class="form-control" name="name" required>
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nrp">NRP:</label>
                                <input id="nrp" type="text" class="form-control" name="nrp" required>
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first('nrp') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required="">
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password Confirmation</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password_confirmation" required="">
                                <div class="invalid-feedback" style="display: block;">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Already have an account? <a href="{{ route('login') }}" class="text-dark">Login</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright © {{ date('Y') }} Magangku
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="{{ asset('assets/adminlte/plugins/bootstrap-5/js/bootstrap.min.js') }}"></script>
</body>
</html>
