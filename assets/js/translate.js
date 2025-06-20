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

  let userSpoke = false;
  let permissionDenied = false;

  micBtn.addEventListener("click", function () {
    recognition.start();
    micBtn.disabled = true;
    micBtn.textContent = "🎙️ Listening...";
    userSpoke = false;
    permissionDenied = false;
  });

  recognition.onresult = function (event) {
    const transcript = event.results[0][0].transcript;
    textarea.value = transcript;
    userSpoke = true;
  };

  recognition.onerror = function (event) {
    console.error("Speech recognition error:", event.error);
    if (event.error === "not-allowed") {
      permissionDenied = true;
      alert("❌ Microphone permission denied. Please allow access to use voice input.");
    }
  };

  recognition.onend = function () {
    micBtn.disabled = false;
    micBtn.textContent = "🎤";

    // Only show toast if permission was not denied and user didn’t speak
    if (!userSpoke && !permissionDenied) {
      alert("⚠️ No speech detected. Try speaking louder or check your mic.");
    }
  };
}
});

// 🎤 Text-to-Speech with Pause / Resume / Cancel
let utterance;
let isSpeaking = false;
let isPaused = false;

const speakBtn = document.getElementById("speakBtn");
const cancelBtn = document.getElementById("cancelSpeakBtn");

function getLanguageCodeFromDropdown() {
  const toLang = document.getElementById("toLang");
  return toLang ? toLang.value : "en";
}

function getVoiceForLang(langCode) {
  const voices = speechSynthesis.getVoices();
  return voices.find(voice => voice.lang.toLowerCase().includes(langCode.toLowerCase()));
}

speakBtn.addEventListener("click", function () {
  const text = document.getElementById("result").innerText.trim();
  if (!text) return;

  if (!isSpeaking) {
    utterance = new SpeechSynthesisUtterance(text);

    const targetLang = getLanguageCodeFromDropdown();
    const voice = getVoiceForLang(targetLang);

    if (voice) {
      utterance.voice = voice;
    } else {
      console.warn(`⚠️ No voice found for language: ${targetLang}, using default.`);
    }

    utterance.onend = () => {
      isSpeaking = false;
      isPaused = false;
      speakBtn.innerText = "🔊";
    };

    speechSynthesis.speak(utterance);
    isSpeaking = true;
    isPaused = false;
    speakBtn.innerText = "⏸";
  } else if (!isPaused) {
    speechSynthesis.pause();
    isPaused = true;
    speakBtn.innerText = "▶️";
  } else {
    speechSynthesis.resume();
    isPaused = false;
    speakBtn.innerText = "⏸";
  }
});

cancelBtn.addEventListener("click", function () {
  speechSynthesis.cancel();
  isSpeaking = false;
  isPaused = false;
  speakBtn.innerText = "🔊";
});

// Ensure voices are loaded on all browsers
if (speechSynthesis.onvoiceschanged !== undefined) {
  speechSynthesis.onvoiceschanged = () => {
    speechSynthesis.getVoices(); // Preload voices
  };
}

