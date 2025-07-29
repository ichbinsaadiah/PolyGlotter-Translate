<?php
session_start();
require_once('includes/db.php');

$token = $_GET['token'] ?? '';
$valid = false;
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT email, expires_at FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $email = $row['email'];
        $expires = strtotime($row['expires_at']);

        if ($expires > time()) {
            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->execute([$hashedPassword, $email]);

            // Delete token
            $delete = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $delete->execute([$token]);

            $message = "Your password has been reset. <a href='login.php'>Login now</a>";
        } else {
            $message = "This reset link has expired.";
        }
    } else {
        $message = "Invalid reset link.";
    }
} else {
    // On GET request, validate token
    if (!empty($token)) {
        $stmt = $conn->prepare("SELECT expires_at FROM password_resets WHERE token = ?");
        $stmt->execute([$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $expires = strtotime($row['expires_at']);
            $valid = $expires > time();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 500px;">
    <h4>🔒 Reset Password</h4>

    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php elseif ($valid): ?>
      <form method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <div class="mb-3">
          <label for="password" class="form-label">New Password</label>
          <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-success">Reset Password</button>
      </form>
    <?php else: ?>
      <div class="alert alert-danger">❌ Invalid or expired reset link.</div>
    <?php endif; ?>
  </div>
</body>
</html>
