<?php
session_start();
require_once __DIR__ . '/includes/db.php'; // ✅ corrected path

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and execute query
$sql = "SELECT id, source_text AS original, translated_text AS translated, source_language AS `from`, target_language AS `to`, created_at AS datetime FROM translations WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch results
$translations = [];
while ($row = $result->fetch_assoc()) {
    $translations[] = $row;
}

echo json_encode($translations);
?>
