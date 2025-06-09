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