document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.getElementById("translationTableBody");
  const pagination = document.getElementById("pagination");
  const searchInput = document.getElementById("searchInput");
  const selectAllCheckbox = document.getElementById("selectAll");
  const deleteSelectedBtn = document.getElementById("deleteSelected");
  const clearAllBtn = document.getElementById("clearAll");

  let translations = [];
  let currentPage = 1;
  const rowsPerPage = 10;

  // ✅ Load real translations from database
  fetch("fetch_translations.php")
    .then(response => {
      if (!response.ok) throw new Error("Failed to load translations");
      return response.json();
    })
    .then(data => {
      translations = data;
      displayTable(filteredTranslations());
      setupPagination(filteredTranslations());
    })
    .catch(error => {
      console.error(error);
      tableBody.innerHTML = `<tr><td colspan="8" class="text-danger">Error loading translations</td></tr>`;
    });

  function displayTable(data) {
    tableBody.innerHTML = "";

    if (data.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="8" class="text-muted">No translations found.</td></tr>`;
      return;
    }

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    data.slice(start, end).forEach((item, index) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td><input type="checkbox" class="row-checkbox" data-id="${item.id}"></td>
        <td>${start + index + 1}</td>
        <td data-label="Original">${item.original}</td>
        <td data-label="Translated">${item.translated}</td>
        <td data-label="From">${item.from}</td>
        <td data-label="To">${item.to}</td>
        <td data-label="Date">${item.datetime}</td>
        <td><button class="btn btn-sm btn-danger delete-btn" data-id="${item.id}"><i class="bi bi-trash3"></i></button></td>
      `;
      tableBody.appendChild(row);
    });
  }

  function setupPagination(data) {
    pagination.innerHTML = "";
    const totalPages = Math.ceil(data.length / rowsPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      li.className = `page-item ${i === currentPage ? "active" : ""}`;
      li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      li.addEventListener("click", function (e) {
        e.preventDefault();
        currentPage = i;
        displayTable(filteredTranslations());
        setupPagination(filteredTranslations());
        selectAllCheckbox.checked = false;
      });
      pagination.appendChild(li);
    }
  }

  function filteredTranslations() {
    const term = searchInput.value.toLowerCase();
    return translations.filter(item =>
      item.original.toLowerCase().includes(term) ||
      item.translated.toLowerCase().includes(term)
    );
  }

  searchInput.addEventListener("input", function () {
    currentPage = 1;
    displayTable(filteredTranslations());
    setupPagination(filteredTranslations());
  });

  selectAllCheckbox.addEventListener("change", function () {
    document.querySelectorAll(".row-checkbox").forEach(checkbox => {
      checkbox.checked = selectAllCheckbox.checked;
    });
  });

  deleteSelectedBtn.addEventListener("click", function () {
    const selectedIds = [...document.querySelectorAll(".row-checkbox:checked")].map(cb => parseInt(cb.dataset.id));
    if (selectedIds.length === 0) return;

    translations = translations.filter(item => !selectedIds.includes(item.id));
    if ((currentPage - 1) * rowsPerPage >= filteredTranslations().length) {
      currentPage = Math.max(currentPage - 1, 1);
    }

    displayTable(filteredTranslations());
    setupPagination(filteredTranslations());

    setTimeout(() => {
      selectAllCheckbox.checked = false;
    }, 0);
  });

  clearAllBtn.addEventListener("click", function () {
    if (confirm("Are you sure you want to delete all translations?")) {
      translations = [];
      displayTable([]);
      pagination.innerHTML = "";
      selectAllCheckbox.checked = false;
    }
  });

  tableBody.addEventListener("click", function (e) {
    if (e.target.closest(".delete-btn")) {
      const id = parseInt(e.target.closest(".delete-btn").dataset.id);
      translations = translations.filter(item => item.id !== id);
      displayTable(filteredTranslations());
      setupPagination(filteredTranslations());
      selectAllCheckbox.checked = false;
    }
  });
});
