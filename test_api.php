<?php

$originalText = "Hello world, this is a test.";

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://translate-all-languages.p.rapidapi.com/translate?fromLang=en&toLang=fr&text=" . urlencode($originalText),
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: translate-all-languages.p.rapidapi.com",
		"x-rapidapi-key: " . "b8a74ea7eamshe1b8a3bf92c41e1p14cf95jsn9ecddb65e01d"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
	echo "cURL Error #: " . $err;
} else {
	$data = json_decode($response, true);
	$translatedText = $data['translatedText'] ?? 'Translation failed.';
	echo "<strong>Test API Translation:</strong><br>";
	echo "Original: $originalText<br>";
	echo "Translated: $translatedText";
}
