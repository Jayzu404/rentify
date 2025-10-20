<?php
  // Security: Start session and verify user authentication
  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }

  $rawItem = $data['item'] ?? null;

  if(!$item) {
    header('Location: /item/browse');
    exit;
  }
  
  $item = [
    'id' => $rawItem['item_id'],
    'name' => $rawItem['title'],
    'category' => $rawItem['category'],
    'category_display' => ucfirst($rawItem['category']),
    'brand' => $rawItem['brand'] ?? null,
    'condition' => $rawItem['item_condition'],
    'condition_display' => ucfirst($rawItem['item_condition']),
    'quantity' => $rawItem['quantity'],
    'quantity_available' => $rawItem['quantity'],
    'rental_price' => (float)$rawItem['price'],
    'price_rate' => $rawItem['rate_type'],
    'security_deposit' => (float)($rawItem['security_deposit'] ?? 0),
    'min_duration' => (int)$rawItem['minimum_duration'],
    'min_duration_unit' => $rawItem['minimum_duration_unit'],
    'max_duration' => $rawItem['maximum_duration'] ? (int)$rawItem['maximum_duration'] : null,
    'max_duration_unit' => $rawItem['maximum_duration_unit'] ?? null,
    'available_from' => $rawItem['available_from'],
    'available_until' => $rawItem['available_until'],
    'pickup_location' => $rawItem['location'],
    'description' => $rawItem['description'],
    'return_statement' => $rawItem['return_statement'] ?? 'Item must be returned in the same condition.',
    'cancellation_policy' => $rawItem['cancellation_policy'] ?? 'flexible',
    'cancellation_display' => 'Flexible - Full refund up to 24hrs before',
    'status' => $rawItem['status'],
    'images' => array_map(function($img) {
      return $img['path'];
    }, $rawItem['images']),
    'owner' => [
      'id' => $rawItem['owner_uid'],
      'name' => $rawItem['first_name'] . ' ' . $rawItem['last_name'],
      'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($rawItem['first_name'] . '+' . $rawItem['last_name']) . '&background=c88a05&color=fff&size=200',
      'member_since' => $rawItem['created_at'] ?? '2024-08-15',
      'verified' => true,
      'rating' => 4.8,
      'total_rentals' => 24
    ],
    'date_posted' => $rawItem['created_at'],
    'last_updated' => $rawItem['updated_at'] ?? $rawItem['created_at'],
    'views' => 0
  ];

  // Check if current user is the owner
  $currentUserId = $_SESSION['user_id'] ?? null;
  $isOwner = $currentUserId && $currentUserId == $item['owner']['id'];
  $isLoggedIn = !empty($currentUserId);

  // Format dates
  $datePosted = date('F j, Y', strtotime($item['date_posted']));
  $memberSince = date('F Y', strtotime($item['owner']['member_since']));
  $availableFrom = date('M j, Y', strtotime($item['available_from']));
  $availableUntil = $item['available_until'] ? date('M j, Y', strtotime($item['available_until'])) : 'No end date';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($item['name']) ?> | Rentify</title>
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
      max-width: 1200px;
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

    .header-actions {
      display: flex;
      gap: 12px;
    }

    .header-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
      text-decoration: none;
    }

    .header-btn-ghost {
      background: transparent;
      color: #6b7280;
      border: 1.5px solid #e5e7eb;
    }

    .header-btn-ghost:hover {
      background: #f9fafb;
      color: #1a1a1a;
      border-color: #d1d5db;
    }

    /* Breadcrumb */
    .breadcrumb-container {
      max-width: 1200px;
      margin: 24px auto;
      padding: 0 24px;
    }

    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: #6b7280;
      flex-wrap: wrap;
    }

    .breadcrumb a {
      color: #6b7280;
      text-decoration: none;
      transition: color 0.2s;
    }

    .breadcrumb a:hover {
      color: #c88a05;
    }

    .breadcrumb-separator {
      color: #d1d5db;
    }

    .breadcrumb-current {
      color: #1a1a1a;
      font-weight: 500;
    }

    /* Main Container */
    .container {
      max-width: 1200px;
      margin: 0 auto 60px;
      padding: 0 24px;
    }

    .content-grid {
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 32px;
    }

    /* Image Gallery */
    .gallery-section {
      background: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid #e5e7eb;
    }

    .main-image-container {
      position: relative;
      width: 100%;
      height: 500px;
      background: #f9fafb;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .main-image {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .status-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .status-available {
      background: #10b981;
      color: white;
    }

    .status-rented {
      background: #f59e0b;
      color: white;
    }

    .status-unavailable {
      background: #6b7280;
      color: white;
    }

    .thumbnail-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
      gap: 8px;
      padding: 16px;
      background: #fafafa;
      border-top: 1px solid #e5e7eb;
    }

    .thumbnail {
      aspect-ratio: 1;
      border-radius: 8px;
      overflow: hidden;
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.2s;
    }

    .thumbnail:hover {
      border-color: #c88a05;
      transform: scale(1.05);
    }

    .thumbnail.active {
      border-color: #c88a05;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Item Details */
    .details-section {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .card {
      background: #ffffff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 24px;
    }

    .item-header {
      margin-bottom: 20px;
    }

    .item-title {
      font-size: 28px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 12px;
      line-height: 1.3;
    }

    .item-meta {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
      font-size: 14px;
      color: #6b7280;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .meta-divider {
      width: 1px;
      height: 16px;
      background: #d1d5db;
    }

    .category-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #f3f4f6;
      color: #374151;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    /* Pricing Section */
    .pricing-section {
      padding: 20px 0;
      border-top: 1px solid #f3f4f6;
      border-bottom: 1px solid #f3f4f6;
    }

    .rental-price {
      font-size: 36px;
      font-weight: 700;
      color: #1a1a1a;
      line-height: 1;
      margin-bottom: 4px;
    }

    .price-rate {
      font-size: 16px;
      color: #6b7280;
      font-weight: 400;
    }

    .deposit-info {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 12px;
      padding: 12px;
      background: #fffbf5;
      border-radius: 8px;
      border: 1px solid #fef3c7;
    }

    .deposit-info i {
      color: #f59e0b;
      font-size: 18px;
    }

    .deposit-text {
      font-size: 14px;
      color: #92400e;
    }

    .deposit-amount {
      font-weight: 600;
      color: #78350f;
    }

    /* Info Grid */
    .info-grid {
      display: grid;
      gap: 16px;
    }

    .info-item {
      display: grid;
      grid-template-columns: 140px 1fr;
      gap: 12px;
      font-size: 14px;
    }

    .info-label {
      color: #6b7280;
      font-weight: 500;
    }

    .info-value {
      color: #1a1a1a;
      font-weight: 500;
    }

    .condition-good {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #059669;
    }

    .condition-fair {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #d97706;
    }

    .condition-new {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #7c3aed;
    }

    /* Description */
    .description-section {
      margin-top: 8px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .description-text {
      font-size: 14px;
      color: #4b5563;
      line-height: 1.7;
      white-space: pre-line;
    }

    /* Policies Section */
    .policy-item {
      padding: 16px;
      background: #fafafa;
      border-radius: 8px;
      margin-bottom: 12px;
    }

    .policy-title {
      font-size: 14px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .policy-text {
      font-size: 13px;
      color: #6b7280;
      line-height: 1.6;
    }

    /* Owner Card */
    .owner-section {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .owner-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #e5e7eb;
    }

    .owner-info {
      flex: 1;
    }

    .owner-name {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .verified-badge {
      color: #3b82f6;
      font-size: 16px;
    }

    .owner-meta {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 13px;
      color: #6b7280;
      flex-wrap: wrap;
    }

    .rating {
      display: flex;
      align-items: center;
      gap: 4px;
      color: #f59e0b;
      font-weight: 600;
    }

    .contact-owner-btn {
      margin-top: 16px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px;
      background: #f9fafb;
      border: 1.5px solid #e5e7eb;
      border-radius: 8px;
      color: #374151;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .contact-owner-btn:hover {
      background: #f3f4f6;
      border-color: #d1d5db;
    }

    /* Action Buttons */
    .action-section {
      position: sticky;
      top: 100px;
    }

    .btn {
      width: 100%;
      padding: 14px 20px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s;
      text-decoration: none;
    }

    .btn-primary {
      background: #c88a05;
      color: #ffffff;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary:hover:not(:disabled) {
      background: #b47a04;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(200, 138, 5, 0.25);
    }

    .btn-primary:disabled {
      background: #d1d5db;
      cursor: not-allowed;
    }

    .btn-secondary {
      background: #ffffff;
      color: #374151;
      border: 1.5px solid #e5e7eb;
      margin-top: 12px;
    }

    .btn-secondary:hover {
      background: #f9fafb;
      border-color: #d1d5db;
    }

    .btn-outline {
      background: transparent;
      color: #6b7280;
      border: 1.5px solid #e5e7eb;
    }

    .btn-outline:hover {
      background: #f9fafb;
      border-color: #d1d5db;
    }

    .owner-actions {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    /* Availability Calendar */
    .availability-section {
      padding: 16px;
      background: #f0fdf4;
      border-radius: 8px;
      border: 1px solid #bbf7d0;
      margin-top: 16px;
    }

    .availability-title {
      font-size: 14px;
      font-weight: 600;
      color: #166534;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .date-range {
      font-size: 13px;
      color: #166534;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Duration Info */
    .duration-info {
      display: flex;
      flex-direction: column;
      gap: 8px;
      padding: 16px;
      background: #fafafa;
      border-radius: 8px;
      font-size: 13px;
      margin-top: 16px;
    }

    .duration-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .duration-label {
      color: #6b7280;
    }

    .duration-value {
      color: #1a1a1a;
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .content-grid {
        grid-template-columns: 1fr;
      }

      .action-section {
        position: static;
        margin-top: 24px;
      }

      /* Mobile sticky bottom bar for primary action */
      .mobile-action-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 12px 16px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        z-index: 90;
        display: flex;
        gap: 12px;
        align-items: center;
      }

      body {
        padding-bottom: 80px;
      }

      .main-image-container {
        height: 400px;
      }

      .item-title {
        font-size: 24px;
      }

      .rental-price {
        font-size: 32px;
      }

      .info-item {
        grid-template-columns: 120px 1fr;
        gap: 8px;
      }

      .owner-meta {
        font-size: 12px;
      }

      .deposit-info {
        font-size: 13px;
      }
    }

    @media (max-width: 640px) {
      .header-content {
        padding: 0 16px;
      }

      .breadcrumb-container {
        padding: 0 16px;
      }

      .container {
        padding: 0 16px;
      }

      .card {
        padding: 20px 16px;
      }

      .main-image-container {
        height: 300px;
      }

      .item-title {
        font-size: 22px;
      }

      .rental-price {
        font-size: 28px;
      }

      .thumbnail-gallery {
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        padding: 12px;
      }

      .header-btn span {
        display: none;
      }

      .info-item {
        grid-template-columns: 1fr;
        gap: 4px;
      }

      .owner-section {
        flex-direction: column;
        text-align: center;
        gap: 12px;
      }

      .owner-meta {
        flex-direction: column;
        gap: 4px;
      }

      .meta-divider {
        display: none;
      }

      .item-meta {
        font-size: 13px;
      }

      .duration-info {
        font-size: 12px;
      }

      .availability-section {
        padding: 12px;
      }

      .policy-item {
        padding: 12px;
      }

      body {
        padding-bottom: 75px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="header-content">
      <a href="/item/browse" class="back-link">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Browsing</span>
      </a>
      <div class="header-actions">
        <button class="header-btn header-btn-ghost" onclick="shareItem()">
          <i class="bi bi-share"></i>
          <span>Share</span>
        </button>
        <button class="header-btn header-btn-ghost" onclick="reportItem()">
          <i class="bi bi-flag"></i>
          <span>Report</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="content-grid">
      
      <!-- Left Column: Gallery & Details -->
      <div>
        <!-- Image Gallery -->
        <div class="gallery-section">
          <div class="main-image-container">
            <img id="mainImage" src="<?= '/file/image' . htmlspecialchars($item['images'][0]) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="main-image">
            <span class="status-badge status-<?= htmlspecialchars($item['status']) ?>">
              <?= ucfirst($item['status']) ?>
            </span>
          </div>
          <?php if (count($item['images']) > 1): ?>
          <div class="thumbnail-gallery">
            <?php foreach ($item['images'] as $index => $image): ?>
              <div class="thumbnail <?= $index === 0 ? 'active' : '' ?>" onclick="changeImage('<?= htmlspecialchars($image) ?>', this)">
                <img src="<?= htmlspecialchars($image) ?>" alt="Thumbnail <?= $index + 1 ?>">
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <!-- Item Details Card -->
        <div class="card" style="margin-top: 24px;">
          <div class="item-header">
            <h1 class="item-title"><?= htmlspecialchars($item['name']) ?></h1>
            <div class="item-meta">
              <span class="category-badge">
                <i class="bi bi-tag"></i>
                <?= htmlspecialchars($item['category_display']) ?>
              </span>
              <span class="meta-item">
                <i class="bi bi-eye"></i>
                <?= number_format($item['views']) ?> views
              </span>
              <span class="meta-divider"></span>
              <span class="meta-item">
                <i class="bi bi-calendar3"></i>
                Posted <?= htmlspecialchars($datePosted) ?>
              </span>
            </div>
          </div>

          <!-- Pricing -->
          <div class="pricing-section">
            <div>
              <span class="rental-price">₱<?= number_format($item['rental_price'], 2) ?></span>
              <span class="price-rate">/ <?= htmlspecialchars($item['price_rate']) ?></span>
            </div>
            <?php if ($item['security_deposit'] > 0): ?>
            <div class="deposit-info">
              <i class="bi bi-shield-check"></i>
              <div class="deposit-text">
                Security deposit: <span class="deposit-amount">₱<?= number_format($item['security_deposit'], 2) ?></span>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <!-- Item Information -->
          <div style="margin-top: 24px;">
            <div class="info-grid">
              <?php if ($item['brand']): ?>
              <div class="info-item">
                <span class="info-label">Brand / Model</span>
                <span class="info-value"><?= htmlspecialchars($item['brand']) ?></span>
              </div>
              <?php endif; ?>
              <div class="info-item">
                <span class="info-label">Condition</span>
                <span class="info-value condition-<?= htmlspecialchars($item['condition']) ?>">
                  <i class="bi bi-patch-check"></i>
                  <?= htmlspecialchars($item['condition_display']) ?>
                </span>
              </div>
              <div class="info-item">
                <span class="info-label">Quantity Available</span>
                <span class="info-value"><?= $item['quantity_available'] ?> of <?= $item['quantity'] ?></span>
              </div>
              <div class="info-item">
                <span class="info-label">Pickup Location</span>
                <span class="info-value">
                  <i class="bi bi-geo-alt" style="color: #ef4444;"></i>
                  <?= htmlspecialchars($item['pickup_location']) ?>
                </span>
              </div>
            </div>
          </div>

          <!-- Rental Duration -->
          <div class="duration-info">
            <div class="duration-item">
              <span class="duration-label">
                <i class="bi bi-clock-history"></i> Minimum rental
              </span>
              <span class="duration-value">
                <?= $item['min_duration'] ?> <?= $item['min_duration_unit'] ?><?= $item['min_duration'] > 1 ? 's' : '' ?>
              </span>
            </div>
            <?php if ($item['max_duration']): ?>
            <div class="duration-item">
              <span class="duration-label">
                <i class="bi bi-hourglass-split"></i> Maximum rental
              </span>
              <span class="duration-value">
                <?= $item['max_duration'] ?> <?= $item['max_duration_unit'] ?><?= $item['max_duration'] > 1 ? 's' : '' ?>
              </span>
            </div>
            <?php endif; ?>
          </div>

          <!-- Description -->
          <div class="description-section">
            <h2 class="section-title">
              <i class="bi bi-card-text"></i>
              Description
            </h2>
            <p class="description-text"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
          </div>
        </div>

        <!-- Policies Card -->
        <div class="card" style="margin-top: 24px;">
          <h2 class="section-title">
            <i class="bi bi-file-text"></i>
            Rental Policies
          </h2>
          
          <div class="policy-item">
            <div class="policy-title">
              <i class="bi bi-arrow-return-left"></i>
              Return Condition
            </div>
            <p class="policy-text"><?= nl2br(htmlspecialchars($item['return_statement'])) ?></p>
          </div>

          <div class="policy-item">
            <div class="policy-title">
              <i class="bi bi-x-circle"></i>
              Cancellation Policy
            </div>
            <p class="policy-text"><?= htmlspecialchars($item['cancellation_display']) ?></p>
          </div>
        </div>

        <!-- Owner Card -->
        <div class="card" style="margin-top: 24px;">
          <h2 class="section-title">
            <i class="bi bi-person-circle"></i>
            Listed By
          </h2>
          
          <div class="owner-section">
            <img src="<?= htmlspecialchars($item['owner']['avatar']) ?>" alt="<?= htmlspecialchars($item['owner']['name']) ?>" class="owner-avatar">
            <div class="owner-info">
              <div class="owner-name">
                <?= htmlspecialchars($item['owner']['name']) ?>
                <?php if ($item['owner']['verified']): ?>
                  <i class="bi bi-patch-check-fill verified-badge" title="Verified User"></i>
                <?php endif; ?>
              </div>
              <div class="owner-meta">
                <span class="rating">
                  <i class="bi bi-star-fill"></i>
                  <?= number_format($item['owner']['rating'], 1) ?>
                </span>
                <span class="meta-divider"></span>
                <span><?= $item['owner']['total_rentals'] ?> rentals</span>
                <span class="meta-divider"></span>
                <span>Member since <?= htmlspecialchars($memberSince) ?></span>
              </div>
            </div>
          </div>

          <?php if (!$isOwner && $isLoggedIn): ?>
          <button class="contact-owner-btn" onclick="contactOwner(<?= $item['owner']['id'] ?>)">
            <i class="bi bi-chat-dots"></i>
            Message Owner
          </button>
          <?php endif; ?>
        </div>

      </div>

      <!-- Right Column: Action Panel -->
      <div class="action-section">
        <div class="card">
          
          <!-- Availability Info -->
          <div class="availability-section">
            <div class="availability-title">
              <i class="bi bi-calendar-check"></i>
              Availability Period
            </div>
            <div class="date-range">
              <i class="bi bi-calendar3"></i>
              <?= htmlspecialchars($availableFrom) ?> 
              <?php if ($item['available_until']): ?>
                - <?= htmlspecialchars($availableUntil) ?>
              <?php endif; ?>
            </div>
          </div>

          <?php if (true): ?>
            <!-- Owner Actions -->
            <div class="owner-actions" style="margin-top: 24px;">
              <a href="/item/edit/<?= $item['id'] ?>" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i>
                Edit Listing
              </a>
              <button class="btn btn-secondary" onclick="manageBookings(<?= $item['id'] ?>)">
                <i class="bi bi-calendar-event"></i>
                Manage Bookings
              </button>
              <button class="btn btn-outline" onclick="toggleAvailability(<?= $item['id'] ?>)">
                <i class="bi bi-eye-slash"></i>
                <?= $item['status'] === 'available' ? 'Mark Unavailable' : 'Mark Available' ?>
              </button>
              <button class="btn btn-outline" style="color: #ef4444; border-color: #fee2e2;" onclick="confirmDelete(<?= $item['id'] ?>)">
                <i class="bi bi-trash"></i>
                Delete Listing
              </button>
            </div>

          <?php elseif (true): ?>
            <!-- Renter Actions -->
            <?php if ($item['status'] === 'available' && $item['quantity_available'] > 0): ?>
              <button class="btn btn-primary" style="margin-top: 24px;" onclick="rentItem(<?= $item['id'] ?>)">
                <i class="bi bi-bag-check"></i>
                Rent Now
              </button>
              <button class="btn btn-secondary" onclick="addToWishlist(<?= $item['id'] ?>)">
                <i class="bi bi-heart"></i>
                Add to Wishlist
              </button>
            <?php else: ?>
              <button class="btn btn-primary" style="margin-top: 24px;" disabled>
                <i class="bi bi-x-circle"></i>
                Currently Unavailable
              </button>
              <button class="btn btn-secondary" onclick="notifyWhenAvailable(<?= $item['id'] ?>)">
                <i class="bi bi-bell"></i>
                Notify When Available
              </button>
            <?php endif; ?>

          <?php else: ?>
            <!-- Not Logged In -->
            <a href="/login?redirect=/item/<?= $item['id'] ?>" class="btn btn-primary" style="margin-top: 24px;">
              <i class="bi bi-box-arrow-in-right"></i>
              Login to Rent
            </a>
            <p style="margin-top: 16px; font-size: 13px; color: #6b7280; text-align: center;">
              You need to be logged in to rent this item
            </p>
          <?php endif; ?>

          <!-- Additional Info -->
          <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #f3f4f6;">
            <div style="font-size: 12px; color: #9ca3af; line-height: 1.6;">
              <p style="margin-bottom: 8px;">
                <i class="bi bi-shield-check"></i>
                Protected by Rentify's Rental Guarantee
              </p>
              <p style="margin-bottom: 8px;">
                <i class="bi bi-chat-square-dots"></i>
                24/7 customer support available
              </p>
              <p>
                <i class="bi bi-cash-stack"></i>
                Secure payment processing
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <script>
    // Image Gallery
    function changeImage(imageSrc, thumbnail) {
      document.getElementById('mainImage').src = imageSrc;
      
      // Update active thumbnail
      document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
      thumbnail.classList.add('active');
    }

    // Share Item
    function shareItem() {
      const url = window.location.href;
      const title = <?= json_encode($item['name']) ?>;
      
      if (navigator.share) {
        navigator.share({
          title: title,
          text: 'Check out this rental on Rentify: ' + title,
          url: url
        }).catch(err => console.log('Error sharing:', err));
      } else {
        // Fallback: Copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
          alert('Link copied to clipboard!');
        });
      }
    }

    // Report Item
    function reportItem() {
      if (confirm('Do you want to report this listing? Please provide details about the issue.')) {
        // In production, open a modal with report form
        window.location.href = '/report/item/<?= $item['id'] ?>';
      }
    }

    // Contact Owner
    function contactOwner(ownerId) {
      window.location.href = '/messages/new?recipient=' + ownerId + '&item=<?= $item['id'] ?>';
    }

    // Rent Item
    function rentItem(itemId) {
      window.location.href = '/rental/create/' + itemId;
    }

    // Add to Wishlist
    function addToWishlist(itemId) {
      // AJAX call to add to wishlist
      fetch('/api/wishlist/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
        },
        body: JSON.stringify({ item_id: itemId })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Added to wishlist!');
        } else {
          alert('Failed to add to wishlist: ' + data.message);
        }
      })
      .catch(err => {
        console.error('Error:', err);
        alert('An error occurred. Please try again.');
      });
    }

    // Notify When Available
    function notifyWhenAvailable(itemId) {
      // AJAX call to set notification
      fetch('/api/notifications/item-available', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
        },
        body: JSON.stringify({ item_id: itemId })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('You will be notified when this item becomes available!');
        } else {
          alert('Failed to set notification: ' + data.message);
        }
      })
      .catch(err => {
        console.error('Error:', err);
        alert('An error occurred. Please try again.');
      });
    }

    // Owner Actions
    function manageBookings(itemId) {
      window.location.href = '/owner/bookings?item=' + itemId;
    }

    function toggleAvailability(itemId) {
      const currentStatus = <?= json_encode($item['status']) ?>;
      const newStatus = currentStatus === 'available' ? 'unavailable' : 'available';
      const confirmMsg = newStatus === 'unavailable' 
        ? 'Are you sure you want to mark this item as unavailable?' 
        : 'Are you sure you want to mark this item as available?';
      
      if (confirm(confirmMsg)) {
        // AJAX call to update status
        fetch('/api/item/update-status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
          },
          body: JSON.stringify({ 
            item_id: itemId, 
            status: newStatus 
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Failed to update status: ' + data.message);
          }
        })
        .catch(err => {
          console.error('Error:', err);
          alert('An error occurred. Please try again.');
        });
      }
    }

    function confirmDelete(itemId) {
      if (confirm('Are you sure you want to delete this listing? This action cannot be undone.')) {
        if (confirm('Please confirm again. All booking history and data will be permanently deleted.')) {
          // AJAX call to delete
          fetch('/api/item/delete', {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-Token': '<?= $_SESSION['csrf_token'] ?? '' ?>'
            },
            body: JSON.stringify({ item_id: itemId })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Listing deleted successfully.');
              window.location.href = '/home';
            } else {
              alert('Failed to delete listing: ' + data.message);
            }
          })
          .catch(err => {
            console.error('Error:', err);
            alert('An error occurred. Please try again.');
          });
        }
      }
    }

    // Prevent accidental navigation
    <?php if ($isOwner): ?>
    window.addEventListener('beforeunload', function(e) {
      const editButton = document.querySelector('a[href^="/item/edit"]');
      if (editButton && editButton.matches(':focus')) {
        return; // Allow navigation to edit page
      }
    });
    <?php endif; ?>
  </script>

</body>
</html>