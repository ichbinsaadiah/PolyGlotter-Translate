<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('includes/db.php');
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM translations WHERE user_id = ? ORDER BY created_at DESC LIMIT 10";
$stmt = $conn->prepare($query);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

$translations = [];
while ($row = $result->fetch_assoc()) {
    $translations[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PolyGlotter | Translate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/theme-toggle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light" id="body">
<div class="container py-5" style="max-width: 900px;">
  <div class="d-flex justify-content-between mb-4">
    <h2>🌐 PolyGlotter</h2>
    <div class="d-flex align-items-center gap-2">
  <label class="switch mb-0">
    <input type="checkbox" id="themeSwitch">
    <span class="slider"></span>
  </label>
  <a href="my_translations.php" class="btn btn-primary btn-sm">My Translations</a>
  <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>
  </div>

  <form id="translateForm">
    <div class="mb-3">
      <label for="fromLang"  style="margin-bottom: 10px; margin-right: 5px;">From:</label>
      <span id="fromFlag" class="me-2"></span>
      <select id="fromLang" name="from" class="form-select">
          <option value="en" data-flag="gb">English</option>
<option value="ar" data-flag="sa">Arabic</option>
<option value="az" data-flag="az">Azerbaijani</option>
<option value="bn" data-flag="bd">Bengali</option>
<option value="zh" data-flag="cn">Chinese</option>
<option value="cs" data-flag="cz">Czech</option>
<option value="da" data-flag="dk">Danish</option>
<option value="nl" data-flag="nl">Dutch</option>
<option value="fi" data-flag="fi">Finnish</option>
<option value="fr" data-flag="fr">French</option>
<option value="de" data-flag="de">German</option>
<option value="el" data-flag="gr">Greek</option>
<option value="hi" data-flag="in">Hindi</option>
<option value="hu" data-flag="hu">Hungarian</option>
<option value="id" data-flag="id">Indonesian</option>
<option value="ga" data-flag="ie">Irish</option>
<option value="it" data-flag="it">Italian</option>
<option value="ja" data-flag="jp">Japanese</option>
<option value="ko" data-flag="kr">Korean</option>
<option value="fa" data-flag="ir">Persian</option>
<option value="pl" data-flag="pl">Polish</option>
<option value="pt" data-flag="pt">Portuguese</option>
<option value="ru" data-flag="ru">Russian</option>
<option value="sk" data-flag="sk">Slovak</option>
<option value="es" data-flag="es">Spanish</option>
<option value="sv" data-flag="se">Swedish</option>
<option value="tr" data-flag="tr">Turkish</option>
<option value="uk" data-flag="ua">Ukrainian</option>
<option value="ur" data-flag="pk">Urdu</option>
<option value="vi" data-flag="vn">Vietnamese</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="toLang"  style="margin-bottom: 10px; margin-right: 5px;">To:</label>
      <span id="toFlag" class="me-2"></span>
      <select id="toLang" name="to" class="form-select">
          <option value="en" data-flag="gb">English</option>
<option value="ar" data-flag="sa">Arabic</option>
<option value="az" data-flag="az">Azerbaijani</option>
<option value="bn" data-flag="bd">Bengali</option>
<option value="zh" data-flag="cn">Chinese</option>
<option value="cs" data-flag="cz">Czech</option>
<option value="da" data-flag="dk">Danish</option>
<option value="nl" data-flag="nl">Dutch</option>
<option value="fi" data-flag="fi">Finnish</option>
<option value="fr" data-flag="fr">French</option>
<option value="de" data-flag="de">German</option>
<option value="el" data-flag="gr">Greek</option>
<option value="hi" data-flag="in">Hindi</option>
<option value="hu" data-flag="hu">Hungarian</option>
<option value="id" data-flag="id">Indonesian</option>
<option value="ga" data-flag="ie">Irish</option>
<option value="it" data-flag="it">Italian</option>
<option value="ja" data-flag="jp">Japanese</option>
<option value="ko" data-flag="kr">Korean</option>
<option value="fa" data-flag="ir">Persian</option>
<option value="pl" data-flag="pl">Polish</option>
<option value="pt" data-flag="pt">Portuguese</option>
<option value="ru" data-flag="ru">Russian</option>
<option value="sk" data-flag="sk">Slovak</option>
<option value="es" data-flag="es">Spanish</option>
<option value="sv" data-flag="se">Swedish</option>
<option value="tr" data-flag="tr">Turkish</option>
<option value="uk" data-flag="ua">Ukrainian</option>
<option value="ur" data-flag="pk">Urdu</option>
<option value="vi" data-flag="vn">Vietnamese</option>
      </select>
    </div>

    <div class="mb-3">
  <label for="text">Text to Translate:</label>
  <div class="input-group">
    <textarea id="text" name="text" rows="4" class="form-control" required></textarea>
    <button type="button" id="micBtn" class="btn btn-warning" title="Speak">
      🎤
    </button>
  </div>
</div>


    <button type="submit" class="btn btn-primary">Translate</button>
  </form>

<div class="mt-4" id="translatedSection" style="display: none;">
  <h5>Translated Text:</h5>
  <div id="spinner" class="d-flex align-items-center gap-2 visually-hidden mb-3">
    <img id="earthSpinner" src="assets/img/earth.png" alt="Translating..." width="36" height="36"/>
    <span class="fw-semibold">Translating...</span>
  </div>

<div id="resultWrapper" class="mt-3">
  <div id="result" class="p-3 border bg-white text-black rounded"></div>
  <div class="d-flex justify-content-end gap-2 mt-2">
    <button type="button" id="speakBtn" class="btn btn-light" title="Speak / Pause / Resume">
      🔊
    </button>
    <button type="button" id="cancelSpeakBtn" class="btn btn-outline-danger" title="Cancel">
      ❌
    </button>
  </div>
</div>

</div>
</div>

<script src="assets/js/flags.js"></script>
<script src="assets/js/theme-toggle.js"></script>
<script src="assets/js/translate.js"></script>

</body>
</html>
