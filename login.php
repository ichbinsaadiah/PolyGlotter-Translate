<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | PolyGlotter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="PolyGlotter Logo" width="100">
        <h2 class="mt-2">PolyGlotter</h2>
      </div>
      <form method="POST" action="login_process.php">
        <div class="mb-3">
          <label>Email or Username</label>
          <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <!-- ✅ Insert this new line just below -->
<div class="mb-2 text-end">
  <a href="forgot_password.php">Forgot Password?</a>
</div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        <p class="mt-3 text-center">Don’t have an account? <a href="register.php">Register</a></p>
      </form>
      <!-- ✅ Google Login Button (separate section below the form) -->
      <hr class="my-4">
      <div class="d-grid mt-3">
  <a href="google_login.php" class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-2">
    <img src="assets/img/g-logo.png" width="20" height="20" alt="Google Logo">
    <span>Login with Google</span>
  </a>
</div>
    </div>
  </div>
</div>

</body>
</html>