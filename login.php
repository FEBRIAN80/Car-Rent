

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Mobil</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #e0f2f7; /* Light blue background for a fresh feel */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            color: #333; /* Default text color */
        }

        /* Login Container */
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px; /* More rounded corners */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* More prominent shadow */
            width: 100%;
            max-width: 420px; /* Slightly wider */
            text-align: center;
            transition: all 0.3s ease-in-out; /* Smooth transitions */
        }

        /* Logo and Welcome Section */
        .logo-section {
            margin-bottom: 35px;
        }

        .company-logo {
            max-width: 160px; /* Slightly larger logo */
            height: auto;
            margin-bottom: 20px; /* More space below logo */
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.1)); /* Subtle shadow for the logo */
        }

        .logo-section h1 {
            font-size: 2.2em; /* Larger welcome text */
            color: #2c3e50; /* Darker, professional blue/grey */
            margin: 0;
            font-weight: 700; /* Bolder */
        }

        /* Form Styling */
        .login-form .form-group {
            margin-bottom: 25px; /* More space between form groups */
            text-align: left;
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600; /* Slightly bolder labels */
            color: #555;
            font-size: 0.95em;
        }

        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="email"] { /* Added email type for consistency if used in other forms */
            width: 100%;
            padding: 12px 15px; /* More padding */
            border: 1px solid #ced4da; /* Lighter border color */
            border-radius: 8px; /* More rounded input fields */
            font-size: 1.05em; /* Slightly larger text in inputs */
            box-sizing: border-box;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus,
        .login-form input[type="email"]:focus {
            border-color: #007bff; /* Highlight border on focus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Subtle glow on focus */
            outline: none; /* Remove default outline */
        }

        /* Button Styling */
        .login-button {
            width: 100%;
            padding: 14px; /* Larger button */
            background-color: #007bff; /* Primary blue */
            color: white;
            border: none;
            border-radius: 8px; /* More rounded button */
            font-size: 1.2em; /* Larger text */
            font-weight: 600; /* Bolder text */
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Add transform for subtle click effect */
            letter-spacing: 0.5px; /* Slight letter spacing */
        }

        .login-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-2px); /* Subtle lift on hover */
        }

        .login-button:active {
            transform: translateY(0); /* Return to original position on click */
        }

        /* Links and Messages */
        .signup-link, .forgot-password {
            margin-top: 20px;
            color: #777;
            font-size: 0.95em;
        }

        .signup-link a, .forgot-password a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover, .forgot-password a:hover {
            text-decoration: underline;
        }

        .message {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.95em;
            font-weight: 500;
            border: 1px solid transparent; /* Default transparent border */
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* Responsive Adjustments */
        @media (max-width: 600px) {
            body {
                padding: 15px; /* Less padding on smaller screens */
            }

            .login-container {
                padding: 30px 20px; /* Adjust padding for smaller screens */
                border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .logo-section h1 {
                font-size: 1.8em;
            }

            .company-logo {
                max-width: 130px;
            }

            .login-button {
                font-size: 1.1em;
                padding: 12px;
            }
        }

        @media (max-width: 400px) {
            .login-container {
                padding: 25px 15px;
            }
            .logo-section h1 {
                font-size: 1.6em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="assets/logo.png" alt="Logo Perusahaan Anda" class="company-logo">
            <h1>Selamat Datang Kembali!</h1>
        </div>

        <form class="login-form" action="login.php" method="POST">
            <?php if (!empty($message)): ?>
                <p class="message <?php echo (strpos($message, 'salah') !== false || strpos($message, 'kesalahan') !== false) ? 'error' : ''; ?>">
                    <?php echo $message; ?>
                </p>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Email atau Nomor Telepon</label>
                <input type="text" id="email" name="email_or_phone" placeholder="Masukkan email atau nomor telepon Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <p class="signup-link">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
            <p class="forgot-password"><a href="#">Lupa Password?</a></p>
        </form>
    </div>
</body>
</html>