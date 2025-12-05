function showSuccessPopup() {
  const popup = document.getElementById("successPopup");
  popup.style.display = "flex";

  // Auto-hide after 3 seconds
  setTimeout(() => {
    popup.style.display = "none";
  }, 3000);
}
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.get("sent") == "1") {
    showSuccessPopup();
}