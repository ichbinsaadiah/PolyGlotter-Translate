document.getElementById('translateForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  fetch('translate.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.text())
    .then(data => {
      document.getElementById('result').innerText = data;
    })
    .catch(err => {
      document.getElementById('result').innerText = "Translation failed.";
      console.error(err);
    });
});
