<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Translations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/theme-toggle.css">
  <link rel="stylesheet" href="assets/css/my-translations.css">
</head>
<body id="body">
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h3 class="text-primary m-0">📖 My Translations</h3>
    <div class="d-flex align-items-center gap-2">
      <label class="switch m-0">
        <input type="checkbox" id="themeSwitch">
        <span class="slider"></span>
      </label>
      <a href="dashboard.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>
  </div>

<div class="row mb-3 g-3 align-items-center">
  <div class="col-md-6">
    <input type="text" class="form-control search-box" id="searchInput" placeholder="Search translations...">
  </div>
  <div class="col-md-6 text-md-end d-flex justify-content-md-end justify-content-start gap-2">
    <a href="export_csv.php" class="btn btn-success btn-sm">
      ⬇️ Export as CSV
    </a>
    <button class="btn btn-danger btn-sm" id="deleteSelected">
      <i class="bi bi-trash3"></i> Delete Selected
    </button>
    <button class="btn btn-secondary btn-sm" id="clearAll">
      <i class="bi bi-x-circle"></i> Clear All
    </button>
  </div>
</div>


  <div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle rounded-4 overflow-hidden">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectAll"><label for="selectAll" class="ms-1">All</label></th>
          <th>Sr No.</th>
          <th>Original Text</th>
          <th>Translated Text</th>
          <th>From</th>
          <th>To</th>
          <th>Date/Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="translationTableBody">
        <!-- Dynamic rows will be inserted here -->
      </tbody>
    </table>
  </div>

  <nav>
    <ul class="pagination justify-content-center" id="pagination">
      <!-- Pagination buttons will be inserted here -->
    </ul>
  </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/theme-toggle.js"></script>
<script src="assets/js/my-translations.js"></script>

</body>
</html>
