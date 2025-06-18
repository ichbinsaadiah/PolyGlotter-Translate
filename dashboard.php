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
      <label for="fromLang">From:</label>
      <select id="fromLang" name="from" class="form-select">
        <option value="en">English</option>
        <option value="ar">Arabic</option>
        <option value="az">Azerbaijani</option>
        <option value="bn">Bengali</option>
        <option value="zh">Chinese</option>
        <option value="cs">Czech</option>
        <option value="da">Danish</option>
        <option value="nl">Dutch</option>
        <option value="fi">Finnish</option>
        <option value="fr">French</option>
        <option value="de">German</option>
        <option value="el">Greek</option>
        <option value="hi">Hindi</option>
        <option value="hu">Hungarian</option>
        <option value="id">Indonesian</option>
        <option value="ga">Irish</option>
        <option value="it">Italian</option>
        <option value="ja">Japanese</option>
        <option value="ko">Korean</option>
        <option value="fa">Persian</option>
        <option value="pl">Polish</option>
        <option value="pt">Portuguese</option>
        <option value="ru">Russian</option>
        <option value="sk">Slovak</option>
        <option value="es">Spanish</option>
        <option value="sv">Swedish</option>
        <option value="tr">Turkish</option>
        <option value="uk">Ukrainian</option>
        <option value="ur">Urdu</option>
        <option value="vi">Vietnamese</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="toLang">To:</label>
      <select id="toLang" name="to" class="form-select">
        <option value="en">English</option>
        <option value="ar">Arabic</option>
        <option value="az">Azerbaijani</option>
        <option value="zh">Chinese</option>
        <option value="cs">Czech</option>
        <option value="da">Danish</option>
        <option value="nl">Dutch</option>
        <option value="fi">Finnish</option>
        <option value="fr">French</option>
        <option value="de">German</option>
        <option value="el">Greek</option>
        <option value="hi">Hindi</option>
        <option value="hu">Hungarian</option>
        <option value="id">Indonesian</option>
        <option value="ga">Irish</option>
        <option value="it">Italian</option>
        <option value="ja">Japanese</option>
        <option value="ko">Korean</option>
        <option value="fa">Persian</option>
        <option value="pl">Polish</option>
        <option value="pt">Portuguese</option>
        <option value="ru">Russian</option>
        <option value="sk">Slovak</option>
        <option value="es">Spanish</option>
        <option value="sv">Swedish</option>
        <option value="tr">Turkish</option>
        <option value="uk">Ukrainian</option>
        <option value="ur">Urdu</option>
        <option value="vi">Vietnamese</option>
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
  <img id="earthSpinner" src="assets/img/earth.png" alt="Translating..." width="30" height="30"/>
  <span class="fw-semibold">Translating...</span>
  </div>

  <div id="result" class="p-3 border bg-white text-black rounded"></div>
</div>

</div>
</div>

<script src="assets/js/theme-toggle.js"></script>
<script src="assets/js/translate.js"></script>

</body>
</html>
