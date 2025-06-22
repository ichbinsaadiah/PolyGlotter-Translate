<?php
session_start();
require_once('includes/db.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Generate secure token
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", time() + 3600); // 1 hour from now

        // Store token and expiry in a new table (we'll create it)
        $stmt2 = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt2->bind_param("sss", $email, $token, $expires);
        $stmt2->execute();

        // Send email (replace with real mail function later)
        $resetLink = "http://localhost/polyglotter/reset_password.php?token=$token";
        // In dev, just display the link instead of sending email
        $message = "Reset link (valid for 1 hour): <br><a href='$resetLink'>$resetLink</a>";
    } else {
        $message = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 500px;">
    <h4>🔐 Forgot Password</h4>
    <form method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Enter your email</label>
        <input type="email" name="email" id="email" required class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>

    <?php if (!empty($message)): ?>
      <div class="alert alert-info mt-3 text-break"><?= $message ?></div>
    <?php endif; ?>
  </div>
</body>
</html>