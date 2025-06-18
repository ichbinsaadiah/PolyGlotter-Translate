document.getElementById('translateForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(e.target);
  const spinner = document.getElementById('spinner');
  const resultBox = document.getElementById('result');
  const section = document.getElementById('translatedSection');

  // Reset UI
  section.style.display = "block";
  resultBox.innerText = "";
  spinner.classList.remove('visually-hidden');

  fetch('translate.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.text())
    .then(data => {
      spinner.classList.add('visually-hidden');
      resultBox.innerText = data.trim();
    })
    .catch(err => {
      spinner.classList.add('visually-hidden');
      resultBox.innerText = "Translation failed.";
      console.error(err);
    });
});


// 🎙️ Voice Input using Web Speech API
document.addEventListener("DOMContentLoaded", function () {
  const micBtn = document.getElementById("micBtn");
  const textarea = document.getElementById("text");

  if ("webkitSpeechRecognition" in window) {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = "en-US";
    recognition.continuous = false;
    recognition.interimResults = false;

    micBtn.addEventListener("click", function () {
      recognition.start();
      micBtn.disabled = true;
      micBtn.textContent = "🎙️ Listening...";
    });

    recognition.onresult = function (event) {
      const transcript = event.results[0][0].transcript;
      textarea.value = transcript;
    };

    recognition.onend = function () {
      micBtn.disabled = false;
      micBtn.textContent = "🎤";
    };
  } else {
    micBtn.style.display = "none"; // hide mic if not supported
  }
});
