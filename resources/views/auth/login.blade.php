<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prahari | Admin Login</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .form-control {
            padding: 0.7rem 1rem;
            border-radius: 8px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #1a202c;
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #1a202c;
            border-color: #1a202c;
            border-radius: 8px;
            padding: 0.7rem 1rem;
        }
        .btn-primary:hover {
            background-color: #2d3748;
            border-color: #2d3748;
        }
        .text-primary-dark {
            color: #1a202c;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5 col-xl-4">
                
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-shield-check fs-1 text-primary-dark"></i>
                    </div>
                    <h3 class="fw-bold text-primary-dark mb-1">Prahari Admin</h3>
                    <p class="text-muted small">Enter your credentials to access the portal</p>
                </div>
                
                <div class="card login-card bg-white">
                    <div class="card-body p-4 p-md-5">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-3 py-2 px-3 mb-4">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li class="small fw-medium">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm rounded-3 py-2 px-3 mb-4 small fw-medium">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('loginCode') }}" method="GET">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-dark small">Email Address</label>
                                <div class="position-relative">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label fw-semibold text-dark small mb-0">Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input shadow-none" id="remember" name="remember_me" value="1">
                                <label class="form-check-label text-muted small fw-medium" for="remember" style="cursor: pointer;">Keep me signed in</label>
                            </div>

                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary fw-semibold shadow-sm">Sign In <i class="bi bi-arrow-right ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted small">&copy; {{ date('Y') }} Prahari Management System.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
