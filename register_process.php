<?php
require 'config.php';
require 'includes/db.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Check if user already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
$stmt->execute(['email' => $email, 'username' => $username]);
$existingUser = $stmt->fetch();

if ($existingUser) {
    echo "<script>alert('Username or Email already exists'); window.location.href='register.php';</script>";
    exit();
}

// Insert new user
$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
$stmt->execute([
    'username' => $username,
    'email' => $email,
    'password' => $hashed
]);

echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
?>