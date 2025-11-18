<?php
  require_once dirname(__DIR__) . '/layouts/header.php';
  
  // Extract data from controller
  $user_stats = $data['user_stats'] ?? [
    'total_items' => 0,
    'active_rentals' => 0,
    'pending_requests' => 0,
    'total_earnings' => 0.00
  ];
  
  $pending_requests = $data['pending_requests'] ?? [];
  $my_listings = $data['my_listings'] ?? [];
  $my_bookings = $data['my_bookings'] ?? []; // New: bookings data
  
  // Helper function to format condition
  function formatCondition($condition) {
    $conditions = [
      'brand_new' => 'Brand New',
      'like_new' => 'Like New',
      'good' => 'Good',
      'fair' => 'Fair',
      'poor' => 'Poor'
    ];
    return $conditions[$condition] ?? $condition;
  }
  
  // Helper function to format category
  function formatCategory($category) {
    $categories = [
      'pe_costume' => 'PE Costume',
      'sports_gear' => 'Sports Gear',
      'textbook' => 'Textbook',
      'uniform' => 'Uniform',
      'lab_equipment' => 'Lab Equipment',
      'electronics' => 'Electronics',
      'other' => 'Other'
    ];
    return $categories[$category] ?? $category;
  }
  
  // Helper function to calculate days remaining
  function getDaysRemaining($endDate) {
    $now = new DateTime();
    $end = new DateTime($endDate);
    $diff = $now->diff($end);
    return $diff->invert ? 0 : $diff->days;
  }
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
      text-decoration: none;
      display: inline-block;
    }
    
    .btn-add:hover {
      background: #000;
      color: white;
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
    
    .btn-action:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    
    .btn-accept {
      background: #1a1a1a;
      color: white;
      border-color: #1a1a1a;
    }
    
    .btn-accept:hover:not(:disabled) {
      background: #000;
    }
    
    .btn-decline:hover:not(:disabled) {
      border-color: #1a1a1a;
      background: #f5f5f5;
    }

    /* New: Booking Card Styles */
    .booking-card {
      display: grid;
      grid-template-columns: 120px 1fr;
      gap: 20px;
      padding: 20px;
      border: 1px solid #e5e5e5;
      border-radius: 8px;
      margin-bottom: 16px;
      background: white;
      transition: all 0.2s;
    }

    .booking-card:hover {
      border-color: #1a1a1a;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .booking-card:last-child {
      margin-bottom: 0;
    }

    .booking-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
    }

    .booking-info {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .booking-header {
      display: flex;
      justify-content: space-between;
      align-items: start;
      gap: 12px;
    }

    .booking-title {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 4px;
    }

    .booking-owner {
      font-size: 13px;
      color: #666;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .booking-status {
      font-size: 11px;
      padding: 4px 10px;
      border-radius: 4px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      white-space: nowrap;
      flex-shrink: 0;
    }

    .booking-status.active {
      background: #dcfce7;
      color: #166534;
    }

    .booking-status.pending {
      background: #fef3c7;
      color: #92400e;
    }

    .booking-status.completed {
      background: #e0e7ff;
      color: #3730a3;
    }

    .booking-status.cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .booking-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 16px;
    }

    .booking-detail-item {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .booking-detail-label {
      font-size: 11px;
      color: #999;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      font-weight: 500;
    }

    .booking-detail-value {
      font-size: 14px;
      color: #1a1a1a;
      font-weight: 600;
    }

    .booking-dates {
      background: #f8f9fa;
      padding: 12px;
      border-radius: 6px;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      gap: 12px;
      align-items: center;
    }

    .booking-date {
      display: flex;
      flex-direction: column;
    }

    .booking-date-label {
      font-size: 11px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      font-weight: 500;
      margin-bottom: 4px;
    }

    .booking-date-value {
      font-size: 14px;
      color: #1a1a1a;
      font-weight: 600;
    }

    .booking-date-arrow {
      color: #999;
      font-size: 16px;
    }

    .booking-countdown {
      background: #fef3c7;
      border: 1px solid #fde68a;
      padding: 10px 12px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #92400e;
      font-weight: 600;
    }

    .booking-countdown.due-soon {
      background: #fee2e2;
      border-color: #fecaca;
      color: #991b1b;
    }

    .booking-actions {
      display: flex;
      gap: 8px;
      margin-top: 4px;
    }

    .btn-booking {
      padding: 8px 16px;
      font-size: 13px;
      font-weight: 500;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
      background: white;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-booking:hover {
      border-color: #1a1a1a;
      background: #f5f5f5;
    }

    .btn-booking.primary {
      background: #1a1a1a;
      color: white;
      border-color: #1a1a1a;
    }

    .btn-booking.primary:hover {
      background: #000;
      color: white;
    }

    .btn-booking.danger {
      color: #dc2626;
      border-color: #fecaca;
    }

    .btn-booking.danger:hover {
      background: #fef2f2;
      border-color: #dc2626;
    }
    
    .listings-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }
    
    .listing-card {
      border: 1px solid #e5e5e5;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.2s;
      background: white;
      position: relative;
    }
    
    .listing-card:hover {
      border-color: #1a1a1a;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .listing-image-wrapper {
      position: relative;
      width: 100%;
      height: 220px;
    }
    
    .listing-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-bottom: 1px solid #e5e5e5;
    }
    
    .approval-banner {
      position: absolute;
      top: 12px;
      left: 12px;
      right: 12px;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      text-align: center;
      backdrop-filter: blur(8px);
      z-index: 10;
    }
    
    .approval-banner.pending {
      background: rgba(245, 158, 11, 0.95);
      color: white;
    }
    
    .approval-banner.rejected {
      background: rgba(239, 68, 68, 0.95);
      color: white;
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
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      line-height: 1.4;
      flex: 1;
    }
    
    .status-indicator {
      font-size: 11px;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      white-space: nowrap;
      flex-shrink: 0;
    }
    
    .status-indicator.available {
      background: #dcfce7;
      color: #166534;
    }
    
    .status-indicator.rented {
      background: #fef3c7;
      color: #92400e;
    }
    
    .status-indicator.unavailable {
      background: #f3f4f6;
      color: #4b5563;
    }
    
    .listing-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #666;
      margin-bottom: 12px;
    }
    
    .listing-meta span {
      display: flex;
      align-items: center;
      gap: 4px;
    }
    
    .meta-separator {
      color: #d1d5db;
    }
    
    .condition-badge {
      background: #f3f4f6;
      padding: 2px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 500;
      color: #374151;
    }
    
    .quantity-info {
      font-size: 13px;
      color: #666;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .quantity-badge {
      background: #dbeafe;
      color: #1e40af;
      padding: 2px 8px;
      border-radius: 4px;
      font-weight: 600;
      font-size: 12px;
    }
    
    .listing-pricing {
      margin-bottom: 14px;
    }
    
    .price-main {
      font-size: 24px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 4px;
    }
    
    .price-main span {
      font-size: 14px;
      font-weight: 500;
      color: #666;
    }
    
    .price-alt {
      font-size: 12px;
      color: #666;
      display: flex;
      gap: 12px;
    }
    
    .deposit-info {
      background: #fef3c7;
      border: 1px solid #fde68a;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 12px;
      color: #78350f;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
      font-weight: 500;
    }
    
    .active-rental-info {
      background: #fef3c7;
      border: 1px solid #fde68a;
      padding: 10px 12px;
      border-radius: 6px;
      margin-bottom: 12px;
    }
    
    .active-rental-info .rental-to {
      font-size: 12px;
      color: #78350f;
      margin-bottom: 4px;
      font-weight: 500;
    }
    
    .active-rental-info .rental-return {
      font-size: 13px;
      color: #92400e;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .listing-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      padding: 14px 0;
      border-top: 1px solid #f0f0f0;
      border-bottom: 1px solid #f0f0f0;
      margin-bottom: 14px;
    }
    
    .stat-item {
      text-align: center;
    }
    
    .stat-item-value {
      font-size: 16px;
      font-weight: 700;
      color: #1a1a1a;
      display: block;
      margin-bottom: 2px;
    }
    
    .stat-item-label {
      font-size: 11px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }
    
    .upcoming-badge {
      background: #dbeafe;
      color: #1e40af;
      font-size: 11px;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 14px;
    }
    
    .listing-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }
    
    .listing-actions.full-width {
      grid-template-columns: 1fr;
    }
    
    .btn-listing {
      padding: 10px 12px;
      font-size: 13px;
      font-weight: 500;
      border-radius: 6px;
      border: 1px solid #e5e5e5;
      background: white;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      text-align: center;
    }
    
    .btn-listing:hover {
      border-color: #1a1a1a;
      background: #f5f5f5;
    }
    
    .btn-listing.primary {
      background: #1a1a1a;
      color: white;
      border-color: #1a1a1a;
    }
    
    .btn-listing.primary:hover {
      background: #000;
      color: white;
    }
    
    .btn-listing.danger {
      color: #dc2626;
      border-color: #fecaca;
    }
    
    .btn-listing.danger:hover {
      background: #fef2f2;
      border-color: #dc2626;
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

    /* Modal Overlay */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  padding: 20px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.2s ease, visibility 0.2s ease;
}

