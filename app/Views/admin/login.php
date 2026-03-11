<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portfolio</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #030303;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 3rem;
            background: rgba(20, 20, 20, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            text-align: center;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .btn-login {
            width: 100%;
            padding: 1.2rem;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 1rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: transform 0.2s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: scale(1.02);
        }

        .alert {
            padding: 1rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="aurora">
        <div class="aurora-blob aurora-blob-1"></div>
        <div class="aurora-blob aurora-blob-2"></div>
    </div>

    <div class="login-card">
        <h1 class="login-title">Admin Access</h1>

        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <input type="text" name="username" placeholder="USERNAME" class="comment-input" required
                style="margin-bottom: 1rem;">
            <input type="password" name="password" placeholder="PASSWORD" class="comment-input" required
                style="margin-bottom: 1.5rem;">
            <button type="submit" class="btn-login">Login</button>
        </form>

        <a href="<?= base_url('/') ?>" class="btn-login"
            style="display: block; text-decoration: none; background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.1); margin-top: 1rem;">
            Back to Home
        </a>
    </div>
</body>

</html>