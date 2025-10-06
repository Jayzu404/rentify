setTimeout(function() {
  const successAlert = document.getElementById('successAlert');
  const dangerAlert = document.getElementById('dangerAlert');
  if (successAlert) {
    alert.remove();
  } else if (dangerAlert) {
    alert.remove();
  }
}, 3000);