<?php
require 'config.php';
require 'includes/db.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Check if user already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$result = $stmt->get_result();
$existingUser = $result->fetch_assoc();

if ($existingUser) {
    echo "<script>alert('Username or Email already exists'); window.location.href='register.php';</script>";
    exit();
}

// Insert new user
$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed);
$stmt->execute();

echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";