.modal-overlay.active {
  opacity: 1;
  visibility: visible;
}

/* Modal Container */
.modal-container {
  background: white;
  border-radius: 12px;
  max-width: 440px;
  width: 100%;
  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
  transform: scale(0.96) translateY(8px);
  transition: transform 0.2s ease;
}

.modal-overlay.active .modal-container {
  transform: scale(1) translateY(0);
}

/* Modal Content */
.modal-content {
  padding: 28px;
}

.modal-header {
  margin-bottom: 20px;
}

.modal-title {
  font-size: 18px;
  font-weight: 600;
  color: #0a0a0a;
  margin-bottom: 6px;
  letter-spacing: -0.01em;
}

.modal-description {
  font-size: 14px;
  color: #737373;
  line-height: 1.5;
}

/* Process Steps */
.process-steps {
  background: #fafafa;
  border-radius: 8px;
  padding: 18px;
  margin-bottom: 18px;
}

.step {
  display: flex;
  gap: 12px;
  margin-bottom: 14px;
}

.step:last-child {
  margin-bottom: 0;
}

.step-number {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #e5e5e5;
  color: #525252;
  font-size: 12px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 1px;
}

.step-content {
  flex: 1;
}

.step-title {
  font-size: 13px;
  font-weight: 500;
  color: #0a0a0a;
  margin-bottom: 2px;
}

