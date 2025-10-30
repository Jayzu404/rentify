<?php
  require_once dirname(__DIR__) . '/layouts/header.php';
  
  // Backend logic - Replace with actual database queries
  $user_id = $_SESSION['user_id'] ?? 1;
  
  $user_stats = [
    'total_items' => 12,
    'active_rentals' => 5,
    'pending_requests' => 3,
    'total_earnings' => 2450.00
  ];
  
  $pending_requests = [
    [
      'id' => 1,
      'item_name' => 'Canon EOS R5 Camera',
      'item_image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300',
      'renter_name' => 'John Smith',
      'rental_period' => 'Mar 15 - Mar 20',
      'price' => 250.00,
      'requested_at' => '2h ago'
    ],
    [
      'id' => 2,
      'item_name' => 'DJI Mavic Air 2 Drone',
      'item_image' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?w=300',
      'renter_name' => 'Sarah Johnson',
      'rental_period' => 'Mar 18 - Mar 22',
      'price' => 180.00,
      'requested_at' => '5h ago'
    ]
  ];
  
  $my_listings = [
    [
      'id' => 1,
      'name' => 'Canon EOS R5 Camera',
      'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300',
      'category' => 'Photography',
      'price_per_day' => 50.00,
      'status' => 'available',
      'views' => 234,
      'bookings' => 8
    ],
    [
      'id' => 2,
      'name' => 'DJI Mavic Air 2 Drone',
      'image' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?w=300',
      'category' => 'Electronics',
      'price_per_day' => 45.00,
      'status' => 'rented',
      'views' => 189,
      'bookings' => 12
    ],
    [
      'id' => 3,
      'name' => 'MacBook Pro 16" 2023',
      'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300',
      'category' => 'Electronics',
      'price_per_day' => 65.00,
      'status' => 'available',
      'views' => 312,
      'bookings' => 15
    ],
    [
      'id' => 4,
      'name' => 'Mountain Bike - Trek X',
      'image' => 'https://images.unsplash.com/photo-1576435728678-68d0fbf94e91?w=300',
      'category' => 'Sports',
      'price_per_day' => 25.00,
      'status' => 'maintenance',
      'views' => 156,
      'bookings' => 6
    ]
  ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #fafafa;
      color: #1a1a1a;
      line-height: 1.6;
      min-height: 100vh;
    }
    
    .container-main {
      max-width: 1280px;
      margin: 0 auto;
      padding: 40px 24px;
    }
    
    .header-section {
      margin-bottom: 48px;
    }
    
    .header-section h1 {
      font-size: 32px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 8px;
      letter-spacing: -0.5px;
    }
    
    .header-section p {
      font-size: 15px;
      color: #666;
      font-weight: 400;
    }
    
    .stats-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 48px;
    }
    
    .stat-box {
      background: white;
      border: 1px solid #e5e5e5;
      padding: 24px;
      border-radius: 8px;
      transition: border-color 0.2s;
    }
    
    .stat-box:hover {
      border-color: #1a1a1a;
    }
    
    .stat-label {
      font-size: 13px;
      color: #666;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
    }
    
    .stat-value {
      font-size: 28px;
      font-weight: 700;
      color: #1a1a1a;
    }
    
    .section {
      background: white;
      border: 1px solid #e5e5e5;
      border-radius: 8px;
      margin-bottom: 32px;
      overflow: hidden;
    }
    
    .section-header {
      padding: 24px;
      border-bottom: 1px solid #e5e5e5;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .section-title {
      font-size: 18px;
      font-weight: 600;
      color: #1a1a1a;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .notification-badge {
      background: #1a1a1a;
      color: white;
      font-size: 12px;
      padding: 2px 8px;
      border-radius: 12px;
      font-weight: 600;
    }
    
    .btn-add {
      background: #1a1a1a;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .btn-add:hover {
      background: #000;
    }
    
    .section-content {
      padding: 24px;
    }
    
    .request-item {
      display: grid;
      grid-template-columns: 80px 1fr auto;
      gap: 20px;
      padding: 20px 0;
      border-bottom: 1px solid #f0f0f0;
      align-items: center;
    }
    
    .request-item:last-child {
      border-bottom: none;
    }
    
    .request-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
    }
    
    .request-details h3 {
      font-size: 15px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 6px;
    }
    
    .request-meta {
      font-size: 14px;
      color: #666;
      display: flex;
      gap: 16px;
      margin-bottom: 4px;
    }
    
    .request-price {
      font-size: 18px;
      font-weight: 700;
      color: #1a1a1a;
    }
    
    .request-actions {
      display: flex;
      gap: 12px;
    }
    
    .btn-action {
      padding: 8px 16px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
      background: white;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
    }
    
    .btn-accept {
      background: #1a1a1a;
      color: white;
      border-color: #1a1a1a;
    }
    
    .btn-accept:hover {
      background: #000;
    }
    
    .btn-decline:hover {
      border-color: #1a1a1a;
      background: #f5f5f5;
    }
    
    .listings-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }
    
    .listing-card {
      border: 1px solid #e5e5e5;
      border-radius: 8px;
      overflow: hidden;
      transition: border-color 0.2s;
      background: white;
    }
    
    .listing-card:hover {
      border-color: #1a1a1a;
    }
    
    .listing-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-bottom: 1px solid #e5e5e5;
    }
    
    .listing-body {
      padding: 20px;
    }
    
    .listing-header {
      display: flex;
      justify-content: space-between;
      align-items: start;
      margin-bottom: 8px;
      gap: 12px;
    }
    
    .listing-name {
      font-size: 15px;
      font-weight: 600;
      color: #1a1a1a;
      line-height: 1.4;
    }
    
    .status-indicator {
      font-size: 11px;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      white-space: nowrap;
    }
    
    .status-indicator.available {
      background: #f0f9ff;
      color: #0369a1;
    }
    
    .status-indicator.rented {
      background: #fef3c7;
      color: #92400e;
    }
    
    .status-indicator.maintenance {
      background: #f3f4f6;
      color: #4b5563;
    }
    
    .listing-category {
      font-size: 13px;
      color: #666;
      margin-bottom: 12px;
    }
    
    .listing-price {
      font-size: 20px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 16px;
    }
    
    .listing-price span {
      font-size: 13px;
      font-weight: 500;
      color: #666;
    }
    
    .listing-stats {
      display: flex;
      gap: 16px;
      padding-top: 16px;
      border-top: 1px solid #f0f0f0;
      font-size: 13px;
      color: #666;
      margin-bottom: 16px;
    }
    
    .listing-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }
    
    .btn-listing {
      padding: 8px 12px;
      font-size: 13px;
      font-weight: 500;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
      background: white;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .btn-listing:hover {
      border-color: #1a1a1a;
      background: #f5f5f5;
    }
    
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #999;
    }
    
    .empty-state i {
      font-size: 48px;
      margin-bottom: 16px;
      opacity: 0.3;
    }
    
    .empty-state h4 {
      font-size: 16px;
      font-weight: 600;
      color: #666;
      margin-bottom: 8px;
    }
    
    .empty-state p {
      font-size: 14px;
      color: #999;
    }
    
    @media (max-width: 1024px) {
      .stats-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 768px) {
      .container-main {
        padding: 24px 16px;
      }
      
      .header-section {
        margin-bottom: 32px;
      }
      
      .header-section h1 {
        font-size: 24px;
      }
      
      .stats-container {
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 32px;
      }
      
      .stat-box {
        padding: 20px;
      }
      
      .section-header {
        padding: 20px 16px;
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
      
      .section-content {
        padding: 16px;
      }
      
      .request-item {
        grid-template-columns: 60px 1fr;
        gap: 12px;
      }
      
      .request-image {
        width: 60px;
        height: 60px;
      }
      
      .request-actions {
        grid-column: 2;
        margin-top: 12px;
        width: 100%;
      }
      
      .btn-action {
        flex: 1;
      }
      
      .listings-grid {
        grid-template-columns: 1fr;
      }
    }
    
    @media (max-width: 480px) {
      .request-meta {
        flex-direction: column;
        gap: 4px;
      }
      
      .stat-value {
        font-size: 24px;
      }
    }
  </style>
  <title>Dashboard | Rentify</title>
</head>
<body>
  <div class="container-main">
    
    <!-- Header -->
    <div class="header-section">
      <h1>Dashboard</h1>
      <p>Manage your rental items and requests</p>
    </div>

    <!-- Stats -->
    <div class="stats-container">
      <div class="stat-box">
        <div class="stat-label">Total Items</div>
        <div class="stat-value"><?php echo $user_stats['total_items']; ?></div>
      </div>
      
      <div class="stat-box">
        <div class="stat-label">Active Rentals</div>
        <div class="stat-value"><?php echo $user_stats['active_rentals']; ?></div>
      </div>
      
      <div class="stat-box">
        <div class="stat-label">Pending</div>
        <div class="stat-value"><?php echo $user_stats['pending_requests']; ?></div>
      </div>
      
      <div class="stat-box">
        <div class="stat-label">Earnings</div>
        <div class="stat-value">$<?php echo number_format($user_stats['total_earnings'], 0); ?></div>
      </div>
    </div>

    <!-- Pending Requests -->
    <div class="section">
      <div class="section-header">
        <div class="section-title">
          Rental Requests
          <?php if(count($pending_requests) > 0): ?>
            <span class="notification-badge"><?php echo count($pending_requests); ?></span>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="section-content">
        <?php if(count($pending_requests) > 0): ?>
          <?php foreach($pending_requests as $request): ?>
            <div class="request-item">
              <img src="<?php echo htmlspecialchars($request['item_image']); ?>" alt="<?php echo htmlspecialchars($request['item_name']); ?>" class="request-image">
              
              <div class="request-details">
                <h3><?php echo htmlspecialchars($request['item_name']); ?></h3>
                <div class="request-meta">
                  <span><?php echo htmlspecialchars($request['renter_name']); ?></span>
                  <span><?php echo htmlspecialchars($request['rental_period']); ?></span>
                  <span><?php echo htmlspecialchars($request['requested_at']); ?></span>
                </div>
                <div class="request-price">$<?php echo number_format($request['price'], 0); ?></div>
              </div>
              
              <div class="request-actions">
                <button class="btn-action btn-accept" onclick="handleRequest(<?php echo $request['id']; ?>, 'accept')">
                  Accept
                </button>
                <button class="btn-action btn-decline" onclick="handleRequest(<?php echo $request['id']; ?>, 'decline')">
                  Decline
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h4>No pending requests</h4>
            <p>New rental requests will appear here</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- My Listings -->
    <div class="section">
      <div class="section-header">
        <div class="section-title">My Listings</div>
        <button class="btn-add" onclick="window.location.href='/add-listing.php'">
          Add Item
        </button>
      </div>
      
      <div class="section-content">
        <div class="listings-grid">
          <?php foreach($my_listings as $listing): ?>
            <div class="listing-card">
              <img src="<?php echo htmlspecialchars($listing['image']); ?>" alt="<?php echo htmlspecialchars($listing['name']); ?>" class="listing-image">
              
              <div class="listing-body">
                <div class="listing-header">
                  <div class="listing-name"><?php echo htmlspecialchars($listing['name']); ?></div>
                  <span class="status-indicator <?php echo $listing['status']; ?>">
                    <?php echo ucfirst($listing['status']); ?>
                  </span>
                </div>
                
                <div class="listing-category"><?php echo htmlspecialchars($listing['category']); ?></div>
                
                <div class="listing-price">$<?php echo number_format($listing['price_per_day'], 0); ?><span>/day</span></div>
                
                <div class="listing-stats">
                  <span><?php echo $listing['views']; ?> views</span>
                  <span><?php echo $listing['bookings']; ?> bookings</span>
                </div>
                
                <div class="listing-actions">
                  <button class="btn-listing" onclick="editListing(<?php echo $listing['id']; ?>)">
                    Edit
                  </button>
                  <button class="btn-listing" onclick="deleteListing(<?php echo $listing['id']; ?>)">
                    Delete
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  
  <script>
    function handleRequest(requestId, action) {
      if(confirm(`Are you sure you want to ${action} this rental request?`)) {
        fetch('/api/rental-requests.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            request_id: requestId,
            action: action
          })
        })
        .then(response => response.json())
        .then(data => {
          if(data.success) {
            alert(`Request ${action}ed successfully!`);
            location.reload();
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
        });
      }
    }
    
    function editListing(listingId) {
      window.location.href = `/edit-listing.php?id=${listingId}`;
    }
    
    function deleteListing(listingId) {
      if(confirm('Are you sure you want to delete this listing?')) {
        fetch('/api/listings.php', {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            listing_id: listingId
          })
        })
        .then(response => response.json())
        .then(data => {
          if(data.success) {
            alert('Listing deleted successfully!');
            location.reload();
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
        });
      }
    }
  </script>
</body>
</html>

<?php
  require_once dirname(__DIR__) . '/layouts/footer.php';
?>