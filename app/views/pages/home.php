<?php
  require_once dirname(__DIR__, 3) . '/config/config.php';
  require_once dirname(__DIR__) . '/layouts/header.php';

  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }

  $recentItems = $data['recentItems'] ?? [];    

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

  function getRateDisplay($rate) {
    return str_replace('per_', '', $rate);
  }
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
  <title>Home | Rentify</title>
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
            <h2 class="text-center mb-4 fw-semibold">Browse by Category</h2>
            <div class="row g-4 justify-content-center" id="categories-container">
                
                <!-- PE Costume -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-person-running fa-2x text-primary"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">PE Costume</h6>
                    </div>
                </div>

                <!-- Sports Gear -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-football-ball fa-2x text-danger"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Sports Gear</h6>
                    </div>
                </div>

                <!-- Textbook -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-book fa-2x text-warning"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Textbook</h6>
                    </div>
                </div>

                <!-- Uniform -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-shirt fa-2x text-success"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Uniform</h6>
                    </div>
                </div>

                <!-- Science Equipment -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-flask-vial fa-2x text-info"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Science Equipment</h6>
                    </div>
                </div>

                <!-- Electronics -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-microchip fa-2x text-secondary"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Electronics</h6>
                    </div>
                </div>

                <!-- Other -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="category-card text-center p-3 shadow-sm rounded-4 h-100">
                        <div class="icon-wrapper mb-2 mx-auto">
                            <i class="fa-solid fa-box-open fa-2x text-dark"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Other</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Items -->
        <div class="container mb-5">
            <h2 class="mb-4 fw-semibold">Recently Added</h2>
            <div class="row g-4" id="featured-items">
                <?php if (!empty($recentItems)): ?>
                    <?php foreach ($recentItems as $item): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card rental-card h-100">
                                <!-- Item Image -->
                                <img 
                                    src="<?= htmlspecialchars( '/file/image' . $item['primary_image'] ?? '/assets/images/placeholder.png') ?>" 
                                    alt="<?= htmlspecialchars($item['title']) ?>"
                                    class="rental-card-img"
                                    onclick="window.location.href='/item/detail?id=<?= $item['item_id'] ?>'"
                                >
                            
                                <div class="card-body d-flex flex-column">
                                    <!-- Title -->
                                    <h5 class="rental-title"><?= htmlspecialchars($item['title']) ?></h5>
                                    
                                    <!-- Category -->
                                    <p class="rental-category mb-2">
                                        <i class="bi bi-tag-fill"></i> 
                                        <?= getCategoryDisplay($item['category']) ?>
                                    </p>

                                    <!-- Description -->
                                    <p class="rental-description">
                                        <?php 
                                        $description = htmlspecialchars($item['description']);
                                        echo mb_strlen($description) > 100 ? mb_substr($description, 0, 100) . '...' : $description;
                                        ?>
                                    </p>

                                    <!-- Price & Availability -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <span class="rental-price">₱<?= number_format($item['price'], 2) ?></span>
                                            <span class="price-duration">/<?= getRateDisplay($item['rate_type']) ?></span>
                                        </div>
                                        <span class="availability">
                                            <?= ucfirst($item['status']) ?>
                                        </span>
                                    </div>

                                    <!-- Owner & Location -->
                                    <div class="rental-meta mb-2">
                                        <div class="mb-1">
                                            <i class="bi bi-person-circle"></i> 
                                            Owned by <strong><?= htmlspecialchars($item['first_name'] . ' ' . substr($item['last_name'], 0, 1)) ?>.</strong>
                                        </div>
                                        <div>
                                            <i class="bi bi-geo-alt"></i> 
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
                                            class="btn btn-view flex-fill" 
                                            onclick="window.location.href='/item/detail?id=<?= $item['item_id'] ?>'"
                                        >
                                            <i class="bi bi-eye"></i> View
                                        </button>
                                        <button 
                                            class="btn btn-rent flex-fill"
                                            onclick="window.location.href='/rental/request?item_id=<?= $item['item_id'] ?>'"
                                        >
                                            <i class="bi bi-cart-plus"></i> Rent
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-3">No items available yet. Be the first to list an item!</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  <script src="/assets/main.js"></script>
</body>
</html>

<?php require_once dirname(__DIR__) . '/layouts/footer.php' ?>