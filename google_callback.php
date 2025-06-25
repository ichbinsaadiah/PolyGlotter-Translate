<?php
session_start();
require_once __DIR__ . '/google_config.php'; // Configures $client
require_once __DIR__ . '/includes/db.php';   // DB connection

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $oauth = new Google_Service_Oauth2($client);
        $googleUser = $oauth->userinfo->get();

        $email = $googleUser->email;
        $name = $googleUser->name;

        // Check if user already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
        } else {
            // Insert new user (you can customize further if needed)
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, '')");
            $stmt->bind_param("ss", $name, $email);
            $stmt->execute();
            $user_id = $stmt->insert_id;
        }

        // Login
        $_SESSION['user_id'] = $user_id;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<p>❌ Error fetching token: " . htmlspecialchars($token['error']) . "</p>";
    }
} else {
    echo "<p>❌ Authorization code not provided.</p>";
}