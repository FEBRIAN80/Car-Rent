
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna - Rental Mobil</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .register-container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 450px; text-align: center; }
        h2 { color: #333; margin-bottom: 25px; }
        .form-group { margin-bottom: 18px; text-align: left; }
        label { display: block; margin-bottom: 7px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="password"] { width: calc(100% - 20px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 1.1em; cursor: pointer; transition: background-color 0.3s ease; margin-top: 10px;}
        button:hover { background-color: #218838; }
        .message { margin-top: 20px; padding: 10px; border-radius: 5px; }
        .message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .login-link { margin-top: 15px; font-size: 0.9em; color: #777; }
        .login-link a { color: #007bff; text-decoration: none; font-weight: bold; }

        /* Responsivitas untuk layar yang lebih kecil */
        @media (max-width: 600px) {
            .register-container {
                padding: 20px;
                margin: 0 15px; /* Sedikit margin samping pada mobile */
            }
            h2 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun Baru</h2>
        <?php if (isset($message)): ?>
            <p class="message <?php echo (strpos($message, 'berhasil') !== false) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <p class="login-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>