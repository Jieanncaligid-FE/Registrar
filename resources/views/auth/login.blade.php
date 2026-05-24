<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Registrar System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(180deg, #f8fbff 0%, #fff5f0 100%);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #25314d;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e7ecf5;
            border-radius: 28px;
            box-shadow: 0 20px 50px rgba(74, 98, 147, 0.08);
            overflow: hidden;
        }

        .card-body {
            padding: 3rem 2.5rem;
        }

        .form-control,
        .form-control:focus {
            background: #fbfdff;
            border-color: #e7ecf5;
            color: #25314d;
            border-radius: 14px;
            box-shadow: none;
        }

        .form-label {
            color: #67728c;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #8faee6;
            border-color: #8faee6;
            color: #fff;
            border-radius: 999px;
            font-weight: 600;
        }

        .alert {
            background: #fff5f2;
            border-color: #f8d3c4;
            color: #7c4f3b;
        }

        .page-title {
            color: #25314d;
        }

        .text-muted {
            color: #67728c !important;
        }
    </style>
</head>
<body>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm w-100" style="max-width: 420px;">
        <div class="card-body p-5">
            <h2 class="card-title mb-3" style="color: #f7e28f;">Registrar Login</h2>
            <p class="text-muted mb-4">Sign in to manage sections, students, grades, and ranking.</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
