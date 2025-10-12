<link rel="stylesheet" href="/assets/styles/browse-items.css">

<div class="container py-5">
  <div class="row g-4">

    <!-- Dynamic recently added card -->
    <div class="col-md-4 col-sm-6">
      <div class="card rental-card">
        <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238" alt="Scientific Calculator">
        <div class="card-body">
          <h5 class="rental-title">Scientific Calculator</h5>
          <p class="rental-category">School Essentials</p>

          <!-- Short description -->
          <p class="rental-description text-muted small">
            Casio FX-991EX with complete functions, perfect for engineering and math students.
          </p>

          <!-- Price & availability -->
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <span class="rental-price fw-semibold">₱80</span>
              <span class="price-duration">/day</span>
            </div>
            <span class="availability text-success">Available</span>
          </div>

          <!-- Owner & location -->
          <div class="rental-meta mb-2 text-muted small">
            <i class="bi bi-person-circle me-1"></i> Owned by <strong>John D.</strong><br>
            <i class="bi bi-geo-alt me-1"></i> Near FEU Tech, Manila
          </div>

          <!-- Rating -->
          <div class="rental-rating mb-3 text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
            <i class="bi bi-star"></i>
            <span class="text-muted small">(3.5)</span>
          </div>

          <!-- Buttons -->
          <div class="d-flex gap-2">
            <button class="btn btn-view w-50" onclick="window.location.href='/item/detail'">View</button>
            <button class="btn btn-rent w-50">Rent Now</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Rental Card #2 - DSLR Camera -->
    <div class="col-md-4 col-sm-6">
      <div class="card rental-card">
        <img src="https://images.unsplash.com/photo-1502920917128-1aa500764cbd" alt="DSLR Camera">
        <div class="card-body">
          <h5 class="rental-title">DSLR Camera</h5>
          <p class="rental-category">Photography</p>

          <!-- Short description -->
          <p class="rental-description text-muted small">
            Canon EOS 90D with 18-135mm lens. Great for events, portraits, and content creation.
          </p>

          <!-- Price & availability -->
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <span class="rental-price fw-semibold">₱500</span>
              <span class="price-duration">/day</span>
            </div>
            <span class="availability text-success">Available</span>
          </div>

          <!-- Owner & location -->
          <div class="rental-meta mb-2 text-muted small">
            <i class="bi bi-person-circle me-1"></i> Owned by <strong>Maria S.</strong><br>
            <i class="bi bi-geo-alt me-1"></i> Taft Avenue, Manila
          </div>

          <!-- Rating -->
          <div class="rental-rating mb-3 text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <span class="text-muted small">(5.0)</span>
          </div>

          <!-- Buttons -->
          <div class="d-flex gap-2">
            <button class="btn btn-view w-50" onclick="window.location.href='/item/detail'">View</button>
            <button class="btn btn-rent w-50">Rent Now</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Rental Card #3 - Gaming Laptop -->
    <div class="col-md-4 col-sm-6">
      <div class="card rental-card">
        <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302" alt="Gaming Laptop">
        <div class="card-body">
          <h5 class="rental-title">Gaming Laptop</h5>
          <p class="rental-category">Electronics</p>

          <!-- Short description -->
          <p class="rental-description text-muted small">
            ASUS ROG Strix G15, RTX 3060, 16GB RAM. Perfect for gaming, rendering, and heavy tasks.
          </p>

          <!-- Price & availability -->
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <span class="rental-price fw-semibold">₱800</span>
              <span class="price-duration">/day</span>
            </div>
            <span class="availability text-warning">Reserved</span>
          </div>

          <!-- Owner & location -->
          <div class="rental-meta mb-2 text-muted small">
            <i class="bi bi-person-circle me-1"></i> Owned by <strong>Alex P.</strong><br>
            <i class="bi bi-geo-alt me-1"></i> Espana, Manila
          </div>

          <!-- Rating -->
          <div class="rental-rating mb-3 text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
            <span class="text-muted small">(4.5)</span>
          </div>

          <!-- Buttons -->
          <div class="d-flex gap-2">
            <button class="btn btn-view w-50" onclick="window.location.href='/item/detail'">View</button>
            <button class="btn btn-rent w-50">Rent Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>