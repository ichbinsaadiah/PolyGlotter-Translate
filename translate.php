<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $text = $_POST['text'];

    $response = file_get_contents("https://libretranslate.de/translate", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-type: application/x-www-form-urlencoded",
            "content" => http_build_query([
                "q" => $text,
                "source" => $from,
                "target" => $to,
                "format" => "text"
            ])
        ]
    ]));

    $data = json_decode($response, true);
    echo $data['translatedText'] ?? 'Translation failed.';
}
