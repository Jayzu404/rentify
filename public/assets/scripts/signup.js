function previewImage(event) {
  const file = event.target.files[0];
  const preview = document.getElementById('previewImage');
  const previewLabel = document.getElementById('previewLabel');
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = "block";
      previewLabel.style.display = "block";
    }
    reader.readAsDataURL(file);
  } else {
    preview.src = "#";
    preview.style.display = "none";
  }
}

// Add event listener after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  const validIdInput = document.getElementById('validId');
  if (validIdInput) {
    validIdInput.addEventListener('change', previewImage);
  }
});