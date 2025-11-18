<?php
  require_once dirname(__DIR__) . '/layouts/header.php';

  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $userId = $_SESSION['user']['id'] ?? null;
  
  // Extract data passed from controller
  $items = $data['items'] ?? [];
  $currentPage = $data['currentPage'] ?? 1;
  $totalPages = $data['totalPages'] ?? 1;
  $category = $data['category'] ?? null;
  $search = $data['search'] ?? null;

  // echo '<pre>';
  // var_dump($items);
  // var_dump($_SESSION['user']['id']);
  // var_dump($items['owner_id']);
  // echo '</pre>';
  
  // Helper function for category display
  function getCategoryDisplay($cat) {
    $categories = [
      'pe_costume' => 'PE Costume',
      'sports_gear' => 'Sports Gear',
      'textbook' => 'Textbook / Study Material',
      'uniform' => 'Uniform / Formal Attire',
      'lab_equipment' => 'Lab Equipment',
      'electronics' => 'Electronics',
      'other' => 'Other'
    ];
    return $categories[$cat] ?? ucwords(str_replace('_', ' ', $cat));
  }
  
  // Helper function for rate type
  function getRateDisplay($rate) {
    return str_replace('per_', '', $rate);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Browse Items | Rentify</title>

  <!-- Bootstraps -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Font awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- custom css -->
  <link rel="stylesheet" href="/assets/styles/browse-items.css">
</head>
<body>

<div class="container py-5">
  
  <!-- Page Header -->
  <h2 class="text-center fw-semibold mb-4">Available Rentals</h2>
  
  <!-- Search and Filter Section -->
  <div class="row mb-4">
    <div class="col-md-8 mb-3 mb-md-0">
      <form action="/item/browse" method="GET" class="d-flex gap-2">
        <input 
          type="text" 
          name="search" 
          class="form-control" 
          placeholder="Search items by name, description, or brand..." 
          value="<?= htmlspecialchars($search ?? '') ?>"
        >
        <button type="submit" class="btn btn-primary px-4">
          <i class="bi bi-search"></i> Search
        </button>
        <?php if ($search || $category): ?>
          <a href="/item/browse" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Clear
          </a>
        <?php endif; ?>
      </form>
    </div>
    <div class="col-md-4">
      <select class="form-select" onchange="window.location.href='/item/browse?category=' + this.value">
        <option value="">All Categories</option>
        <option value="pe_costume" <?= $category === 'pe_costume' ? 'selected' : '' ?>>PE Costume</option>
        <option value="sports_gear" <?= $category === 'sports_gear' ? 'selected' : '' ?>>Sports Gear</option>
        <option value="textbook" <?= $category === 'textbook' ? 'selected' : '' ?>>Textbook / Study Material</option>
        <option value="uniform" <?= $category === 'uniform' ? 'selected' : '' ?>>Uniform / Formal Attire</option>
        <option value="lab_equipment" <?= $category === 'lab_equipment' ? 'selected' : '' ?>>Lab Equipment</option>
        <option value="electronics" <?= $category === 'electronics' ? 'selected' : '' ?>>Electronics</option>
        <option value="other" <?= $category === 'other' ? 'selected' : '' ?>>Other</option>
      </select>
    </div>
  </div>

  <!-- Results Count -->
  <?php if ($search || $category): ?>
    <div class="alert alert-info mb-4">
      <i class="bi bi-funnel"></i> 
      Showing <?= count($items) ?> result(s)
      <?php if ($search): ?>
        for "<strong><?= htmlspecialchars($search) ?></strong>"
      <?php endif; ?>
      <?php if ($category): ?>
        in category "<strong><?= getCategoryDisplay($category) ?></strong>"
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <!-- Items Grid -->
  <div class="row g-4">
    <?php if (empty($items)): ?>
      <!-- Empty State -->
      <div class="col-12">
        <div class="text-center py-5">
          <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
          <h4 class="text-muted mt-3">No items found</h4>
          <p class="text-muted">Try adjusting your search or filters</p>
          <a href="/item/browse" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-clockwise"></i> View All Items
          </a>
        </div>
      </div>
    <?php else: ?>
      <!-- Item Cards -->
      <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card rental-card h-100">
            <!-- Item Image -->
            <img 
              src="<?= '/file/image' .  htmlspecialchars($item['primary_image'] ?? '/assets/images/placeholder.png') ?>" 
              alt="<?= htmlspecialchars($item['title']) ?>"
              style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;"
              onclick="window.location.href='/item/detail?id=<?= $item['item_id'] ?>'"
            >
            
            <div class="card-body d-flex flex-column">
              <!-- Title -->
              <h5 class="rental-title"><?= htmlspecialchars($item['title']) ?></h5>
              
              <!-- Category -->
              <p class="rental-category text-primary mb-2">
                <i class="bi bi-tag-fill"></i> 
                <?= getCategoryDisplay($item['category']) ?>
              </p>

              <!-- Description -->
              <p class="rental-description text-muted small mb-3">
                <?php 
                  $description = htmlspecialchars($item['description']);
                  echo mb_strlen($description) > 100 ? mb_substr($description, 0, 100) . '...' : $description;
                ?>
              </p>

              <!-- Price & Availability -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <span class="rental-price fw-bold text-success">₱<?= number_format($item['price'], 2) ?></span>
                  <span class="price-duration text-muted">/<?= getRateDisplay($item['rate_type']) ?></span>
                </div>
                <span class="badge <?= $item['status'] === 'available' ? 'bg-success' : 'bg-warning text-dark' ?>">
                  <?= ucfirst($item['status']) ?>
                </span>
              </div>

              <!-- Owner & Location -->
              <div class="rental-meta mb-3 text-muted small">
                <div class="mb-1">
                  <i class="bi bi-person-circle me-1"></i> 
                  Owned by <strong><?= htmlspecialchars($item['first_name'] . ' ' . substr($item['last_name'], 0, 1)) ?>.</strong>
                </div>
                <div>
                  <i class="bi bi-geo-alt me-1"></i> 
                  <?= htmlspecialchars($item['location']) ?>
                </div>
              </div>

              <!-- Condition Badge -->
              <div class="mb-3">
                <span class="badge <?php
                  switch($item['item_condition']) {
                    case 'brand_new': echo 'bg-primary'; break;
                    case 'like_new': echo 'bg-info'; break;
                    case 'good': echo 'bg-success'; break;
                    case 'fair': echo 'bg-warning text-dark'; break;
                    default: echo 'bg-secondary';
                  }
                ?>">
                  <i class="bi bi-award"></i> 
                  <?= ucwords(str_replace('_', ' ', $item['item_condition'])) ?>
                </span>
              </div>

              <!-- Buttons -->
              <div class="d-flex gap-2 mt-auto">
                <button 
                  class="btn btn-outline-primary w-50" 
                  onclick="window.location.href='/item/detail?id=<?= $item['item_id'] ?>'"
                >
                  <i class="bi bi-eye"></i> View Details
                </button>
                <?php if($userId != $item['owner_id'] && $item['status'] != 'rented'): ?>
                  <button 
                    class="btn btn-primary w-50"
                    onclick="window.location.href='/rental/checkout?item_id=<?= $item['item_id'] ?>'"
                  >
                    <i class="bi bi-cart-plus"></i> Rent Now
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation" class="mt-5">
      <ul class="pagination justify-content-center">
        <!-- Previous Button -->
        <li class="page-item <?= $currentPage === 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="/item/browse?page=<?= $currentPage - 1 ?><?= $category ? '&category=' . urlencode($category) : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        
        <!-- Page Numbers -->
        <?php
          // Show max 5 page numbers
          $startPage = max(1, $currentPage - 2);
          $endPage = min($totalPages, $currentPage + 2);
          
          if ($startPage > 1): ?>
            <li class="page-item">
              <a class="page-link" href="/item/browse?page=1<?= $category ? '&category=' . urlencode($category) : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?>">1</a>
            </li>
            <?php if ($startPage > 2): ?>
              <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>
          <?php endif; ?>
        
        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
          <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
            <a class="page-link" href="/item/browse?page=<?= $i ?><?= $category ? '&category=' . urlencode($category) : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        
        <?php if ($endPage < $totalPages): ?>
          <?php if ($endPage < $totalPages - 1): ?>
            <li class="page-item disabled"><span class="page-link">...</span></li>
          <?php endif; ?>
          <li class="page-item">
            <a class="page-link" href="/item/browse?page=<?= $totalPages ?><?= $category ? '&category=' . urlencode($category) : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?>"><?= $totalPages ?></a>
          </li>
        <?php endif; ?>
        
        <!-- Next Button -->
        <li class="page-item <?= $currentPage === $totalPages ? 'disabled' : '' ?>">
          <a class="page-link" href="/item/browse?page=<?= $currentPage + 1 ?><?= $category ? '&category=' . urlencode($category) : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    
    <!-- Page Info -->
    <div class="text-center text-muted mt-3">
      <small>Page <?= $currentPage ?> of <?= $totalPages ?></small>
    </div>
  <?php endif; ?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  require_once dirname(__DIR__) . '/layouts/footer.php';
?>