.step-text {
  font-size: 13px;
  color: #737373;
  line-height: 1.4;
}

/* Notice */
.notice {
  background: #fafaf9;
  border: 1px solid #e7e5e4;
  border-radius: 6px;
  padding: 12px 14px;
  margin-bottom: 24px;
  display: flex;
  gap: 10px;
  align-items: start;
}

.notice i {
  font-size: 16px;
  color: #78716c;
  margin-top: 1px;
  flex-shrink: 0;
}

.notice-text {
  font-size: 13px;
  color: #57534e;
  line-height: 1.4;
}

/* Modal Actions */
.modal-actions {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}

.modal-button {
  padding: 11px 18px;
  font-size: 14px;
  font-weight: 500;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  transition: all 0.15s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.modal-button:active {
  transform: scale(0.98);
}

.button-secondary {
  background: white;
  color: #525252;
  border: 1px solid #e5e5e5;
}

.button-secondary:hover {
  background: #fafafa;
  border-color: #d4d4d4;
}

.button-primary {
  background: #0a0a0a;
  color: white;
}

.button-primary:hover {
  background: #171717;
}

.button-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Loading State */
.spinner {
  width: 14px;
  height: 14px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: spin 0.6s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Success State */
.modal-container.success .step-number {
  background: #dcfce7;
  color: #166534;
}

.modal-container.success .notice {
  background: #f0fdf4;
  border-color: #bbf7d0;
}

.modal-container.success .notice i {
  color: #16a34a;
}

.modal-container.success .notice-text {
  color: #15803d;
}

/* Responsive */
@media (max-width: 520px) {
  .modal-container {
    max-width: 100%;
    margin: 0 12px;
  }

  .modal-content {
    padding: 24px 20px;
  }

  .modal-actions {
    grid-template-columns: 1fr;
  }

  .button-secondary {
    order: 1;
  }
}
    
    @media (max-width: 1024px) {
      .stats-container {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .listings-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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

      .booking-card {
        grid-template-columns: 100px 1fr;
        gap: 16px;
        padding: 16px;
      }

      .booking-image {
        width: 100px;
        height: 100px;
      }

      .booking-details {
        grid-template-columns: 1fr;
        gap: 12px;
      }

      .booking-dates {
        grid-template-columns: 1fr;
        gap: 8px;
      }

      .booking-date-arrow {
        transform: rotate(90deg);
      }

      .booking-actions {
        flex-direction: column;
      }

      .btn-booking {
        width: 100%;
        justify-content: center;
      }
      
      .listings-grid {
        grid-template-columns: 1fr;
        gap: 20px;
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
      
      .listing-stats {
        grid-template-columns: 1fr;
        gap: 8px;
      }
      
      .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
      }
      
      .stat-item-label {
        order: -1;
      }

      .booking-card {
        grid-template-columns: 1fr;
      }

      .booking-image {
        width: 100%;
        height: 200px;
      }
    }
  </style>
  <title>Dashboard | Rentify</title>
</head>
<body>
  <div class="container-main">

  <!-- Return Confirmation Modal -->
<div class="modal-overlay" id="returnModal">
  <div class="modal-container" id="modalContainer">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h2 class="modal-title">Confirm item return</h2>
        <p class="modal-description">This will notify the owner that you're ready to return the item.</p>
      </div>

      <!-- Process Steps -->
      <div class="process-steps">
        <div class="step">
          <div class="step-number">1</div>
          <div class="step-content">
            <div class="step-title">Coordinate handover</div>
            <div class="step-text">Arrange time and place with the owner</div>
          </div>
        </div>

        <div class="step">
          <div class="step-number">2</div>
          <div class="step-content">
            <div class="step-title">Item inspection</div>
            <div class="step-text">Owner verifies item condition</div>
          </div>
        </div>

        <div class="step">
          <div class="step-number">3</div>
          <div class="step-content">
            <div class="step-title">Complete return</div>
            <div class="step-text">Deposit refunded after confirmation</div>
          </div>
        </div>
      </div>

      <!-- Notice -->
      <div class="notice">
        <i class="bi bi-info-circle"></i>
        <div class="notice-text">
          Ensure the item is in good condition with all accessories included.
        </div>
      </div>

      <!-- Actions -->
      <div class="modal-actions">
        <button class="modal-button button-secondary" onclick="closeReturnModal()">
          Cancel
        </button>
        <button class="modal-button button-primary" id="confirmButton" onclick="confirmReturnProcess()">
          Confirm return
        </button>
      </div>
    </div>
  </div>
</div>
    
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
        <div class="stat-value">₱<?php echo number_format($user_stats['total_earnings'], 0); ?></div>
      </div>
    </div>

    <!-- NEW: My Bookings Section -->
    <div class="section">
      <div class="section-header">
        <div class="section-title">
          <i class="bi bi-calendar-check"></i>
          My Bookings
          <?php if(count(array_filter($my_bookings, fn($b) => $b['status'] === 'active')) > 0): ?>
            <span class="notification-badge">
              <?php echo count(array_filter($my_bookings, fn($b) => $b['status'] === 'active')); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="section-content">
        <?php if(count($my_bookings) > 0): ?>
          <?php foreach($my_bookings as $booking): ?>
            <div class="booking-card">
              <img src="<?php echo htmlspecialchars('/file/image' . $booking['item_image']); ?>" 
                   alt="<?php echo htmlspecialchars($booking['item_name']); ?>" 
                   class="booking-image">
              
              <div class="booking-info">
                <div class="booking-header">
                  <div>
                    <div class="booking-title"><?php echo htmlspecialchars($booking['item_name']); ?></div>
                    <div class="booking-owner">
                      <i class="bi bi-person"></i>
                      Owner: <?php echo htmlspecialchars($booking['owner_name']); ?>
                    </div>
                  </div>
                  <span class="booking-status <?php echo $booking['status']; ?>">
                    <?php echo ucfirst($booking['status']); ?>
                  </span>
                </div>

                <div class="booking-dates">
                  <div class="booking-date">
                    <div class="booking-date-label">Start Date</div>
                    <div class="booking-date-value">
                      <?php echo date('M d, Y', strtotime($booking['start_date'])); ?>
                    </div>
                  </div>
                  <div class="booking-date-arrow">
                    <i class="bi bi-arrow-right"></i>
                  </div>
                  <div class="booking-date">
                    <div class="booking-date-label">Return Date</div>
                    <div class="booking-date-value">
                      <?php echo date('M d, Y', strtotime($booking['end_date'])); ?>
                    </div>
                  </div>
                </div>

                <?php if($booking['status'] === 'active'): ?>
                  <?php 
                    $daysRemaining = getDaysRemaining($booking['end_date']);
                    $isDueSoon = $daysRemaining <= 3;
                  ?>
                  <div class="booking-countdown <?php echo $isDueSoon ? 'due-soon' : ''; ?>">
                    <i class="bi bi-clock-history"></i>
                    <?php if($daysRemaining > 0): ?>
                      Return in <?php echo $daysRemaining; ?> day<?php echo $daysRemaining > 1 ? 's' : ''; ?>
                    <?php else: ?>
                      Due today!
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <div class="booking-details">
                  <div class="booking-detail-item">
                    <div class="booking-detail-label">Total Paid</div>
                    <div class="booking-detail-value">₱<?php echo number_format($booking['total_price'], 2); ?></div>
                  </div>
                  
                  <?php if(isset($booking['security_deposit']) && $booking['security_deposit'] > 0): ?>
                    <div class="booking-detail-item">
                      <div class="booking-detail-label">Deposit</div>
                      <div class="booking-detail-value">₱<?php echo number_format($booking['security_deposit'], 2); ?></div>
                    </div>
                  <?php endif; ?>
                  
                  <div class="booking-detail-item">
                    <div class="booking-detail-label">Duration</div>
                    <div class="booking-detail-value"><?php echo $booking['rental_duration']; ?></div>
                  </div>
                  
                  <div class="booking-detail-item">
                    <div class="booking-detail-label">Booking ID</div>
                    <div class="booking-detail-value">#<?php echo $booking['booking_id']; ?></div>
                  </div>
                </div>

                <div class="booking-actions">
                  <a href="/item/detail?id=<?php echo $booking['item_id']; ?>" class="btn-booking">
                    <i class="bi bi-eye"></i> View Item
                  </a>
                  
                  <?php if($booking['status'] === 'pending'): ?>
                    <button class="btn-booking danger" onclick="cancelBooking(<?php echo $booking['id']; ?>)">
                      <i class="bi bi-x-circle"></i> Cancel Request
                    </button>
                  <?php elseif($booking['status'] === 'active'): ?>
                    <a href="/messages?user=<?php echo $booking['owner_id']; ?>" class="btn-booking">
                      <i class="bi bi-chat-dots"></i> Contact Owner
                    </a>
                    <button class="btn-booking primary" onclick="initiateReturn(<?php echo $booking['id']; ?>)">
                      <i class="bi bi-box-arrow-in-left"></i> Initiate Return
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <h4>No bookings yet</h4>
            <p>Items you rent from others will appear here</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Pending Requests -->
    <div class="section">
      <div class="section-header">
        <div class="section-title">
          Rental Requests
          <?php if(count($pending_requests) > 0): ?>
            <span class="notification-badge" id="pending-request-count"><?php echo count($pending_requests); ?></span>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="section-content">
        <?php if(count($pending_requests) > 0): ?>
          <?php foreach($pending_requests as $request): ?>
            <div class="request-item" id="request-item">
              <img src="<?php echo htmlspecialchars( '/file/image' . $request['item_image']); ?>" alt="<?php echo htmlspecialchars($request['item_name']); ?>" class="request-image">
              
              <div class="request-details">
                <h3><?php echo htmlspecialchars($request['item_name']); ?></h3>
                <div class="request-meta">
                  <span><?php echo htmlspecialchars($request['renter_name']); ?></span>
                  <span><?php echo htmlspecialchars($request['rental_period']); ?></span>
                  <span><?php echo htmlspecialchars($request['requested_at']); ?></span>
                </div>
                <div class="request-price">₱<?php echo number_format($request['price'], 2); ?></div>
              </div>
              
              <div class="request-actions">
                <button class="btn-action btn-accept" data-uid="<?= $request['id']; ?>" onclick="handlePendingRequest('accept', this)">
                  Accept
                </button>
                <button class="btn-action btn-decline" data-uid="<?= $request['id']; ?>" onclick="handlePendingRequest('decline', this)">
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
        <a href="/item/create" class="btn-add">
          Add Item
        </a>
      </div>
      
      <div class="section-content">
        <?php if(count($my_listings) > 0): ?>
          <div class="listings-grid">
            <?php foreach($my_listings as $listing): ?>
              <div class="listing-card">
                <div class="listing-image-wrapper">
                  <img src="<?php echo htmlspecialchars('/file/image' . $listing['image']); ?>" alt="<?php echo htmlspecialchars($listing['name']); ?>" class="listing-image">
                  
                  <!-- Approval Status Banner -->
                  <?php if($listing['approval_status'] === 'pending'): ?>
                    <div class="approval-banner pending">
                      ⏳ Awaiting Admin Approval
                    </div>
                  <?php elseif($listing['approval_status'] === 'rejected'): ?>
                    <div class="approval-banner rejected">
                      ❌ Rejected - Contact Support
                    </div>
                  <?php endif; ?>
                </div>
                
                <div class="listing-body">
                  <!-- Header with Name and Status -->
                  <div class="listing-header">
                    <div class="listing-name"><?php echo htmlspecialchars($listing['name']); ?></div>
                    <span class="status-indicator <?php echo $listing['status']; ?>">
                      <?php echo ucfirst($listing['status']); ?>
                    </span>
                  </div>
                  
                  <!-- Meta Information -->
                  <div class="listing-meta">
                    <span><?php echo formatCategory($listing['category']); ?></span>
                    <?php if($listing['brand']): ?>
                      <span class="meta-separator">•</span>
                      <span><?php echo htmlspecialchars($listing['brand']); ?></span>
                    <?php endif; ?>
                    <span class="meta-separator">•</span>
                    <span class="condition-badge"><?php echo formatCondition($listing['item_condition']); ?></span>
                  </div>
                  
                  <!-- Quantity Information -->
                  <?php if($listing['total_quantity'] > 1): ?>
                    <div class="quantity-info">
                      <i class="bi bi-box-seam"></i>
                      <span class="quantity-badge">
                        <?php echo $listing['available_quantity']; ?> of <?php echo $listing['total_quantity']; ?> available
                      </span>
                    </div>
                  <?php endif; ?>
                  
                  <!-- Pricing -->
                  <div class="listing-pricing">
                    <?php if($listing['price_per_day'] > 0): ?>
                      <div class="price-main">
                        ₱<?php echo number_format($listing['price_per_day'], 2); ?><span>/day</span>
                      </div>
                      <?php if($listing['price_per_week'] > 0 || $listing['price_per_month'] > 0): ?>
                        <div class="price-alt">
                          <?php if($listing['price_per_week'] > 0): ?>
                            <span>₱<?php echo number_format($listing['price_per_week'], 2); ?>/week</span>
                          <?php endif; ?>
                          <?php if($listing['price_per_month'] > 0): ?>
                            <span>₱<?php echo number_format($listing['price_per_month'], 2); ?>/month</span>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    <?php else: ?>
                      <div class="price-main">
                        <span style="font-size: 14px;">No pricing set</span>
                      </div>
                    <?php endif; ?>
                  </div>
                  
                  <!-- Security Deposit -->
                  <?php if($listing['security_deposit'] > 0): ?>
                    <div class="deposit-info">
                      <i class="bi bi-shield-check"></i>
                      ₱<?php echo number_format($listing['security_deposit'], 2); ?> security deposit required
                    </div>
                  <?php endif; ?>
                  
                  <!-- Active Rental Info -->
                  <?php if($listing['status'] === 'rented' && $listing['current_rental']): ?>
                    <div class="active-rental-info">
                      <div class="rental-to">
                        Currently rented to <?php echo htmlspecialchars($listing['current_rental']['renter']); ?>
                      </div>
                      <div class="rental-return">
                        <i class="bi bi-calendar-event"></i>
                        Returns: <?php echo date('M d, Y', strtotime($listing['current_rental']['end_date'])); ?>
                        (<?php echo $listing['current_rental']['days_remaining']; ?> days)
                      </div>
                    </div>
                  <?php endif; ?>
                  
                  <!-- Upcoming Bookings Badge -->
                  <?php if($listing['upcoming_bookings'] > 0): ?>
                    <div class="upcoming-badge">
                      <i class="bi bi-calendar-check"></i>
                      <?php echo $listing['upcoming_bookings']; ?> upcoming booking<?php echo $listing['upcoming_bookings'] > 1 ? 's' : ''; ?>
                    </div>
                  <?php endif; ?>
                  
                  <!-- Actions -->
                  <div class="listing-actions <?php echo $listing['approval_status'] === 'rejected' ? 'full-width' : ''; ?>">
                    <?php if($listing['approval_status'] === 'rejected'): ?>
                      <a href="/item/edit/<?php echo $listing['id']; ?>" class="btn-listing primary">
                        <i class="bi bi-pencil"></i> Resubmit
                      </a>
                    <?php else: ?>
                      <a href="/item/detail?id=<?php echo $listing['id']; ?>" class="btn-listing">
                        <i class="bi bi-eye"></i> View
                      </a>
                      <a href="/item/edit/<?php echo $listing['id']; ?>" class="btn-listing">
                        <i class="bi bi-pencil"></i> Edit
                      </a>
                      <?php if($listing['status'] === 'available' && $listing['approval_status'] === 'approved'): ?>
                        <button class="btn-listing" onclick="toggleAvailability(<?php echo $listing['id']; ?>, 'unavailable')">
                          <i class="bi bi-pause-circle"></i> Pause
                        </button>
                      <?php elseif($listing['status'] === 'unavailable'): ?>
                        <button class="btn-listing" onclick="toggleAvailability(<?php echo $listing['id']; ?>, 'available')">
                          <i class="bi bi-play-circle"></i> Activate
                        </button>
                      <?php endif; ?>
                      <button class="btn-listing danger" onclick="deleteListing(<?php echo $listing['id']; ?>)">
                        <i class="bi bi-trash"></i> Delete
                      </button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="empty-state">
            <i class="bi bi-box"></i>
            <h4>No listings yet</h4>
            <p>Start by adding your first item for rent</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  
  <script>
    pendingRequestCount = document.getElementById('pending-request-count');
    let currentBookingId = null;
    console.log(pendingRequestCount);
    
    function handleRequest(requestId, action) {
      if(confirm(`Are you sure you want to ${action} this rental request?`)) {
        const buttons = document.querySelectorAll('.btn-action');
        buttons.forEach(btn => btn.disabled = true);
        
        fetch('/dashboard/handleRequest', {
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
            buttons.forEach(btn => btn.disabled = false);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
          buttons.forEach(btn => btn.disabled = false);
        });
      }
    }

    async function handlePendingRequest(action, button) {
      if (confirm(`Are you sure you want to ${action} this rental request?`)) {
        const rentalRequestId = button.dataset.uid;          
        const reqItemContainer = button.closest('#request-item');
        button.disabled = true;
        
        try {
          const response = await fetch('/dashboard/handleRentalRequest', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              rentalRequestId: rentalRequestId,
              action: action
            })
          });

          const result = await response.json();
          if (result.success) {
            console.log(result);
            alert(result.message);
            
            const pendingRequestCount = document.getElementById('pending-request-count');
            if (pendingRequestCount) {
              pendingRequestCount.innerText = result.pendingRequestCount;
              
              if (result.pendingRequestCount === 0) {
                pendingRequestCount.remove();
              }
            }
            
            reqItemContainer.remove();
            
            const sectionContent = document.querySelector('.section-content');
            const remainingRequests = sectionContent.querySelectorAll('#request-item');
            
            if (remainingRequests.length === 0) {
              sectionContent.innerHTML = `
                <div class="empty-state">
                  <i class="bi bi-inbox"></i>
                  <h4>No pending requests</h4>
                  <p>New rental requests will appear here</p>
                </div>
              `;
            }
          } else {
            alert('Error: ' + result.message);
            button.disabled = false;
          }
        } catch (error) {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
          button.disabled = false;
        }
      }
    }
    
    function toggleAvailability(listingId, newStatus) {
      const action = newStatus === 'unavailable' ? 'pause' : 'activate';
      if(confirm(`Are you sure you want to ${action} this listing?`)) {
        fetch('/dashboard/toggleAvailability', {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            listing_id: listingId,
            status: newStatus
          })
        })
        .then(response => response.json())
        .then(data => {
          if(data.success) {
            alert(`Listing ${action}d successfully!`);
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
    
    function deleteListing(listingId) {
      if(confirm('Are you sure you want to delete this listing? This action cannot be undone.')) {
        fetch('/dashboard/deleteListing', {
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
          console.error('Error test:', error);
          alert('An error occurred. Please try again.');
        });
      }
    }

    // New: Booking functions
    function cancelBooking(bookingId) {
      if(confirm('Are you sure you want to cancel this booking request?')) {
        fetch('/booking/cancel', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            booking_id: bookingId
          })
        })
        .then(response => response.json())
        .then(data => {
          if(data.success) {
            alert('Booking cancelled successfully!');
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

    function initiateReturn(bookingId) {
      if(confirm('Are you ready to return this item? The owner will be notified.')) {
        fetch('/booking/initiate-return', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            booking_id: bookingId
          })
        })
        .then(response => response.json())
        .then(data => {
          if(data.success) {
            alert('Return process initiated. Please coordinate with the owner for item return.');
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

    // Update your initiateReturn function to use the modal
function initiateReturn(bookingId) {
  currentBookingId = bookingId;
  openReturnModal();
}

function openReturnModal() {
  const modal = document.getElementById('returnModal');
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeReturnModal() {
  const modal = document.getElementById('returnModal');
  modal.classList.remove('active');
  document.body.style.overflow = '';
  
  setTimeout(() => {
    const container = document.getElementById('modalContainer');
    container.classList.remove('success');
    
    const confirmBtn = document.getElementById('confirmButton');
    confirmBtn.innerHTML = 'Confirm return';
    confirmBtn.disabled = false;
    
    // Reset content
    document.querySelector('.modal-title').textContent = 'Confirm item return';
    document.querySelector('.modal-description').textContent = "This will notify the owner that you're ready to return the item.";
    
    document.querySelector('.process-steps').innerHTML = `
      <div class="step">
        <div class="step-number">1</div>
        <div class="step-content">
          <div class="step-title">Coordinate handover</div>
          <div class="step-text">Arrange time and place with the owner</div>
        </div>
      </div>
      <div class="step">
        <div class="step-number">2</div>
        <div class="step-content">
          <div class="step-title">Item inspection</div>
          <div class="step-text">Owner verifies item condition</div>
        </div>
      </div>
      <div class="step">
        <div class="step-number">3</div>
        <div class="step-content">
          <div class="step-title">Complete return</div>
          <div class="step-text">Deposit refunded after confirmation</div>
        </div>
      </div>
    `;
    
    document.querySelector('.notice').innerHTML = `
      <i class="bi bi-info-circle"></i>
      <div class="notice-text">
        Ensure the item is in good condition with all accessories included.
      </div>
    `;
    
    document.querySelector('.modal-actions').innerHTML = `
      <button class="modal-button button-secondary" onclick="closeReturnModal()">
        Cancel
      </button>
      <button class="modal-button button-primary" id="confirmButton" onclick="confirmReturnProcess()">
        Confirm return
      </button>
    `;
    
    currentBookingId = null;
  }, 200);
}

async function confirmReturnProcess() {
  if (!currentBookingId) {
    alert('Error: No booking selected');
    return;
  }

  const confirmBtn = document.getElementById('confirmButton');
  const modalContainer = document.getElementById('modalContainer');
  
  // Show loading
  confirmBtn.innerHTML = '<div class="spinner"></div><span>Processing...</span>';
  confirmBtn.disabled = true;

  try {
    const response = await fetch('/dashboard/initiateReturn', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        booking_id: currentBookingId
      })
    });

    const result = await response.json();

    if (result.success) {
      // Success state
      modalContainer.classList.add('success');
      
      document.querySelector('.modal-title').textContent = 'Return request sent';
      document.querySelector('.modal-description').textContent = 'The owner has been notified and will confirm once they receive the item.';
      
      document.querySelector('.process-steps').innerHTML = `
        <div class="step">
          <div class="step-number">✓</div>
          <div class="step-content">
            <div class="step-title">Request submitted</div>
            <div class="step-text">Owner notified successfully</div>
          </div>
        </div>
        <div class="step">
          <div class="step-number">→</div>
          <div class="step-content">
            <div class="step-title">Awaiting confirmation</div>
            <div class="step-text">Coordinate with owner for handover</div>
          </div>
        </div>
        <div class="step">
          <div class="step-number">3</div>
          <div class="step-content">
            <div class="step-title">Pending</div>
            <div class="step-text">Refund processed after confirmation</div>
          </div>
        </div>
      `;
      
      document.querySelector('.notice').innerHTML = `
        <i class="bi bi-check-circle"></i>
        <div class="notice-text">
          You can contact the owner to arrange the item return.
        </div>
      `;
      
      document.querySelector('.modal-actions').innerHTML = `
        <button class="modal-button button-primary" style="grid-column: 1 / -1;" onclick="closeReturnModal()">
          Done
        </button>
      `;
      
      // Auto close after 3 seconds
      setTimeout(() => {
        closeReturnModal();
        location.reload();
      }, 3000);
      
    } else {
      alert('Error: ' + result.message);
      confirmBtn.innerHTML = 'Try again';
      confirmBtn.disabled = false;
    }
  } catch (error) {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
    confirmBtn.innerHTML = 'Try again';
    confirmBtn.disabled = false;
  }
}

// Close on overlay click
document.getElementById('returnModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeReturnModal();
  }
});

// Close on Escape
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && document.getElementById('returnModal').classList.contains('active')) {
    closeReturnModal();
  }
});
  </script>
</body>
</html>

<?php
  require_once dirname(__DIR__) . '/layouts/footer.php';