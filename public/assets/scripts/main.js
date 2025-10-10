// Form validation and interaction handling
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('rentifyForm');
    const submitBtn = document.getElementById('submitBtn');
    const previewBtn = document.getElementById('previewBtn');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const photoInput = document.getElementById('itemPhotos');
    const photoPreviewCount = document.getElementById('photoPreviewCount');
    
    // Photo upload preview counter
    photoInput.addEventListener('change', function(e) {
        const fileCount = e.target.files.length;
        if (fileCount > 0) {
            photoPreviewCount.innerHTML = `<i class="bi bi-images text-success"></i> ${fileCount} file(s) selected`;
            if (fileCount > 5) {
                photoPreviewCount.innerHTML += ' <span class="text-danger">(Maximum 5 allowed)</span>';
            }
        } else {
            photoPreviewCount.innerHTML = '';
        }
    });
    
    // Real-time form validation
    form.addEventListener('input', function() {
        checkFormValidity();
    });
    
    form.addEventListener('change', function() {
        checkFormValidity();
    });
    
    function checkFormValidity() {
        const requiredFields = form.querySelectorAll('[required]');
        let allValid = true;
        
        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
                const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                if (!isChecked) allValid = false;
            } else if (field.type === 'checkbox' && field.id === 'termsAgreement') {
                if (!field.checked) allValid = false;
            } else if (field.type === 'file') {
                if (field.files.length === 0) allValid = false;
            } else if (!field.value.trim()) {
                allValid = false;
            }
        });
        
        // Check communication checkboxes
        const commCheckboxes = form.querySelectorAll('[name="communication"]');
        const isCommChecked = Array.from(commCheckboxes).some(cb => cb.checked);
        if (!isCommChecked) allValid = false;
        
        submitBtn.disabled = !allValid;
    }
    
    // Form submission with Bootstrap validation
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            
            // Scroll to first invalid field
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        } else {
            // Success! In real implementation, submit to backend
            alert('✓ Listing submitted successfully!\n\nYour item will be reviewed and published shortly.');
            
            // Close modal and reset form
            const modal = bootstrap.Modal.getInstance(document.getElementById('rentifyModal'));
            modal.hide();
            form.reset();
            form.classList.remove('was-validated');
            photoPreviewCount.innerHTML = '';
            checkFormValidity();
        }
    });
    
    // Preview button
    previewBtn.addEventListener('click', function() {
        alert('Preview functionality would show a formatted view of your listing here.');
    });
    
    // Save draft button
    saveDraftBtn.addEventListener('click', function() {
        alert('Draft saved! You can continue editing later.');
    });
    
    // Set minimum date for availability
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('availableFrom').setAttribute('min', today);
    document.getElementById('availableUntil').setAttribute('min', today);
    
    // Initialize tooltips if needed
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});