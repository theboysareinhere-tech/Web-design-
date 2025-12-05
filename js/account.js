// ===== Mobile Menu Toggle =====
const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.querySelector('.nav-links');

menuToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

// ===== Profile Image Upload =====
const uploadInput = document.getElementById("upload-img");
const profileImg = document.getElementById("profile-img");

uploadInput.addEventListener("change", () => {
  const file = uploadInput.files[0];
  if (file) {
    profileImg.src = URL.createObjectURL(file);
  }
});
