<?php
session_start();

if (isset($_SESSION['admin_logged_in'])) {
  header("Location: add-product.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(135deg, #0b5ed7, #084298);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      width: 100%;
      max-width: 380px;
      background: #fff;
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
      text-align: center;
    }

    .login-box h2 {
      margin-bottom: 20px;
      color: #0b5ed7;
    }

    .form-group {
      margin-bottom: 16px;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .form-group input:focus {
      outline: none;
      border-color: #0b5ed7;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      border-radius: 8px;
      border: none;
      background: #0b5ed7;
      color: #fff;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #084298;
    }

    .error {
      margin-top: 15px;
      color: #dc2626;
      font-size: 14px;
    }

    .footer-text {
      margin-top: 20px;
      font-size: 13px;
      color: #666;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>🔐 Admin Login</h2>

    <form method="POST" action="login-process.php">

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit">Ingia</button>
    </form>

    <?php if (isset($_GET['error'])): ?>
      <div class="error">❌ Username au Password sio sahihi</div>
    <?php endif; ?>

    <div class="footer-text">
      Msuo Aqua & Poultry Center
    </div>
  </div>

</body>
</html>
