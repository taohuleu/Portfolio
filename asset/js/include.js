// js/include.js
document.addEventListener("DOMContentLoaded", function() {
  fetch('asset/dry/footer.html')
    .then(response => response.text())
    .then(data => {
      document.getElementById('footer-placeholder').innerHTML = data;
    });
});