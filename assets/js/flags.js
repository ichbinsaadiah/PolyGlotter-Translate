function updateFlag(selectId, flagId) {
  const select = document.getElementById(selectId);
  const flagSpan = document.getElementById(flagId);

  function setFlag() {
    const selectedOption = select.options[select.selectedIndex];
    const countryCode = selectedOption.dataset.flag;

    if (countryCode) {
      const flagUrl = `assets/flags/4x3/${countryCode.toLowerCase()}.svg`;
      flagSpan.innerHTML = `<img src="${flagUrl}" alt="${countryCode}" width="24" height="18" class="rounded border" />`;
    } else {
      flagSpan.innerHTML = '';
    }
  }

  select.addEventListener("change", setFlag);
  setFlag(); // initial
}

document.addEventListener("DOMContentLoaded", () => {
  updateFlag("fromLang", "fromFlag");
  updateFlag("toLang", "toFlag");
});
