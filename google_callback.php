<?php
session_start();
use Google\Service\Oauth2;
require_once __DIR__ . '/google_config.php'; // Configures $client
require_once __DIR__ . '/includes/db.php';   // PDO DB connection

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    // Proper error check
    if ($token === null || isset($token['error'])) {
        echo "<p>Error fetching token: " . htmlspecialchars($token['error'] ?? 'Unknown error') . "</p>";
        exit;
    }

    $client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $client->getAccessToken();

    $oauth = new Oauth2($client);
    $googleUser = $oauth->userinfo->get();

    $email = $googleUser->email;
    $name = $googleUser->name;

    // Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $user_id = $stmt->fetchColumn();
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, '')");
        $stmt->bindParam(':username', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user_id = $conn->lastInsertId();
    }

    // Login
    $_SESSION['user_id'] = $user_id;
    header('Location: dashboard.php');
    exit;
} else {
    echo "<p>Authorization code not provided.</p>";
}