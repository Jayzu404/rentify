<?php
  require_once dirname(__DIR__, 3) . '/config/config.php';
  require_once dirname(__DIR__) . '/layouts/header.php';

  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                                    <button class="btn btn-sm btn-primary w-100" onclick="RentalApp.search.performSearch()">
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
              <!-- Featured items will be loaded here -->
            </div>
        </div>
    </section>
  </main>  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php require_once dirname(__DIR__) . '/layouts/footer.php' ?>