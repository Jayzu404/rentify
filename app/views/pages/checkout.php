<?php

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

// echo '<pre>';
// var_dump($data);
// echo '</pre>';

$item = $data['item'] ?? null;
$policies = $data['policies'] ?? [];

// Default values if item data is missing
$itemTitle = $item['title'] ?? 'Item Name';
$itemCategory = $item['category'] ?? 'Category';
$itemLocation = $item['location'] ?? 'Location';
$itemImage = $item['primary_image'] ?? '';
$securityDeposit = $item['security_deposit'] ?? 0;

// Get first pricing option
$pricingOption = $item['pricing_options'][0] ?? null;
$dailyRate = $pricingOption['price'] ?? 0;
$rateType = $pricingOption['rate_type'] ?? 'per_day';
$minDuration = $pricingOption['minimum_duration'] ?? 1;
$minDurationUnit = $pricingOption['minimum_duration_unit'] ?? 'day';
$maxDuration = $pricingOption['maximum_duration'] ?? null;
$maxDurationUnit = $pricingOption['maximum_duration_unit'] ?? null;

// Get availability
$availableFrom = $item['available_from'] ?? null;
$availableUntil = $item['available_until'] ?? null;

// Commission settings (should come from database in production)
$commissionBaseFee = 15.00;
$commissionPercentage = 10.00;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Rentify</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: #f1f5f9;
            color: #0f172a;
            line-height: 1.6;
            padding-bottom: 40px;
        }

        .header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: #0f172a;
        }

        .logo {
            font-size: 18px;
            font-weight: 700;
            color: #3b82f6;
        }

        .container {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 24px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 32px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
            color: #0f172a;
        }

        /* Order Summary */
        .summary-sticky {
            position: sticky;
            top: 88px;
        }

        .item-card {
            display: flex;
            gap: 16px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            background: #cbd5e1;
            flex-shrink: 0;
        }

        .item-info h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #0f172a;
        }

        .item-category {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
            text-transform: capitalize;
        }

        .item-price {
            font-size: 14px;
            font-weight: 600;
            color: #3b82f6;
        }

        /* Rental Details */
        .detail-grid {
            display: grid;
            gap: 12px;
            margin-bottom: 24px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .detail-label {
            color: #64748b;
        }

        .detail-value {
            font-weight: 600;
            color: #0f172a;
        }

        /* Cost Breakdown */
        .breakdown {
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .breakdown-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #0f172a;
        }

        .cost-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .cost-label {
            color: #475569;
        }

        .cost-value {
            font-weight: 500;
            color: #0f172a;
        }

        .cost-row.deposit {
            color: #10b981;
        }

        .cost-row.deposit .cost-value {
            color: #10b981;
        }

        .cost-row.total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px solid #e2e8f0;
            font-size: 18px;
            font-weight: 700;
        }

        .cost-row.total .cost-value {
            color: #3b82f6;
            font-size: 20px;
        }

        .refund-note {
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            border-radius: 8px;
            padding: 12px;
            margin-top: 16px;
        }

        .refund-note p {
            font-size: 12px;
            color: #047857;
            line-height: 1.5;
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 32px;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            font-size: 13px;
            font-weight: 600;
        }

        /* Date Selector */
        .date-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s;
            background: white;
            color: #0f172a;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .helper-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
        }

        /* Duration Display */
        .duration-display {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
        }

        .duration-number {
            font-size: 32px;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 4px;
        }

        .duration-label {
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Payment Methods */
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .payment-option {
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            background: white;
        }

        .payment-option:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .payment-option.selected {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .payment-option-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .payment-option-name {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }

        /* Cancellation Policy */
        .policy-selector {
            display: grid;
            gap: 12px;
        }

        .policy-option {
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }

        .policy-option:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .policy-option.selected {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .policy-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .policy-name {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            text-transform: capitalize;
        }

        .policy-refund {
            font-size: 13px;
            font-weight: 600;
            color: #10b981;
        }

        .policy-description {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        /* Payment Instructions */
        .payment-instructions {
            background: #fffbeb;
            border: 2px solid #fef08a;
            border-radius: 12px;
            padding: 24px;
            margin-top: 24px;
        }

        .instruction-title {
            font-size: 15px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-details {
            background: white;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .payment-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .payment-detail-row:last-child {
            border-bottom: none;
        }

        .payment-detail-label {
            font-size: 13px;
            color: #6b7280;
        }

        .payment-detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            font-family: monospace;
        }

        .amount-highlight {
            background: #fef3c7;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-top: 12px;
        }

        .amount-highlight-label {
            font-size: 12px;
            color: #92400e;
            margin-bottom: 4px;
        }

        .amount-highlight-value {
            font-size: 24px;
            font-weight: 700;
            color: #b45309;
        }

        /* File Upload */
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafafa;
        }

        .upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .upload-area.has-file {
            border-color: #10b981;
            background: #ecfdf5;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .upload-text {
            font-size: 14px;
            font-weight: 500;
            color: #475569;
            margin-bottom: 4px;
        }

        .upload-hint {
            font-size: 12px;
            color: #94a3b8;
        }

        input[type="file"] {
            display: none;
        }

        /* Security Badge */
        .security-badge {
            background: rgb(160, 108, 0);
            border-radius: 12px;
            padding: 20px;
            color: white;
            margin-bottom: 24px;
        }

        .security-badge h4 {
            font-size: 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .security-badge p {
            font-size: 13px;
            opacity: 0.95;
            line-height: 1.5;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        }

        .submit-btn:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .trust-footer {
            text-align: center;
            margin-top: 20px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .trust-badges {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .trust-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #475569;
        }

        .trust-badge::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            background: #10b981;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .summary-sticky {
                position: static;
            }

            .card {
                padding: 24px;
            }

            .date-selector,
            .payment-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <a href="/item/detail?id=<?= $item['item_id'] ?? '' ?>" class="back-btn">
                <span>←</span>
                Back to listing
            </a>
            <div class="logo">Rentify</div>
        </div>
    </div>

    <div class="container">
        <div class="checkout-grid">
            <!-- Left: Payment Form -->
            <div>
                <div class="card">
                    <h1 class="section-title">Complete Your Booking</h1>

                    <form id="checkoutForm" method="POST" action="/rental/pending" enctype="multipart/form-data">
                        <input type="hidden" name="item_id" value="<?= $item['item_id'] ?? '' ?>">
                        <input type="hidden" name="pricing_id" value="<?= $pricingOption['pricing_id'] ?? '' ?>">
                        <input type="hidden" name="item_price" value="<?= $pricingOption['price'] ?? 0.00; ?>">
                        <input type="hidden" name="security_deposit" value="<?= $item['security_deposit'] ?? null; ?>">
                        <input type="hidden" name="total_amount" id="totalAmountInput" value="0.00">
                        
                        <!-- Step 1: Rental Period -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <span class="step-number">1</span>
                                Select Rental Period
                            </div>

                            <div class="date-selector">
                                <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" id="startDate" name="start_date" required
                                           min="<?= $availableFrom ?? date('Y-m-d') ?>"
                                           <?= $availableUntil ? 'max="' . $availableUntil . '"' : '' ?>>
                                    <p class="helper-text">
                                        <?php if ($availableFrom): ?>
                                            Available from <?= date('M j, Y', strtotime($availableFrom)) ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" id="endDate" name="end_date" required
                                           <?= $availableUntil ? 'max="' . $availableUntil . '"' : '' ?>>
                                    <p class="helper-text">
                                        <?php if ($maxDuration): ?>
                                            Max: <?= $maxDuration ?> <?= $maxDurationUnit ?>s
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="duration-display" id="durationDisplay">
                                <div class="duration-number">0</div>
                                <div class="duration-label">Days Selected</div>
                            </div>
                            
                            <?php if ($minDuration > 1): ?>
                                <p class="helper-text" style="text-align: center; margin-top: 8px; color: #ef4444;">
                                    Minimum rental: <?= $minDuration ?> <?= $minDurationUnit ?><?= $minDuration > 1 ? 's' : '' ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Step 2: Cancellation Policy -->
                        <?php if (!empty($policies)): ?>
                        <div class="form-section">
                            <div class="form-section-title">
                                <span class="step-number">2</span>
                                Choose Cancellation Policy
                            </div>

                            <div class="policy-selector">
                                <?php foreach ($policies as $index => $policy): ?>
                                <label class="policy-option <?= $index === 0 ? 'selected' : '' ?>">
                                    <input type="radio" name="policy_id" value="<?= $policy['policy_id'] ?>" 
                                           <?= $index === 0 ? 'checked' : '' ?> style="display: none;">
                                    <div class="policy-header">
                                        <span class="policy-name"><?= htmlspecialchars($policy['name']) ?></span>
                                        <span class="policy-refund"><?= $policy['refund_percentage'] ?>% Refund</span>
                                    </div>
                                    <div class="policy-description">
                                        <?= htmlspecialchars($policy['description']) ?>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Step 3: Payment Method -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <span class="step-number"><?= !empty($policies) ? '3' : '2' ?></span>
                                Choose Payment Method
                            </div>

                            <div class="payment-grid">
                                <div class="payment-option selected" data-method="gcash">
                                    <div class="payment-option-icon">💳</div>
                                    <div class="payment-option-name">GCash</div>
                                </div>
                                <div class="payment-option" data-method="bank">
                                    <div class="payment-option-icon">🏦</div>
                                    <div class="payment-option-name">Bank Transfer</div>
                                </div>
                            </div>
                            <input type="hidden" name="payment_method" id="paymentMethodInput" value="gcash">

                            <div class="payment-instructions" id="paymentInstructions">
                                <div class="instruction-title">
                                    <span>📱</span>
                                    <span id="instructionText">Send payment to this GCash account</span>
                                </div>

                                <div class="payment-details">
                                    <div class="payment-detail-row">
                                        <span class="payment-detail-label">Account Name</span>
                                        <span class="payment-detail-value" id="accountName">Rentify Platform</span>
                                    </div>
                                    <div class="payment-detail-row">
                                        <span class="payment-detail-label" id="accountNumberLabel">GCash Number</span>
                                        <span class="payment-detail-value" id="accountNumber">0917 123 4567</span>
                                    </div>
                                    <div class="payment-detail-row">
                                        <span class="payment-detail-label">Reference Code</span>
                                        <span class="payment-detail-value">#BKG-<?= strtoupper(substr(md5(time()), 0, 8)) ?></span>
                                    </div>
                                </div>

                                <div class="amount-highlight">
                                    <div class="amount-highlight-label">Total Amount to Send</div>
                                    <div class="amount-highlight-value" id="paymentAmount">₱0.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Upload Proof -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <span class="step-number"><?= !empty($policies) ? '4' : '3' ?></span>
                                Upload Payment Proof
                            </div>

                            <div class="upload-area" id="uploadArea" onclick="document.getElementById('proofFile').click()">
                                <input type="file" id="proofFile" name="proof_of_payment" accept="image/*" required>
                                <div class="upload-icon">📸</div>
                                <div class="upload-text">Click to upload screenshot</div>
                                <div class="upload-hint">PNG, JPG up to 5MB</div>
                            </div>
                            <p class="helper-text">Upload a clear screenshot of your payment confirmation</p>
                        </div>

                        <!-- Security Notice -->
                        <div class="security-badge">
                            <h4>🔒 Secure Escrow Protection</h4>
                            <p>Your payment is held securely until the owner confirms availability. Owner contact details will be revealed only after payment verification. 100% refund guaranteed if booking is not confirmed.</p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn" id="submitBtn" disabled>
                            Complete Booking
                        </button>

                        <div class="trust-footer">
                            <div class="trust-badges">
                                <span class="trust-badge">Secure Payment</span>
                                <span class="trust-badge">Escrow Protected</span>
                                <span class="trust-badge">Full Refund Guarantee</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="summary-sticky">
                <div class="card">
                    <h2 class="section-title">Order Summary</h2>

                    <div class="item-card">
                        <img src="<?= $itemImage ? '/file/image' . $itemImage : 'https://via.placeholder.com/80' ?>" 
                             alt="<?= htmlspecialchars($itemTitle) ?>" class="item-image">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($itemTitle) ?></h3>
                            <div class="item-category">
                                <?php
                                $categoryIcons = [
                                    'textbook' => '📚',
                                    'uniform' => '👔',
                                    'pe_costume' => '👕',
                                    'sports_gear' => '⚽',
                                    'lab_equipment' => '🔬',
                                    'electronics' => '💻',
                                    'other' => '📦'
                                ];
                                $icon = $categoryIcons[$item['category'] ?? 'other'] ?? '📦';
                                echo $icon . ' ' . ucwords(str_replace('_', ' ', $itemCategory));
                                ?>
                            </div>
                            <div class="item-price">
                                ₱<?= number_format($dailyRate, 2) ?> / <?= str_replace('per_', '', $rateType) ?>
                            </div>
                        </div>
                    </div>

                    <div class="detail-grid">
                        <div class="detail-row">
                            <span class="detail-label">📍 Location</span>
                            <span class="detail-value"><?= htmlspecialchars($itemLocation) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">📅 Duration</span>
                            <span class="detail-value" id="summaryDuration">Not selected</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">🏷️ Rate</span>
                            <span class="detail-value">₱<?= number_format($dailyRate, 2) ?> per <?= str_replace('per_', '', $rateType) ?></span>
                        </div>
                    </div>

                    <div class="breakdown">
                        <div class="breakdown-title">Cost Breakdown</div>

                        <div class="cost-row">
                            <span class="cost-label">Rental Fee (<span id="daysCount">0</span> days × ₱<?= number_format($dailyRate, 2) ?>)</span>
                            <span class="cost-value" id="rentalFee">₱0.00</span>
                        </div>

                        <?php if ($securityDeposit > 0): ?>
                        <div class="cost-row deposit">
                            <span class="cost-label">Security Deposit (refundable)</span>
                            <span class="cost-value">₱<?= number_format($securityDeposit, 2) ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="cost-row total">
                            <span class="cost-label">Total to Pay</span>
                            <span class="cost-value" id="totalAmount">₱0.00</span>
                        </div>
                    </div>

                    <?php if ($securityDeposit > 0): ?>
                    <div class="refund-note">
                        <p><strong>✓ Security deposit is fully refundable</strong></p>
                        <p>The deposit will be returned within 3 days after you return the item in good condition.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Item data from PHP
        const itemData = {
            dailyRate: <?= $dailyRate ?>,
            securityDeposit: <?= $securityDeposit ?>,
            commissionBaseFee: <?= $commissionBaseFee ?>,
            commissionPercentage: <?= $commissionPercentage ?>,
            minDuration: <?= $minDuration ?>,
            minDurationUnit: '<?= $minDurationUnit ?>',
            maxDuration: <?= $maxDuration ? $maxDuration : 'null' ?>,
            maxDurationUnit: '<?= $maxDurationUnit ?? '' ?>'
        };

        // DOM Elements
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const durationDisplay = document.getElementById('durationDisplay');
        const summaryDuration = document.getElementById('summaryDuration');
        const daysCount = document.getElementById('daysCount');
        const rentalFee = document.getElementById('rentalFee');
        const totalAmount = document.getElementById('totalAmount');
        const totalAmountInput = document.getElementById('totalAmountInput');
        const paymentAmount = document.getElementById('paymentAmount');
        const submitBtn = document.getElementById('submitBtn');
        const uploadArea = document.getElementById('uploadArea');
        const proofFile = document.getElementById('proofFile');

        // Set minimum date to today or available_from date
        const today = new Date().toISOString().split('T')[0];
        if (!startDateInput.min || startDateInput.min < today) {
            startDateInput.min = today;
        }
        endDateInput.min = today;

        // Calculate days between dates
        function calculateDays(start, end) {
            if (!start || !end) return 0;
            const startDate = new Date(start);
            const endDate = new Date(end);
            const diffTime = endDate - startDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays > 0 ? diffDays : 0;
        }

        // Convert duration to days
        function convertToDays(duration, unit) {
            switch(unit) {
                case 'day': return duration;
                case 'week': return duration * 7;
                case 'month': return duration * 30;
                default: return duration;
            }
        }

        // Validate duration against min/max
        function validateDuration(days) {
            const minDays = convertToDays(itemData.minDuration, itemData.minDurationUnit);
            const maxDays = itemData.maxDuration ? convertToDays(itemData.maxDuration, itemData.maxDurationUnit) : null;
            
            if (days < minDays) {
                return { valid: false, message: `Minimum rental duration is ${itemData.minDuration} ${itemData.minDurationUnit}${itemData.minDuration > 1 ? 's' : ''}` };
            }
            
            if (maxDays && days > maxDays) {
                return { valid: false, message: `Maximum rental duration is ${itemData.maxDuration} ${itemData.maxDurationUnit}${itemData.maxDuration > 1 ? 's' : ''}` };
            }
            
            return { valid: true };
        }

        // Calculate commission (Base Fee + Percentage)
        function calculateCommission(rentalAmount) {
            const percentageAmount = rentalAmount * (itemData.commissionPercentage / 100);
            return itemData.commissionBaseFee + percentageAmount;
        }

        // Update all calculations
        function updateCalculations() {
            const days = calculateDays(startDateInput.value, endDateInput.value);
            
            // Update duration display
            durationDisplay.querySelector('.duration-number').textContent = days;
            daysCount.textContent = days;
            
            if (days > 0) {
                const validation = validateDuration(days);
                
                if (!validation.valid) {
                    durationDisplay.style.borderColor = '#ef4444';
                    durationDisplay.querySelector('.duration-label').textContent = validation.message;
                    durationDisplay.querySelector('.duration-label').style.color = '#ef4444';
                    submitBtn.disabled = true;
                    return;
                } else {
                    durationDisplay.style.borderColor = '#e2e8f0';
                    durationDisplay.querySelector('.duration-label').textContent = 'Days Selected';
                    durationDisplay.querySelector('.duration-label').style.color = '#64748b';
                }
                
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                summaryDuration.textContent = `${days} day${days > 1 ? 's' : ''} (${startDate.toLocaleDateString('en-US', {month: 'short', day: 'numeric'})} - ${endDate.toLocaleDateString('en-US', {month: 'short', day: 'numeric'})})`;
            } else {
                summaryDuration.textContent = 'Not selected';
                durationDisplay.style.borderColor = '#e2e8f0';
                durationDisplay.querySelector('.duration-label').textContent = 'Days Selected';
                durationDisplay.querySelector('.duration-label').style.color = '#64748b';
            }

            // Calculate costs
            const rentalAmount = days * itemData.dailyRate;
            const total = rentalAmount + itemData.securityDeposit;

            // Update display
            rentalFee.textContent = `₱${rentalAmount.toFixed(2)}`;
            totalAmount.textContent = `₱${total.toFixed(2)}`;
            paymentAmount.textContent = `₱${total.toFixed(2)}`;

            // hidden input updates
            totalAmountInput.value = total.toFixed(2);

            // Enable submit button if form is complete
            checkFormCompletion();
        }

        // Check if form is complete
        function checkFormCompletion() {
            const days = calculateDays(startDateInput.value, endDateInput.value);
            const validation = validateDuration(days);
            const hasFile = proofFile.files.length > 0;
            submitBtn.disabled = !(validation.valid && hasFile);
        }

        // Date change listeners
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = '';
            }
            updateCalculations();
        });

        endDateInput.addEventListener('change', updateCalculations);

        // Payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                
                const method = this.dataset.method;
                document.getElementById('paymentMethodInput').value = method;
                
                const instructionText = document.getElementById('instructionText');
                const accountName = document.getElementById('accountName');
                const accountNumberLabel = document.getElementById('accountNumberLabel');
                const accountNumber = document.getElementById('accountNumber');
                
                if (method === 'gcash') {
                    document.querySelector('.instruction-title span').textContent = '📱';
                    instructionText.textContent = 'Send payment to this GCash account';
                    accountName.textContent = 'Rentify Platform';
                    accountNumberLabel.textContent = 'GCash Number';
                    accountNumber.textContent = '0917 123 4567';
                } else if (method === 'bank') {
                    document.querySelector('.instruction-title span').textContent = '🏦';
                    instructionText.textContent = 'Send payment to this bank account';
                    accountName.textContent = 'Rentify Corporation';
                    accountNumberLabel.textContent = 'Account Number';
                    accountNumber.textContent = '1234-5678-9012';
                }
            });
        });

        // Policy selection
        document.querySelectorAll('.policy-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.policy-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // File upload
        proofFile.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    this.value = '';
                    return;
                }
                
                uploadArea.classList.add('has-file');
                uploadArea.querySelector('.upload-icon').textContent = '✓';
                uploadArea.querySelector('.upload-text').textContent = file.name;
                uploadArea.querySelector('.upload-hint').textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
                checkFormCompletion();
            }
        });

        // Form submission
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const days = calculateDays(startDateInput.value, endDateInput.value);
            const validation = validateDuration(days);
            
            if (!validation.valid) {
                e.preventDefault();
                alert(validation.message);
                return false;
            }
            
            if (!proofFile.files[0]) {
                e.preventDefault();
                alert('Please upload payment proof');
                return false;
            }
            
            // Show loading state
            submitBtn.textContent = 'Processing...';
            submitBtn.disabled = true;
            
            // Form will submit normally to backend
            return true;
        });

        // Initialize
        updateCalculations();
    </script>
</body>
</html>