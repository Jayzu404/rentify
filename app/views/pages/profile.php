<?php
  require_once dirname(__DIR__) . '/layouts/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Rentify</title>
  
  <!-- Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">  

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      background: #ffffff;
      min-height: 100vh;
    }
    
    .profile-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .profile-avatar {
      overflow: hidden;
    }
    
    .profile-header {
      background: #ffffff;
      padding: 40px 0;
      border-bottom: 1px solid #e9ecef;
      margin-bottom: 48px;
    }
    
    @media (max-width: 768px) {
      .profile-header {
        padding: 30px 0;
      }
      
      .profile-avatar {
        width: 80px !important;
        height: 80px !important;
        font-size: 32px !important;
      }
      
      .avatar-edit {
        width: 28px !important;
        height: 28px !important;
      }
      
      .profile-name {
        font-size: 24px !important;
      }
      
      .profile-email {
        font-size: 14px !important;
      }
      
      .section-title {
        font-size: 18px !important;
      }
      
      .section-header {
        margin-bottom: 24px !important;
      }
      
      .input-group-custom {
        margin-bottom: 24px !important;
      }
      
      .section-divider {
        margin: 40px 0 !important;
      }
      
      .btn-primary, .btn-secondary {
        padding: 12px 24px !important;
        font-size: 14px !important;
      }
      
      .id-file-info {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 16px;
      }
      
      .security-section {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 16px;
      }
    }
    
    @media (max-width: 576px) {
      .profile-container {
        padding: 0 16px;
      }
      
      .d-flex.gap-3 {
        flex-direction: column;
      }
      
      .btn-edit {
        padding: 6px 12px !important;
        font-size: 13px !important;
      }
    }
    
    .profile-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 42px;
      color: white;
      font-weight: 600;
      margin-bottom: 20px;
      position: relative;
    }
    
    .avatar-edit {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 32px;
      height: 32px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      cursor: pointer;
      border: 3px solid #ffffff;
    }
    
    .profile-name {
      font-size: 32px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 6px;
      letter-spacing: -0.5px;
    }
    
    .profile-email {
      color: #6c757d;
      font-size: 16px;
      margin-bottom: 16px;
    }
    
    .info-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      background: #f8f9fa;
      border-radius: 6px;
      font-size: 14px;
      color: #6c757d;
    }
    
    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
    }
    
    .section-title {
      font-size: 20px;
      font-weight: 600;
      color: #1a1a1a;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .form-label {
      font-weight: 500;
      color: #1a1a1a;
      font-size: 14px;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 12px;
    }
    
    .form-control, .form-select {
      border: none;
      border-bottom: 2px solid #e9ecef;
      border-radius: 0;
      padding: 12px 0;
      font-size: 16px;
      transition: all 0.3s ease;
      background: transparent;
    }
    
    .form-control:focus, .form-select:focus {
      border-bottom-color: #667eea;
      box-shadow: none;
      background: transparent;
    }
    
    .form-control:disabled {
      background-color: transparent;
      color: #495057;
      opacity: 0.7;
    }
    
    .btn-edit {
      background: transparent;
      border: none;
      color: #667eea;
      padding: 8px 20px;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-edit:hover {
      color: #5568d3;
      background: rgba(102, 126, 234, 0.08);
      border-radius: 6px;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 14px 40px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 15px;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    
    .btn-secondary {
      background: transparent;
      border: 2px solid #e9ecef;
      color: #495057;
      padding: 14px 40px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 15px;
      transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
      background: #f8f9fa;
      border-color: #dee2e6;
    }
    
    .section-divider {
      height: 1px;
      background: #e9ecef;
      margin: 56px 0;
    }
    
    .id-verification {
      padding: 24px 0;
      border-bottom: 1px solid #e9ecef;
    }
    
    .verification-status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      background: #d4edda;
      color: #155724;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
    }
    
    .id-file-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 0;
    }
    
    .file-details {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .file-icon {
      width: 48px;
      height: 48px;
      background: #f8f9fa;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #667eea;
      font-size: 20px;
    }
    
    .change-password-link {
      color: #667eea;
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }
    
    .change-password-link:hover {
      color: #5568d3;
      gap: 10px;
    }
    
    .security-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 28px 0;
    }
    
    .input-group-custom {
      margin-bottom: 32px;
    }
  </style>
