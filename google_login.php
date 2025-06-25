<?php
require_once __DIR__ . '/google_config.php'; // ✅ This provides $client ready to use

$authUrl = $client->createAuthUrl();
header('Location: ' . $authUrl);
exit;
