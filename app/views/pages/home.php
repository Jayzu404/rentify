<?php
  require_once dirname(__DIR__, 3) . '/config/config.php';
  require_once dirname(__DIR__) . '/layouts/header.php';

  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }
//   unset($_SESSION['isLoggedIn']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= '/assets/styles/app.css'; ?>">
  <title>Home</title>
</head>
<body>
  <main id="main-content">
    <section id="home-page" class="page-section active">
        <!-- Hero Section -->
        <div class="hero-section d-flex align-items-center justify-content-center">
            <div class="container-sm">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Rent and Save.</h1>
                        <p class="lead mb-4">Your community marketplace for renting everyday items. Why buy when you can rent?</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="search-box">
                            <h4 class="mb-3 text-dark">What are you looking for?</h4>
                            <div class="row g-2">
                                <div class="col-8">
                                    <input type="text" class="form-control" placeholder="Search items..." id="searchInput">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-md btn-primary w-100" onclick="RentalApp.search.performSearch()">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        <!-- Categories -->
        <div class="container mb-5">
            <h2 class="text-center mb-4">Browse by Category</h2>
            <div class="row col-12 g-4" id="categories-container">
                <!-- Categories will be loaded here -->
            </div>
        </div>
        <!-- Featured Items -->
        <div class="container mb-5">
            <h2 class="mb-4">Recently Added</h2>
            <div class="row g-4" id="featured-items">
              <?php require_once dirname(__DIR__) . '/components/recently-added.php'; ?>
            </div>
        </div>
    </section>
  </main>  

  <!-- Rentify Modal -->
  <div class="modal fade" id="rentifyModal" tabindex="-1" aria-labelledby="rentifyModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
              
              <!-- Modal Header -->
              <div class="modal-header border-bottom">
                  <div>
                      <h1 class="modal-title fs-4 fw-bold" id="rentifyModalLabel">
                          List an Item for Rent
                      </h1>
                      <p class="text-muted mb-0 small">Provide complete details to help renters trust and find your item.</p>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                  <form id="rentifyForm" novalidate>
                      
                      <!-- 1️⃣ Item Details Section -->
                      <div class="form-section">
                          <h2 class="section-header">
                              <i class="bi bi-box-seam me-2"></i>Item Details
                          </h2>
                          
                          <div class="row g-3">
                              <div class="col-md-8">
                                  <label for="itemTitle" class="form-label">
                                      Item Title/Name <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="text" class="form-control" id="itemTitle" 
                                        placeholder="e.g., Barong Tagalog" 
                                        required aria-required="true">
                                  <div class="invalid-feedback">
                                      Please provide a descriptive item title.
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <label for="itemQuantity" class="form-label">
                                      Quantity <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="number" class="form-control" id="itemQuantity" 
                                        min="1" value="1" required aria-required="true">
                                  <div class="invalid-feedback">
                                      Quantity must be at least 1.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="itemCategory" class="form-label">
                                      Category <span class="required-asterisk">*</span>
                                  </label>
                                  <select class="form-select" id="itemCategory" required aria-required="true">
                                      <option value="" selected disabled>Choose a category...</option>
                                      <option value="laptop">PE custome</option>
                                      <option value="calculator">Sport Gear</option>
                                      <option value="textbook">Textbook / Study Material</option>
                                      <option value="uniform">Uniform / Formal Attire</option>
                                      <option value="lab">Lab Equipment</option>
                                      <option value="other">Other</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Please select a category.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="itemBrand" class="form-label">
                                      Brand / Model
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <input type="text" class="form-control" id="itemBrand" 
                                        placeholder="e.g., Texas Instruments TI-84">
                              </div>
                              
                              <div class="col-12">
                                  <label class="form-label">
                                      Condition <span class="required-asterisk">*</span>
                                  </label>
                                  <div class="d-flex flex-wrap gap-3">
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="itemCondition" 
                                                id="conditionNew" value="new" required>
                                          <label class="form-check-label" for="conditionNew">
                                              Brand New
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="itemCondition" 
                                                id="conditionLikeNew" value="likenew">
                                          <label class="form-check-label" for="conditionLikeNew">
                                              Like New
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="itemCondition" 
                                                id="conditionGood" value="good">
                                          <label class="form-check-label" for="conditionGood">
                                              Good
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="itemCondition" 
                                                id="conditionFair" value="fair">
                                          <label class="form-check-label" for="conditionFair">
                                              Fair
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="itemCondition" 
                                                id="conditionParts" value="parts">
                                          <label class="form-check-label" for="conditionParts">
                                              For Parts
                                          </label>
                                      </div>
                                  </div>

                                  <div class="invalid-feedback d-block" id="conditionError" style="display: none !important;">
                                      Please select a condition.
                                  </div>
                              </div>

                              <div class="col-6">
                                    <label class="form-label">
                                      Item image <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="proofOwnership" 
                                        accept="image/*,.pdf">
                                    <small class="helper-text">
                                        Upload a clear photo of the actual item you’re listing. This serves as proof of ownership and helps renters verify the item’s condition.
                                    </small>
                              </div>
                              
                              <div class="col-12">
                                  <label for="itemDescription" class="form-label">
                                      Description <span class="required-asterisk">*</span>
                                  </label>
                                  <textarea class="form-control" id="itemDescription" rows="4" 
                                            placeholder="Describe your item's features, specifications, and any important details renters should know..." 
                                            required aria-required="true"></textarea>
                                  <small class="helper-text">
                                      <i class="bi bi-info-circle me-1"></i>Include details about functionality, wear and tear, and what's included
                                  </small>
                                  <div class="invalid-feedback">
                                      Please provide a detailed description.
                                  </div>
                              </div>
                          </div>
                      </div>

                      <hr class="text-muted my-4">

                      <!-- 2️⃣ Rental Terms Section -->
                      <div class="form-section">
                          <h2 class="section-header">
                              <i class="bi bi-calendar-check me-2"></i>Rental Terms
                          </h2>
                          
                          <div class="row g-3">
                              <div class="col-md-8">
                                  <label for="rentalPrice" class="form-label">
                                      Rental Price <span class="required-asterisk">*</span>
                                  </label>
                                  <div class="input-group">
                                      <span class="input-group-text">₱</span>
                                      <input type="number" class="form-control" id="rentalPrice" 
                                            placeholder="100" min="0" step="0.01" required aria-required="true">
                                      <select class="form-select" id="pricePeriod" style="max-width: 120px;" required>
                                          <option value="day">/ day</option>
                                          <option value="week">/ week</option>
                                          <option value="month">/ month</option>
                                      </select>
                                  </div>
                                  <div class="invalid-feedback">
                                      Please set a rental price.
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <label for="securityDeposit" class="form-label">
                                      Security Deposit
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <div class="input-group">
                                      <span class="input-group-text">₱</span>
                                      <input type="number" class="form-control" id="securityDeposit" 
                                            placeholder="500" min="0">
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="minDuration" class="form-label">
                                      Minimum Rental Duration <span class="required-asterisk">*</span>
                                  </label>
                                  <select class="form-select" id="minDuration" required aria-required="true">
                                      <option value="" selected disabled>Select minimum...</option>
                                      <option value="1day">1 Day</option>
                                      <option value="3days">3 Days</option>
                                      <option value="1week">1 Week</option>
                                      <option value="1month">1 Month</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Please select a minimum duration.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="maxDuration" class="form-label">
                                      Maximum Rental Duration
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <select class="form-select" id="maxDuration">
                                      <option value="" selected>No maximum</option>
                                      <option value="1week">1 Week</option>
                                      <option value="1month">1 Month</option>
                                      <option value="3months">3 Months</option>
                                      <option value="6months">6 Months</option>
                                  </select>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="lateReturnFee" class="form-label">
                                      Late Return Fee (per day)
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <div class="input-group">
                                      <span class="input-group-text">₱</span>
                                      <input type="number" class="form-control" id="lateReturnFee" 
                                            placeholder="50" min="0">
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="deliveryOption" class="form-label">
                                      Delivery / Pickup <span class="required-asterisk">*</span>
                                  </label>
                                  <select class="form-select" id="deliveryOption" required aria-required="true">
                                      <option value="" selected disabled>Select option...</option>
                                      <option value="pickup">Pickup Only</option>
                                      <option value="delivery" disabled>Delivery Available (+Fee)</option>
                                      <option value="both" disabled>Both Options Available</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Please select a delivery option.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="availableFrom" class="form-label">
                                      Available From <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="date" class="form-control" id="availableFrom" 
                                        required aria-required="true">
                                  <div class="invalid-feedback">
                                      Please select an availability date.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="availableUntil" class="form-label">
                                      Available Until
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <input type="date" class="form-control" id="availableUntil">
                              </div>
                              
                              <div class="col-12">
                                  <label for="pickupLocation" class="form-label">
                                      Pickup Location <span class="required-asterisk">*</span>
                                  </label>
                                  <div class="input-group">
                                      <span class="input-group-text">
                                          <i class="bi bi-geo-alt"></i>
                                      </span>
                                      <input type="text" class="form-control" id="pickupLocation" 
                                            placeholder="e.g., Main Campus, STCS 2nd floor" 
                                            required aria-required="true">
                                  </div>
                                  <small class="helper-text">
                                      <i class="bi bi-shield-check me-1"></i>Inside BIPSU only (as of now)
                                  </small>
                                  <div class="invalid-feedback">
                                      Please provide a pickup location.
                                  </div>
                              </div>
                          </div>
                      </div>

                      <hr class="text-muted my-4">

                      <!-- 3️⃣ Media & Verification Section -->
                      <div class="form-section">
                          <h2 class="section-header">
                              <i class="bi bi-camera me-2"></i>Media & Verification
                          </h2>
                          
                          <div class="row g-3">
                              <div class="col-12">
                                  <label for="itemPhotos" class="form-label">
                                      Upload Photos (Up to 5) <span class="required-asterisk">*</span>
                                  </label>
                                  <div class="file-upload-preview">
                                      <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                      <p class="mb-2 mt-2">Drag and drop files or click to browse</p>
                                      <input type="file" class="form-control" id="itemPhotos" 
                                            multiple accept="image/*" required aria-required="true">
                                      <small class="helper-text">
                                          Accepted formats: JPG, PNG, WEBP (Max 5 files)
                                      </small>
                                  </div>
                                  <div id="photoPreviewCount" class="mt-2 text-muted small"></div>
                                  <div class="invalid-feedback">
                                      Please upload at least one photo.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="proofOwnership" class="form-label">
                                      Proof of Ownership
                                      <small class="text-muted">(Optional)</small>
                                  </label>
                                  <input type="file" class="form-control" id="proofOwnership" 
                                        accept="image/*,.pdf">
                                  <small class="helper-text">
                                      Receipt, warranty, or purchase document
                                  </small>
                              </div>
                          </div>
                      </div>

                      <hr class="text-muted my-4">

                      <!-- 4️⃣ Contact & Owner Info Section -->
                      <div class="form-section">
                          <h2 class="section-header">
                              <i class="bi bi-person-badge me-2"></i>Contact & Owner Info
                          </h2>
                          
                          <div class="row g-3">
                              <div class="col-md-6">
                                  <label for="ownerName" class="form-label">
                                      Full Name <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="text" class="form-control" id="ownerName" 
                                        value="Juan Dela Cruz" required aria-required="true">
                                  <div class="invalid-feedback">
                                      Please provide your full name.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="contactNumber" class="form-label">
                                      Contact Number <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="tel" class="form-control" id="contactNumber" 
                                        placeholder="+63 912 345 6789" required aria-required="true">
                                  <div class="invalid-feedback">
                                      Please provide a valid contact number.
                                  </div>
                              </div>
                              
                              <div class="col-12">
                                  <label for="schoolOrg" class="form-label">
                                      School / Organization <span class="required-asterisk">*</span>
                                  </label>
                                  <input type="text" class="form-control" id="schoolOrg" 
                                        placeholder="e.g., University of the Philippines Manila" 
                                        required aria-required="true">
                                  <div class="invalid-feedback">
                                      Please provide your school or organization.
                                  </div>
                              </div>
                              
                              <div class="col-12">
                                  <label class="form-label">
                                      Preferred Communication Methods <span class="required-asterisk">*</span>
                                  </label>
                                  <div class="d-flex flex-wrap gap-3">
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="commChat" 
                                                name="communication" value="chat">
                                          <label class="form-check-label" for="commChat">
                                              <i class="bi bi-chat-dots me-1"></i>In-App Chat
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="commSMS" 
                                                name="communication" value="sms">
                                          <label class="form-check-label" for="commSMS">
                                              <i class="bi bi-envelope me-1"></i>SMS
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="commCall" 
                                                name="communication" value="call">
                                          <label class="form-check-label" for="commCall">
                                              <i class="bi bi-telephone me-1"></i>Phone Call
                                          </label>
                                      </div>
                                  </div>
                                  <small class="helper-text">Select at least one method</small>
                              </div>
                          </div>
                      </div>

                      <hr class="text-muted my-4">

                      <!-- 5️⃣ Safety & Policies Section -->
                      <div class="form-section">
                          <h2 class="section-header">
                              <i class="bi bi-shield-check me-2"></i>Safety & Policies
                          </h2>
                          
                          <div class="row g-3">
                              <div class="col-12">
                                  <label for="returnPolicy" class="form-label">
                                      Return Condition Policy <span class="required-asterisk">*</span>
                                  </label>
                                  <textarea class="form-control" id="returnPolicy" rows="3" 
                                            placeholder="e.g., Item must be returned in the same condition as received. Any damage will be deducted from the security deposit." 
                                            required aria-required="true"></textarea>
                                  <small class="helper-text">
                                      <i class="bi bi-info-circle me-1"></i>Clearly state your expectations for item return
                                  </small>
                                  <div class="invalid-feedback">
                                      Please provide a return policy.
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <label for="cancellationPolicy" class="form-label">
                                      Cancellation Policy <span class="required-asterisk">*</span>
                                  </label>
                                  <select class="form-select" id="cancellationPolicy" required aria-required="true">
                                      <option value="" selected disabled>Select policy...</option>
                                      <option value="flexible">Flexible - Full refund up to 24hrs before</option>
                                      <option value="moderate">Moderate - 50% refund up to 48hrs before</option>
                                      <option value="strict">Strict - No refunds</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Please select a cancellation policy.
                                  </div>
                              </div>
                              
                              <div class="col-12 mt-4">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="termsAgreement" 
                                            required aria-required="true">
                                      <label class="form-check-label" for="termsAgreement">
                                          I agree to <a href="#" class="text-decoration-none">Rentify's Terms and Conditions</a> 
                                          <span class="required-asterisk">*</span>
                                      </label>
                                      <div class="invalid-feedback">
                                          You must agree to the terms before submitting.
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </form>
              </div>

              <!-- Modal Footer -->
              <div class="modal-footer border-top bg-light">
                  <button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">
                      <i class="bi bi-file-earmark me-2"></i>Save as Draft
                  </button>
                  <div class="ms-auto d-flex gap-2">
                      <button type="button" class="btn btn-outline-primary" id="previewBtn">
                          <i class="bi bi-eye me-2"></i>Preview
                      </button>
                      <button type="button" class="btn btn-primary" id="submitBtn" >
                          <i class="bi bi-check-circle me-2"></i>Submit Listing
                      </button>
                  </div>
              </div>

          </div>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  <script src="/assets/main.js"></script>
</html>

<?php require_once dirname(__DIR__) . '/layouts/footer.php' ?>