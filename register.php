<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | PolyGlotter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/theme-toggle.css" rel="stylesheet">
  <style>
    body {
      transition: background-color 0.3s ease;
    }
    .card-base {
      border-radius: 1rem;
      box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    .card-glass {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 1rem;
      color: #fff;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.25);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }
    .logo-img {
      width: 70px;
    }
    .glass-toggle {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 1000;
    }
  </style>
</head>
<body id="body-theme" class="light-mode position-relative">

  <!-- Dark/Light Toggle -->
  <div class="position-absolute top-0 end-0 m-3">
    <label class="switch">
      <input type="checkbox" id="themeSwitch">
      <span class="slider"></span>
    </label>
  </div>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div id="formCard" class="card p-4 card-base bg-white text-dark">
          <div class="text-center mb-4">
            <img src="assets/img/logo.png" alt="PolyGlotter Logo" class="logo-img">
            <h3 class="mt-2 fw-semibold">Register for PolyGlotter</h3>
          </div>
          <form action="register_process.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="text-center mt-3 small">Already have an account? <a href="login.php">Login</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="assets/js/theme-toggle.js"></script>
  <script>
    // Reuse theme-toggle.js for theme
    const card = document.getElementById('formCard');

    // Apply initial theme to card
    const savedTheme = document.cookie.includes('theme=dark') ? 'dark' : 'light';
    if (savedTheme === 'dark') {
      card.classList.replace("bg-white", "bg-dark");
      card.classList.replace("text-dark", "text-light");
    }

    // Toggle glassmorphism
    function toggleGlass() {
      card.classList.toggle("card-glass");
    }
  </script>
</body>
</html>
