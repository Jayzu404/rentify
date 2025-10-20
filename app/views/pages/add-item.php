<?php
  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }

  $errors = $_SESSION['errors'] ?? '';
  $formData = $_SESSION['formData'] ?? '';

  unset($_SESSION['errors'], $_SESSION['formData']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List an Item | Rentify</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: #f8f9fa;
      color: #1a1a1a;
      line-height: 1.6;
      min-height: 100vh;
      padding-bottom: 60px;
      overflow-x: hidden;
    }

    /* Header */
    header {
      background: #ffffff;
      border-bottom: 1px solid #e5e7eb;
      padding: 20px 0;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .header-content {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .back-link {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #6b7280;
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: #1a1a1a;
    }

    .header-title {
      font-size: 18px;
      font-weight: 600;
      color: #1a1a1a;
    }

    /* Main Form Container */
    .form-wrapper {
      max-width: 800px;
      margin: 40px auto;
      padding: 0 24px;
    }

    .form-card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
      padding: 48px;
      border: 1px solid #e5e7eb;
    }

    .form-header {
      margin-bottom: 32px;
    }

    .form-title {
      font-size: 24px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 8px;
    }

    .form-subtitle {
      font-size: 14px;
      color: #6b7280;
      line-height: 1.5;
    }

    /* Divider */
    .divider {
      height: 1px;
      background: #f3f4f6;
      margin: 40px 0;
    }

    /* Image Upload Section */
    .image-upload-section {
      margin-bottom: 24px;
    }

    .upload-area {
      border: 2px dashed #d1d5db;
      border-radius: 12px;
      padding: 32px;
      text-align: center;
      background: #fafafa;
      transition: all 0.2s;
      cursor: pointer;
      position: relative;
    }

    .upload-area:hover {
      border-color: #c88a05;
      background: #fffbf5;
    }

    .upload-area.dragover {
      border-color: #c88a05;
      background: #fffbf5;
      transform: scale(1.01);
    }

    .upload-icon {
      font-size: 48px;
      color: #c88a05;
      margin-bottom: 16px;
    }

    .upload-text {
      font-size: 14px;
      color: #374151;
      font-weight: 500;
      margin-bottom: 4px;
    }

    .upload-subtext {
      font-size: 13px;
      color: #6b7280;
    }

    .upload-requirements {
      font-size: 12px;
      color: #9ca3af;
      margin-top: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .image-preview-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 12px;
      margin-top: 16px;
    }

    .image-preview-item {
      position: relative;
      aspect-ratio: 1;
      border-radius: 8px;
      overflow: hidden;
      border: 2px solid #e5e7eb;
      background: #f9fafb;
    }

    .image-preview-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .image-remove-btn {
      position: absolute;
      top: 6px;
      right: 6px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      border: none;
      border-radius: 50%;
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 16px;
    }

    .image-remove-btn:hover {
      background: #ef4444;
      transform: scale(1.1);
    }

    .primary-badge {
      position: absolute;
      bottom: 6px;
      left: 6px;
      background: #c88a05;
      color: white;
      font-size: 10px;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="file"] {
      display: none;
    }

    /* Form Fields */
    .form-row {
      display: grid;
      gap: 24px;
      margin-bottom: 24px;
    }

    .form-row.cols-2 {
      grid-template-columns: repeat(2, 1fr);
    }

    .form-row.cols-8-4 {
      grid-template-columns: 2fr 1fr;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .required {
      color: #ef4444;
      font-size: 16px;
    }

    .optional {
      color: #9ca3af;
      font-size: 13px;
      font-weight: 400;
    }

    input, select, textarea {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      font-family: inherit;
      color: #1a1a1a;
      background: #ffffff;
      transition: all 0.2s;
    }

    input:hover, select:hover, textarea:hover {
      border-color: #d1d5db;
    }

    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #c88a05;
      box-shadow: 0 0 0 3px rgba(200, 138, 5, 0.08);
    }

    input::placeholder, textarea::placeholder {
      color: #9ca3af;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
      line-height: 1.6;
    }

    .input-group {
      display: flex;
      align-items: stretch;
    }

    .input-prefix {
      background: #f9fafb;
      border: 1.5px solid #e5e7eb;
      border-right: none;
      padding: 11px 14px;
      border-radius: 8px 0 0 8px;
      color: #6b7280;
      font-weight: 500;
      display: flex;
      align-items: center;
      font-size: 14px;
    }

    .input-group input {
      border-radius: 0;
    }

    .input-suffix {
      border-radius: 0 8px 8px 0;
      border-left: none;
      background: #f9fafb;
      color: #6b7280;
      font-size: 14px;
      min-width: 110px;
    }

    .helper-text {
      font-size: 12px;
      color: #6b7280;
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 2px;
    }

    /* Radio Buttons */
    .radio-group {
      display: flex;
      gap: 24px;
      flex-wrap: wrap;
    }

    .radio-option {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .radio-option input[type="radio"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #c88a05;
    }

    .radio-option label {
      cursor: pointer;
      font-weight: 400;
      margin: 0;
    }

    /* Checkbox */
    .checkbox-group {
      display: flex;
      align-items: start;
      gap: 12px;
      padding: 14px 16px;
      background: #fafafa;
      border-radius: 8px;
      border: 1.5px solid #e5e7eb;
    }

    .checkbox-group input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #c88a05;
      margin-top: 2px;
      flex-shrink: 0;
    }

    .checkbox-group label {
      cursor: pointer;
      font-size: 13px;
      line-height: 1.6;
      margin: 0;
      color: #4b5563;
    }

    .checkbox-group a {
      color: #c88a05;
      text-decoration: none;
      font-weight: 500;
    }

    .checkbox-group a:hover {
      text-decoration: underline;
    }

    /* Buttons */
    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 32px;
      border-top: 1px solid #f3f4f6;
      gap: 12px;
      margin-top: 40px;
    }

    .btn {
      padding: 11px 20px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s;
      text-decoration: none;
    }

    .btn-primary {
      background: #c88a05;
      color: #ffffff;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary:hover {
      background: #b47a04;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(200, 138, 5, 0.25);
    }

    .btn-secondary {
      background: #ffffff;
      color: #6b7280;
      border: 1.5px solid #e5e7eb;
    }

    .btn-secondary:hover {
      background: #f9fafb;
      border-color: #d1d5db;
      color: #374151;
    }

    .btn-actions {
      display: flex;
      gap: 12px;
    }

    .error-msg {
      color: #ef4444;
      font-size: 12px;
      margin-top: -4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        background: #ffffff;
      }

      header {
        padding: 16px 0;
      }

      .header-content {
        padding: 0 16px;
      }

      .header-title {
        display: none;
      }

      .form-wrapper {
        margin: 0;
        padding: 0;
      }

      .form-card {
        padding: 24px 16px;
        border-radius: 0;
        box-shadow: none;
        border: none;
      }

      .form-title {
        font-size: 22px;
      }

      .form-header {
        margin-bottom: 24px;
      }

      .divider {
        margin: 32px 0;
      }

      .upload-area {
        padding: 24px 16px;
      }

      .upload-icon {
        font-size: 40px;
      }

      .image-preview-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 8px;
      }

      .form-row.cols-2,
      .form-row.cols-8-4 {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .form-row {
        margin-bottom: 20px;
      }

      .form-actions {
        flex-direction: column;
        gap: 8px;
        padding-top: 24px;
        margin-top: 32px;
      }

      .btn-actions {
        width: 100%;
        flex-direction: column;
        gap: 8px;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }
    }

    /* Validation States */
    input.error, select.error, textarea.error {
      border-color: #ef4444;
    }

    input.error:focus, select.error:focus, textarea.error:focus {
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08);
    }

    .error-message {
      font-size: 12px;
      color: #ef4444;
      margin-top: 2px;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="header-content">
      <a href="/home" class="back-link">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Home</span>
      </a>
      <h1 class="header-title">List an Item</h1>
      <div style="width: 100px;"></div>
    </div>
  </header>

  <!-- Main Form -->
  <div class="form-wrapper">
    <form id="rentifyForm" action="/item/add" method="POST" enctype="multipart/form-data" novalidate>
      
      <div class="form-card">
        
        <!-- Form Header -->
        <div class="form-header">
          <h1 class="form-title">List Your Item</h1>
          <p class="form-subtitle">Provide accurate details to help renters find and trust your listing.</p>
        </div>

        <!-- Image Upload Section -->
        <div class="image-upload-section">
          <div class="form-group">
            <label for="imageInput">Item Photos <span class="required">*</span></label>
            <div class="upload-area" id="uploadArea">
              <div class="upload-icon">
                <i class="bi bi-cloud-upload"></i>
              </div>
              <div class="upload-text">Click to upload</div>
              <div class="upload-subtext">Add up to 3 photos of your item</div>
              <div class="upload-requirements">
                <i class="bi bi-info-circle"></i>
                JPG, PNG or WEBP • Max 5MB per file
              </div>
              <input type="file" id="imageInput" name="itemImages[]" accept="image/jpeg,image/png,image/webp" multiple>
            </div>
            <div class="image-preview-grid" id="imagePreviewGrid"></div>
            <div class="error-msg"><?= htmlspecialchars($errors['itemImages'] ?? ''); ?></div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- Item Name & Quantity -->
        <div class="form-row cols-8-4">
          <div class="form-group">
            <label>Item Name <span class="required">*</span></label>
            <input type="text" name="itemName" placeholder="e.g., Barong Tagalog" required maxlength="255">
            <div class="error-msg"><?= htmlspecialchars($errors['itemName'] ?? ''); ?></div>
          </div>
          <div class="form-group">
            <label>Quantity <span class="required">*</span></label>
            <input type="number" name="quantity" value="1" min="1" max="100" required>
            <div class="error-msg"><?= htmlspecialchars($errors['quantity'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Category & Brand -->
        <div class="form-row cols-2">
          <div class="form-group">
            <label>Category <span class="required">*</span></label>
            <select name="category" required>
              <option value="" disabled selected>Choose a category...</option>
              <option value="pe_costume">PE Costume</option>
              <option value="sports_gear">Sports Gear</option>
              <option value="textbook">Textbook / Study Material</option>
              <option value="uniform">Uniform / Formal Attire</option>
              <option value="lab_equipment">Lab Equipment</option>
              <option value="electronics">Electronics</option>
              <option value="other">Other</option>
            </select>
            <div class="error-msg"><?= htmlspecialchars($errors['category'] ?? ''); ?></div>
          </div>
          <div class="form-group">
            <label>Brand / Model <span class="optional">(Optional)</span></label>
            <input type="text" name="brand" placeholder="e.g., Texas Instruments TI-84" maxlength="100">
            <div class="error-msg"><?= htmlspecialchars($errors['brand'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Condition -->
        <div class="form-row">
          <div class="form-group">
            <label>Condition <span class="required">*</span></label>
            <div class="radio-group">
              <div class="radio-option">
                <input type="radio" name="itemCondition" id="conditionNew" value="brand_new">
                <label for="conditionNew">Brand New</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="itemCondition" id="conditionGood" value="good">
                <label for="conditionGood">Good</label>
              </div>
              <div class="radio-option">
                <input type="radio" name="itemCondition" id="conditionFair" value="fair">
                <label for="conditionFair">Fair</label>
              </div>
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['itemCondition'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Description -->
        <div class="form-row">
          <div class="form-group">
            <label>Description <span class="required">*</span></label>
            <textarea name="description" placeholder="Describe your item's features, condition, and what renters should know..." required minlength="20" maxlength="2000"></textarea>
            <div class="helper-text">
              <i class="bi bi-info-circle"></i>
              Minimum 20 characters. Include specs, condition details, and included accessories.
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['description'] ?? ''); ?></div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- Rental Price & Deposit -->
        <div class="form-row cols-8-4">
          <div class="form-group">
            <label>Rental Price <span class="required">*</span></label>
            <div class="input-group">
              <span class="input-prefix">₱</span>
              <input type="number" name="rentalPrice" placeholder="100" min="1" max="100000" required>
              <select name="priceRate" class="input-suffix" required>
                <option value="day">/ day</option>
                <option value="week">/ week</option>
                <option value="month">/ month</option>
              </select>
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['rentalPrice'] ?? ''); ?></div>
          </div>
          <div class="form-group">
            <label>Security Deposit <span class="optional">(Optional)</span></label>
            <div class="input-group">
              <span class="input-prefix">₱</span>
              <input type="number" name="securityDeposit" placeholder="500" min="0" max="50000">
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['securityDeposit'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Minimum & Maximum Duration -->
        <div class="form-row cols-2">
          <div class="form-group">
            <label>Minimum Rental Duration <span class="required">*</span></label>
            <div class="input-group">
              <input type="number" name="minDuration" placeholder="1" min="1" max="365" required>
              <select name="minDurationUnit" class="input-suffix" required>
                <option value="day">day(s)</option>
                <option value="week">week(s)</option>
                <option value="month">month(s)</option>
              </select>
            </div>
            <div class="helper-text">
              <i class="bi bi-clock-history"></i>
              Shortest rental period you'll accept
            </div>
            <div class="error-msg">
              <?php
                if (!empty($errors['minDuration'])) {
                  echo htmlspecialchars($errors['minDuration']);
                } elseif (!empty($errors['minDurationUnit'])){
                  echo htmlspecialchars($errors['minDurationUnit']);
                }
              ?>
            </div>
          </div>
          <div class="form-group">
            <label>Maximum Rental Duration <span class="optional">(Optional)</span></label>
            <div class="input-group">
              <input type="number" name="maxDuration" placeholder="30" min="1" max="365">
              <select name="maxDurationUnit" class="input-suffix">
                <option value="day">day(s)</option>
                <option value="week">week(s)</option>
                <option value="month">month(s)</option>
              </select>
            </div>
            <div class="helper-text">
              <i class="bi bi-hourglass-split"></i>
              Longest rental period allowed
            </div>
            <div class="error-msg">
              <?php
                if (!empty($errors['maxDuration'])) {
                  echo htmlspecialchars($errors['maxDuration']);
                } elseif (!empty($errors['maxDurationUnit'])){
                  echo htmlspecialchars($errors['maxDurationUnit']);
                }
              ?>
            </div>
          </div>
        </div>

        <!-- Availability Dates -->
        <div class="form-row cols-2">
          <div class="form-group">
            <label>Available From <span class="required">*</span></label>
            <input type="date" name="availableFrom" required>
            <div class="helper-text">
              <i class="bi bi-calendar-check"></i>
              Set when the item becomes available for rent
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['availableFrom'] ?? ''); ?></div>
          </div>

          <div class="form-group">
            <label>Available Until <span class="optional">(Optional)</span></label>
            <input type="date" name="availableUntil">
            <div class="helper-text">
              <i class="bi bi-calendar-x"></i>
              The item will no longer be available after this date
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['availableUntil'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Pickup Location -->
        <div class="form-row">
          <div class="form-group">
            <label>Pickup Location <span class="required">*</span></label>
            <div class="input-group">
              <span class="input-prefix"><i class="bi bi-geo-alt"></i></span>
              <input type="text" name="pickUpLocation" placeholder="e.g., Main Campus, STCS 2nd floor" required maxlength="255">
            </div>
            <div class="helper-text">
              <i class="bi bi-shield-check"></i>
              Must be within BIPSU campus
            </div>
            <div class="error-msg"><?= htmlspecialchars($errors['pickUpLocation'] ?? ''); ?></div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- Return Policy -->
        <div class="form-row">
          <div class="form-group">
            <label>Return Condition Policy <span class="required">*</span></label>
            <textarea name="returnStatement" placeholder="Item must be returned in the same condition as received..." required minlength="20" maxlength="1000" rows="3"></textarea>
            <div class="error-msg"><?= htmlspecialchars($errors['returnStatement'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Cancellation Policy -->
        <div class="form-row">
          <div class="form-group">
            <label>Cancellation Policy <span class="required">*</span></label>
            <select name="cancellationPolicy" required>
              <option value="" disabled selected>Select policy...</option>
              <option value="flexible">Flexible - Full refund up to 24hrs before</option>
              <option value="moderate">Moderate - 50% refund up to 48hrs before</option>
              <option value="strict">Strict - No refunds</option>
            </select>
            <div class="error-msg"><?= htmlspecialchars($errors['cancellationPolicy'] ?? ''); ?></div>
          </div>
        </div>

        <!-- Terms Agreement -->
        <div class="form-row">
          <div class="checkbox-group">
            <input type="checkbox" name="agreeTerms" id="termsAgreement" required>
            <label for="termsAgreement">
              I agree to <a href="/home/terms" target="_blank">Rentify's Terms and Conditions</a> and confirm all information is accurate.
            </label>
          </div>
          <div class="error-msg"><?= htmlspecialchars($errors['agreeTerms'] ?? ''); ?></div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" id="saveDraftBtn">
            <i class="bi bi-file-earmark"></i>
            Save Draft
          </button>
          <div class="btn-actions">
            <button type="button" class="btn btn-secondary" id="previewBtn">
              <i class="bi bi-eye"></i>
              Preview
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle"></i>
              Submit Listing
            </button>
          </div>
        </div>

      </div>

    </form>
  </div>

  <script>
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');

    uploadArea.addEventListener('click', () => {
      imageInput.click();
    })
  </script>
</body>
</html>