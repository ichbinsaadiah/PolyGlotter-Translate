<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('includes/db.php');
$user_id = $_SESSION['user_id'];

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=translations.csv');

$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Source Text', 'Translated Text', 'Source Language', 'Target Language', 'Date']);

// Fetch data
$stmt = $conn->prepare("SELECT source_text, translated_text, source_language, target_language, created_at FROM translations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['source_text'],
        $row['translated_text'],
        $row['source_language'],
        $row['target_language'],
        $row['created_at']
    ]);
}

fclose($output);
exit();
?>
