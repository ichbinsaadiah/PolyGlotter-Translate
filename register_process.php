<?php
require 'config.php';
require 'includes/db.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$email || !$password) {
    die('Please fill in all fields.');
}

// Check if email or username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$stmt->execute([$email, $username]);
$existingUser = $stmt->fetch();

if ($existingUser) {
    echo "<script>alert('Email or Username already exists'); window.location.href='register.php';</script>";
    exit();
}

// Insert new user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashedPassword]);

echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";