<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f4f7ff 0%, #eef3ff 45%, #ffffff 100%);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(65, 105, 225, 0.14);
        }

        .login-header {
            background: #4169E1;
            color: #fff;
            padding: 26px 28px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 1.55rem;
            font-weight: 700;
            margin: 0;
        }

        .login-header p {
            margin: 7px 0 0;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .login-card .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 52px;
            border-radius: 12px;
            font-size: 1rem;
            padding: 12px 14px;
        }

        .form-control:focus {
            border-color: #4169E1;
            box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.15);
        }

        .btn-login {
            min-height: 52px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            background: #4169E1;
            border-color: #4169E1;
        }

        .btn-login:hover,
        .btn-login:focus {
            background: #3157c8;
            border-color: #3157c8;
        }

        @media (max-width: 576px) {
            .login-wrapper {
                align-items: center;
                padding: 16px;
            }

            .login-card {
                max-width: none;
                border-radius: 18px;
            }

            .login-header {
                padding: 24px 20px;
            }

            .login-header h1 {
                font-size: 1.4rem;
            }

            .login-card .card-body {
                padding: 24px 20px;
            }

            .form-control,
            .btn-login {
                min-height: 54px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="card login-card">
            <div class="login-header">
                <h1>Login Sistem</h1>
                <p>Silakan masuk ke panel administrasi</p>
            </div>

            <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            class="form-control"
                            value="<?php echo e(old('username')); ?>"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary btn-login w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\e-surat-fuspi-laravel10\resources\views/auth/login.blade.php ENDPATH**/ ?>