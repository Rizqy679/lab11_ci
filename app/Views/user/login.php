<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="<?= base_url('/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        #login-wrapper {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
            width: 350px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 8px;
            background: #555;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .alert {
            background: #f8d7da;
            padding: 10px;
            color: #721c24;
            border: 1px solid #f5c6cb;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div id="login-wrapper">
        <h1>Sign In</h1>
        <?php if(session()->getFlashdata('flash_msg')):?>
            <div class="alert"><?= session()->getFlashdata('flash_msg') ?></div>
        <?php endif;?>

        <form action="" method="post">
            <label>Email address</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
