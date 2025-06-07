<?php
require 'config.php';
require 'includes/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    die('Please fill in all fields.');
}

// Lookup user
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :email LIMIT 1");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: dashboard.php');
    exit();
} else {
    echo "<script>alert('Invalid login credentials'); window.location.href='login.php';</script>";
}
