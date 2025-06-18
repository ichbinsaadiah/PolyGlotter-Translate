<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $from = $_POST['from'];
    $to = $_POST['to'];
    $text = trim($_POST['text']);

    if (!$from || !$to || !$text) {
        echo "Missing input.";
        exit;
    }

    // Temporary files for input/output
    $tmpIn = tempnam(sys_get_temp_dir(), 'argos_in_');
    $tmpOut = tempnam(sys_get_temp_dir(), 'argos_out_');
    file_put_contents($tmpIn, $text);

    // Python + Argos paths
    $pythonPath = "C:\\Users\\Admin\\AppData\\Local\\Programs\\Python\\Python310\\python.exe";
    $argosScript = "C:\\Users\\Admin\\AppData\\Local\\Programs\\Python\\Python310\\Scripts\\argos-translate";

    // Build command with redirection
    $cmd = "\"$pythonPath\" \"$argosScript\" --from-lang $from --to-lang $to < \"$tmpIn\" > \"$tmpOut\"";

    // Ensure UTF-8 output
    putenv("PYTHONIOENCODING=utf-8");

    // Execute command
    exec($cmd, $outputLines, $exitCode);
    $translatedText = file_exists($tmpOut) ? trim(file_get_contents($tmpOut)) : '';

    // Cleanup
    unlink($tmpIn);
    unlink($tmpOut);

    // Fallback if something went wrong
    if (!$translatedText || $exitCode !== 0) {
        echo "Translation failed.";
        exit;
    }

    // Save to DB if user is logged in
    if ($user_id) {
        $stmt = $conn->prepare("INSERT INTO translations (user_id, source_text, translated_text, source_language, target_language)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $text, $translatedText, $from, $to);
        $stmt->execute();
    }

    echo $translatedText;
}
?>
