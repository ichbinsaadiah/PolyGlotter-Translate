.<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | PolyGlotter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="PolyGlotter Logo" width="100">
        <h2 class="mt-2">PolyGlotter</h2>
      </div>
      <form action="register_process.php" method="POST">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
