// 🌐 Save/Restore language preferences
document.addEventListener("DOMContentLoaded", () => {
  const fromLang = document.getElementById("fromLang");
  const toLang = document.getElementById("toLang");

  if (fromLang && toLang) {
    // Restore if present
    const savedFrom = getCookie("fromLang");
    const savedTo = getCookie("toLang");

    if (savedFrom) fromLang.value = savedFrom;
    if (savedTo) toLang.value = savedTo;

    // Trigger change event to update flags
    if (savedFrom) fromLang.dispatchEvent(new Event("change"));
    if (savedTo) toLang.dispatchEvent(new Event("change"));

    // Save on change
    fromLang.addEventListener("change", () => {
      document.cookie = "fromLang=" + fromLang.value + "; path=/; max-age=31536000";
    });
    toLang.addEventListener("change", () => {
      document.cookie = "toLang=" + toLang.value + "; path=/; max-age=31536000";
    });
  }
});

const toggle = document.getElementById('themeSwitch');

function setTheme(mode) {
  document.body.className = mode + "-mode";
  document.cookie = "theme=" + mode + "; path=/; max-age=31536000";
  toggle.checked = (mode === "dark");
}

function getCookie(name) {
  const value = "; " + document.cookie;
  const parts = value.split("; " + name + "=");
  return parts.length === 2 ? parts.pop().split(";").shift() : null;
}

// Initial load
const savedTheme = getCookie("theme");
const systemPref = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
setTheme(savedTheme || systemPref);

toggle.addEventListener("change", () => {
  const newTheme = toggle.checked ? "dark" : "light";
  setTheme(newTheme);
});