</head>
<body>
  
  <div class="profile-container">
    
    <!-- Profile Header -->
    <div class="profile-header">
      <div class="profile-avatar">
        <img src="/assets/images/cat-pfp.jpg" alt="pfp" width="100px">
        <div class="avatar-edit">
          <i class="bi bi-camera" style="color: #667eea; font-size: 14px;"></i>
        </div>
      </div>
      <h1 class="profile-name">Teejay</h1>
      <p class="profile-email">teejay@yahee.com</p>
      <span class="info-badge">
        <i class="bi bi-calendar3"></i>
        Member since Oct 2025
      </span>
    </div>
    
    <!-- Personal Information -->
    <div class="section-header">
      <h2 class="section-title">
        <i class="bi bi-person-circle"></i>
        Personal Information
      </h2>
      <button class="btn-edit" id="editBtn" onclick="toggleEdit()">
        <i class="bi bi-pencil me-1"></i> Edit
      </button>
    </div>
    
    <form id="profileForm">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="input-group-custom">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" value="Teejay" disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group-custom">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" value="Bernil" disabled>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group-custom">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" value="Arancina" disabled>
          </div>
        </div>
      </div>
      
      <div class="row g-4">
        <div class="col-md-12">
          <div class="input-group-custom">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" id="address" value="Lake Thun, Switzerland" disabled>
          </div>
        </div>
      </div>
      
      <div class="row g-4">
        <div class="col-md-12">
          <div class="input-group-custom">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" value="teejay@yahee.com" disabled>
          </div>
        </div>
      </div>
      
      <div class="section-divider"></div>
      
      <!-- ID Verification Section -->
      <div class="id-verification">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h3 class="section-title">
            <i class="bi bi-shield-check"></i>
            ID Verification
          </h3>
          <span class="verification-status">
            <i class="bi bi-check-circle-fill"></i>
            Verified
          </span>
        </div>
        
        <div class="id-file-info">
          <div class="file-details">
            <div class="file-icon">
              <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
              <p class="mb-0 fw-medium" style="font-size: 15px;">Valid Government ID</p>
              <p class="mb-0 text-muted" style="font-size: 13px;">government_id_12345.pdf</p>
            </div>
          </div>
          <button type="button" class="btn-edit" id="uploadBtn" disabled>
            <i class="bi bi-upload me-1"></i> Replace
          </button>
        </div>
      </div>
      
      <div class="section-divider"></div>
      
      <!-- Security Section -->
      <div class="security-section">
        <div>
          <h3 class="section-title mb-2">
            <i class="bi bi-lock"></i>
            Password
          </h3>
          <p class="text-muted mb-0" style="font-size: 14px;">Last changed 2 months ago</p>
        </div>
        <a href="#" class="change-password-link">
          Change Password <i class="bi bi-arrow-right"></i>
        </a>
      </div>
      
      <!-- Action Buttons -->
      <div class="d-flex gap-3 mt-5" id="actionButtons" style="display: none !important;">
        <button type="button" class="btn btn-secondary flex-fill" onclick="cancelEdit()">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary flex-fill">
          Save Changes
        </button>
      </div>
    </form>
    
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  
  <script>
    let isEditing = false;
    let originalValues = {};
    
    function toggleEdit() {
      isEditing = !isEditing;
      const inputs = ['firstName', 'middleName', 'lastName', 'address', 'email'];
      const editBtn = document.getElementById('editBtn');
      const actionButtons = document.getElementById('actionButtons');
      const uploadBtn = document.getElementById('uploadBtn');
      
      if (isEditing) {
        // Save original values
        inputs.forEach(id => {
          originalValues[id] = document.getElementById(id).value;
          document.getElementById(id).disabled = false;
        });
        
        editBtn.innerHTML = '<i class="bi bi-x-lg me-1"></i> Cancel';
        actionButtons.style.display = 'flex !important';
        actionButtons.classList.remove('d-none');
        actionButtons.style.cssText = 'display: flex !important;';
        uploadBtn.disabled = false;
      } else {
        cancelEdit();
      }
    }
    
    function cancelEdit() {
      isEditing = false;
      const inputs = ['firstName', 'middleName', 'lastName', 'address', 'email'];
      const editBtn = document.getElementById('editBtn');
      const actionButtons = document.getElementById('actionButtons');
      const uploadBtn = document.getElementById('uploadBtn');
      
      // Restore original values
      inputs.forEach(id => {
        document.getElementById(id).value = originalValues[id];
        document.getElementById(id).disabled = true;
      });
      
      editBtn.innerHTML = '<i class="bi bi-pencil me-1"></i> Edit';
      actionButtons.style.cssText = 'display: none !important;';
      uploadBtn.disabled = true;
    }
    
    document.getElementById('profileForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Simulate save
      const inputs = ['firstName', 'middleName', 'lastName', 'address', 'email'];
      inputs.forEach(id => {
        document.getElementById(id).disabled = true;
      });
      
      document.getElementById('editBtn').innerHTML = '<i class="bi bi-pencil me-1"></i> Edit';
      document.getElementById('actionButtons').style.cssText = 'display: none !important;';
      document.getElementById('uploadBtn').disabled = true;
      isEditing = false;
      
      // Update profile header
      const firstName = document.getElementById('firstName').value;
      const lastName = document.getElementById('lastName').value;
      const email = document.getElementById('email').value;
      
      document.querySelector('.profile-name').textContent = `${firstName} ${lastName}`;
      document.querySelector('.profile-email').textContent = email;
      document.querySelector('.profile-avatar').textContent = `${firstName.charAt(0)}${lastName.charAt(0)}`;
      
      alert('Profile updated successfully!');
    });
  </script>
  
</body>
</html>

<?php
  require_once dirname(__DIR__) . '/layouts/footer.php';
?>
