<?php
session_start();
require_once __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and execute query using PDO
$sql = "SELECT id, source_text AS original, translated_text AS translated, source_language AS `from`, target_language AS `to`, created_at AS datetime 
        FROM translations 
        WHERE user_id = :user_id 
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch all rows
$translations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return as JSON
echo json_encode($translations);