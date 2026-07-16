<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - Sport Venue Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            background-color: #f6f9ff;
            color: #444444;
        }
        .logo span {
            font-size: 26px;
            font-weight: 700;
            color: #012970;
            font-family: "Nunito", sans-serif;
        }
        .card {
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }
    </style>
</head>
<body>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="#" class="logo d-flex align-items-center w-auto text-decoration-none">
                                <span class="d-none d-lg-block">SportVenue</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3 w-100">
                            <div class="card-body px-4 py-5">
                                <div class="pb-2 text-center">
                                    <h5 class="card-title text-center pb-0 fs-4 text-primary fw-bold" style="color: #012970 !important;">Login ke Akun Anda</h5>
                                    <p class="text-center small text-muted">Masukkan email & password untuk masuk</p>
                                </div>

                                <form class="row g-3" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary w-100 fw-bold" type="submit" style="background-color: #012970; border-color: #012970;">Masuk</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
