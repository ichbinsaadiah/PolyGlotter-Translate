<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $from = $_POST['from'];
    $to = $_POST['to'];
    $text = trim($_POST['text']);

    // Translation using working RapidAPI
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://translate-all-languages.p.rapidapi.com/translate?fromLang=" . urlencode($from) . "&toLang=" . urlencode($to) . "&text=" . urlencode($text),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: translate-all-languages.p.rapidapi.com",
            "x-rapidapi-key: b8a74ea7eamshe1b8a3bf92c41e1p14cf95jsn9ecddb65e01d"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "Translation failed.";
        exit;
    }

    $data = json_decode($response, true);
    $translatedText = $data['translatedText'] ?? 'Translation failed.';

    // Save to DB if translation succeeded
    if ($user_id && $translatedText !== 'Translation failed.') {
        $stmt = $pdo->prepare("INSERT INTO translations (user_id, source_text, translated_text, source_language, target_language) 
                               VALUES (:user_id, :source_text, :translated_text, :source_language, :target_language)");
        $stmt->execute([
            'user_id' => $user_id,
            'source_text' => $text,
            'translated_text' => $translatedText,
            'source_language' => $from,
            'target_language' => $to
        ]);
    }

    echo $translatedText;
}
?>