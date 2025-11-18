<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Rentify</title>
    
    <?php
    // ===============================
    // TEMPORARY DUMP DATA FOR TESTING
    // ===============================
    
    // Item ID
    $item_id = 1;
    
    // Main item data
    $item = [
        'item_id' => 1,
        'title' => 'Canon EOS R5 Camera',
        'description' => 'Professional mirrorless camera with 45MP full-frame sensor, 8K video recording, and advanced autofocus system. Perfect for photography students and content creators.',
        'category' => 'electronics',
        'quantity' => 1,
        'brand' => 'Canon',
        'location' => 'Naval, Biliran',
        'item_condition' => 'like_new',
        'return_statement' => 'Item must be returned in the same condition. Any damage will be deducted from the security deposit. Late returns will incur additional charges.',
        'security_deposit' => '5000.00',
        'status' => 'available',
        'approval_status' => 'approved'
    ];
    
    // Item images
    $item_images = [
        [
            'image_id' => 1,
            'image_path' => 'https://via.placeholder.com/400x300/4A90E2/ffffff?text=Camera+Front',
            'is_primary' => true
        ],
        [
            'image_id' => 2,
            'image_path' => 'https://via.placeholder.com/400x300/50C878/ffffff?text=Camera+Side',
            'is_primary' => false
        ],
        [
            'image_id' => 3,
            'image_path' => 'https://via.placeholder.com/400x300/FF6B6B/ffffff?text=Camera+Back',
            'is_primary' => false
        ]
    ];
    
    // Single rental pricing
    $rental_pricing = [
        'pricing_id' => 1,
        'rate_type' => 'per_day',
        'price' => '500.00',
        'minimum_duration' => 1,
        'minimum_duration_unit' => 'day',
        'maximum_duration' => 7,
        'maximum_duration_unit' => 'day'
    ];
    
    // Item availability
    $item_availability = [
        'available_from' => '2025-11-03',
        'available_until' => '2025-12-31'
    ];
    
    // Cancellation policies
    $cancellation_policies = [
        [
            'policy_id' => 1,
            'name' => 'Flexible',
            'description' => 'Full refund up to 24hrs before rental start',
            'refund_percentage' => '100.00'
        ],
        [
            'policy_id' => 2,
            'name' => 'Moderate',
            'description' => '50% refund up to 48hrs before rental start',
            'refund_percentage' => '50.00'
        ],
        [
            'policy_id' => 3,
            'name' => 'Strict',
            'description' => 'No refunds allowed',
            'refund_percentage' => '0.00'
        ]
    ];
    
    // Selected policy (current item's policy)
    $selected_policy_id = 1;
    $selected_policy = $cancellation_policies[0]; // Flexible policy
    ?>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f9fafb;
            color: #111827;
            line-height: 1.6;
        }

        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-back {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .header-title {
            font-size: 20px;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary {
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 24px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 12px;
        }

        .image-item {
            position: relative;
            aspect-ratio: 4/3;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s;
        }

        .image-item:hover {
            border-color: #2563eb;
        }

        .image-item.primary {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .image-item:hover .image-overlay {
            opacity: 1;
        }

        .image-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #2563eb;
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .btn-icon {
            background: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: #f3f4f6;
        }

        .upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 12px;
        }

        .upload-zone:hover {
            border-color: #2563eb;
            background: #f0f9ff;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            color: #9ca3af;
        }

        .info-box {
            background: #f0f9ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
        }

        .info-box h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e40af;
        }

        .info-box p {
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 4px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        @media (max-width: 1024px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .header-title {
                font-size: 18px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <button class="btn-back" onclick="window.history.back()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </button>
                <h1 class="header-title">Edit Item</h1>
            </div>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button class="btn btn-primary" id="saveBtn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <form id="editForm" method="POST" action="update_item.php" enctype="multipart/form-data">
            <!-- PHP: Dynamic item_id -->
            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
            <input type="hidden" name="pricing_id" value="<?php echo $rental_pricing['pricing_id']; ?>">
            
            <div class="grid">
                <!-- Left Column -->
                <div>
                    <!-- Basic Information -->
                    <div class="card">
                        <h2 class="card-title">Basic Information</h2>
                        
                        <div class="form-group">
                            <label class="form-label">Title *</label>
                            <!-- PHP: Dynamic value from $item['title'] -->
                            <input type="text" name="title" class="form-input" value="<?php echo htmlspecialchars($item['title']); ?>" required maxlength="150">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <!-- PHP: Dynamic value from $item['description'] -->
                            <textarea name="description" class="form-textarea"><?php echo htmlspecialchars($item['description']); ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Category *</label>
                                <select name="category" class="form-select" required>
                                    <!-- PHP: Dynamic options with selected state -->
                                    <option value="pe_costume" <?php echo $item['category'] == 'pe_costume' ? 'selected' : ''; ?>>PE Costume</option>
                                    <option value="sports_gear" <?php echo $item['category'] == 'sports_gear' ? 'selected' : ''; ?>>Sports Gear</option>
                                    <option value="textbook" <?php echo $item['category'] == 'textbook' ? 'selected' : ''; ?>>Textbook</option>
                                    <option value="uniform" <?php echo $item['category'] == 'uniform' ? 'selected' : ''; ?>>Uniform</option>
                                    <option value="lab_equipment" <?php echo $item['category'] == 'lab_equipment' ? 'selected' : ''; ?>>Lab Equipment</option>
                                    <option value="electronics" <?php echo $item['category'] == 'electronics' ? 'selected' : ''; ?>>Electronics</option>
                                    <option value="other" <?php echo $item['category'] == 'other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Quantity *</label>
                                <!-- PHP: Dynamic value from $item['quantity'] -->
                                <input type="number" name="quantity" class="form-input" value="<?php echo $item['quantity']; ?>" min="1" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Brand</label>
                                <!-- PHP: Dynamic value from $item['brand'] -->
                                <input type="text" name="brand" class="form-input" value="<?php echo htmlspecialchars($item['brand']); ?>" maxlength="25">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Condition *</label>
                                <select name="item_condition" class="form-select" required>
                                    <!-- PHP: Dynamic options with selected state -->
                                    <option value="brand_new" <?php echo $item['item_condition'] == 'brand_new' ? 'selected' : ''; ?>>Brand New</option>
                                    <option value="like_new" <?php echo $item['item_condition'] == 'like_new' ? 'selected' : ''; ?>>Like New</option>
                                    <option value="good" <?php echo $item['item_condition'] == 'good' ? 'selected' : ''; ?>>Good</option>
                                    <option value="fair" <?php echo $item['item_condition'] == 'fair' ? 'selected' : ''; ?>>Fair</option>
                                    <option value="poor" <?php echo $item['item_condition'] == 'poor' ? 'selected' : ''; ?>>Poor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <!-- PHP: Dynamic value from $item['location'] -->
                            <input type="text" name="location" class="form-input" value="<?php echo htmlspecialchars($item['location']); ?>" maxlength="150">
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="card">
                        <h2 class="card-title">Item Images</h2>
                        
                        <div class="image-grid" id="imageGrid">
                            <!-- PHP: Loop through $item_images -->
                            <?php foreach ($item_images as $image): ?>
                            <div class="image-item <?php echo $image['is_primary'] ? 'primary' : ''; ?>" data-image-id="<?php echo $image['image_id']; ?>">
                                <?php if ($image['is_primary']): ?>
                                <span class="image-badge">Primary</span>
                                <?php endif; ?>
                                <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Item image">
                                <div class="image-overlay">
                                    <button type="button" class="btn-icon" onclick="setPrimaryImage(<?php echo $image['image_id']; ?>)" title="Set as primary">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn-icon" onclick="removeImage(<?php echo $image['image_id']; ?>)" title="Remove">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="upload-zone" onclick="document.getElementById('imageUpload').click()">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p style="color: #6b7280; font-size: 14px;">Click to upload images</p>
                            <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple style="display: none;">
                        </div>
                    </div>

                    <!-- Rental Pricing (Single) -->
                    <div class="card">
                        <h2 class="card-title">Rental Pricing</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Rate Type *</label>
                                <select name="rate_type" class="form-select" required>
                                    <option value="per_day" <?php echo $rental_pricing['rate_type'] == 'per_day' ? 'selected' : ''; ?>>Per Day</option>
                                    <option value="per_week" <?php echo $rental_pricing['rate_type'] == 'per_week' ? 'selected' : ''; ?>>Per Week</option>
                                    <option value="per_month" <?php echo $rental_pricing['rate_type'] == 'per_month' ? 'selected' : ''; ?>>Per Month</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Price (₱) *</label>
                                <input type="number" name="price" class="form-input" value="<?php echo $rental_pricing['price']; ?>" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Minimum Duration *</label>
                                <input type="number" name="minimum_duration" class="form-input" value="<?php echo $rental_pricing['minimum_duration']; ?>" min="1" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Unit *</label>
                                <select name="minimum_duration_unit" class="form-select" required>
                                    <option value="day" <?php echo $rental_pricing['minimum_duration_unit'] == 'day' ? 'selected' : ''; ?>>Day(s)</option>
                                    <option value="week" <?php echo $rental_pricing['minimum_duration_unit'] == 'week' ? 'selected' : ''; ?>>Week(s)</option>
                                    <option value="month" <?php echo $rental_pricing['minimum_duration_unit'] == 'month' ? 'selected' : ''; ?>>Month(s)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Maximum Duration (Optional)</label>
                                <input type="number" name="maximum_duration" class="form-input" value="<?php echo $rental_pricing['maximum_duration']; ?>" min="1">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Unit</label>
                                <select name="maximum_duration_unit" class="form-select">
                                    <option value="">None</option>
                                    <option value="day" <?php echo $rental_pricing['maximum_duration_unit'] == 'day' ? 'selected' : ''; ?>>Day(s)</option>
                                    <option value="week" <?php echo $rental_pricing['maximum_duration_unit'] == 'week' ? 'selected' : ''; ?>>Week(s)</option>
                                    <option value="month" <?php echo $rental_pricing['maximum_duration_unit'] == 'month' ? 'selected' : ''; ?>>Month(s)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Status -->
                    <div class="card">
                        <h2 class="card-title">Status</h2>
                        
                        <div class="form-group">
                            <label class="form-label">Availability Status</label>
                            <select name="status" class="form-select" required>
                                <!-- PHP: Dynamic options with selected state -->
                                <option value="available" <?php echo $item['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
                                <option value="unavailable" <?php echo $item['status'] == 'unavailable' ? 'selected' : ''; ?>>Unavailable</option>
                                <option value="rented" <?php echo $item['status'] == 'rented' ? 'selected' : ''; ?>>Rented</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Approval Status</label>
                            <div>
                                <!-- PHP: Dynamic approval status badge -->
                                <span class="status-badge status-<?php echo $item['approval_status']; ?>">
                                    <?php echo ucfirst($item['approval_status']); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Availability Dates -->
                    <div class="card">
                        <h2 class="card-title">Availability</h2>
                        
                        <div class="form-group">
                            <label class="form-label">Available From *</label>
                            <!-- PHP: Dynamic value from $item_availability['available_from'] -->
                            <input type="date" name="available_from" class="form-input" value="<?php echo $item_availability['available_from']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Available Until</label>
                            <!-- PHP: Dynamic value from $item_availability['available_until'] -->
                            <input type="date" name="available_until" class="form-input" value="<?php echo $item_availability['available_until']; ?>">
                        </div>
                    </div>

                    <!-- Security Deposit -->
                    <div class="card">
                        <h2 class="card-title">Security & Returns</h2>
                        
                        <div class="form-group">
                            <label class="form-label">Security Deposit (₱)</label>
                            <!-- PHP: Dynamic value from $item['security_deposit'] -->
                            <input type="number" name="security_deposit" class="form-input" value="<?php echo $item['security_deposit']; ?>" step="0.01" min="0">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Return Statement</label>
                            <!-- PHP: Dynamic value from $item['return_statement'] -->
                            <textarea name="return_statement" class="form-textarea"><?php echo htmlspecialchars($item['return_statement']); ?></textarea>
                        </div>
                    </div>

                    <!-- Cancellation Policy -->
                    <div class="card">
                        <h2 class="card-title">Cancellation Policy</h2>
                        
                        <div class="form-group">
                            <label class="form-label">Select Policy</label>
                            <select name="policy_id" class="form-select" id="policySelect">
                                <!-- PHP: Dynamic options from cancellation_policies table -->
                                <?php foreach ($cancellation_policies as $policy): ?>
                                <option value="<?php echo $policy['policy_id']; ?>" <?php echo $selected_policy_id == $policy['policy_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($policy['name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="info-box" id="policyInfo">
                            <!-- PHP: Dynamic policy details -->
                            <h4><?php echo htmlspecialchars($selected_policy['name']); ?></h4>
                            <p><?php echo htmlspecialchars($selected_policy['description']); ?></p>
                            <p><strong>Refund: <?php echo $selected_policy['refund_percentage']; ?>%</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Form submission
        document.getElementById('saveBtn').addEventListener('click', function() {
            const form = document.getElementById('editForm');
            if (form.checkValidity()) {
                this.disabled = true;
                this.innerHTML = '<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Saving...';
                form.submit();
            } else {
                form.reportValidity();
            }
        });

        // Set primary image
        function setPrimaryImage(imageId) {
            // PHP will handle this via AJAX or form submission
            const formData = new FormData();
            formData.append('action', 'set_primary');
            formData.append('image_id', imageId);
            formData.append('item_id', document.querySelector('input[name="item_id"]').value);
            
            // Send to server
            fetch('update_image.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to set primary image');
            });
        }

        // Remove image
        function removeImage(imageId) {
            if (confirm('Are you sure you want to remove this image?')) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('image_id', imageId);
                
                // Send to server
                fetch('update_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`[data-image-id="${imageId}"]`).remove();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to remove image');
                });
            }
        }

        // Image upload preview
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                alert(`${files.length} image(s) selected for upload`);
            }
        });

        // Dynamic policy info update
        const policySelect = document.getElementById('policySelect');
        const policies = <?php echo json_encode($cancellation_policies); ?>;
        
        if (policySelect) {
            policySelect.addEventListener('change', function() {
                const policyId = parseInt(this.value);
                const selectedPolicy = policies.find(p => p.policy_id === policyId);
                
                if (selectedPolicy) {
                    document.getElementById('policyInfo').innerHTML = `
                        <h4>${selectedPolicy.name}</h4>
                        <p>${selectedPolicy.description}</p>
                        <p><strong>Refund: ${selectedPolicy.refund_percentage}%</strong></p>
                    `;
                }
            });
        }

        // Form validation
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const availableFrom = new Date(document.querySelector('input[name="available_from"]').value);
            const availableUntil = document.querySelector('input[name="available_until"]').value;
            
            if (availableUntil) {
                const untilDate = new Date(availableUntil);
                if (untilDate < availableFrom) {
                    e.preventDefault();
                    alert('Available Until date must be after Available From date');
                    return false;
                }
            }

            // Validate minimum/maximum duration logic
            const minDuration = parseInt(document.querySelector('input[name="minimum_duration"]').value);
            const maxDuration = document.querySelector('input[name="maximum_duration"]').value;
            
            if (maxDuration && parseInt(maxDuration) < minDuration) {
                e.preventDefault();
                alert('Maximum duration must be greater than minimum duration');
                return false;
            }
        });
    </script>
</body>
</html>