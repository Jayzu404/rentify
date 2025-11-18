<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - Rentify</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
            background: #fafafa;
            color: #1a1a1a;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 80px 24px;
        }

        .status-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 32px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.2);
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            color: #0a0a0a;
        }

        .subtitle {
            text-align: center;
            color: #666;
            font-size: 15px;
            margin-bottom: 48px;
            line-height: 1.6;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 20px;
            border: 1px solid #e8e8e8;
        }

        .booking-ref {
            text-align: center;
            padding: 20px;
            background: #f8f8f8;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        .booking-ref-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #888;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .booking-ref-value {
            font-size: 20px;
            font-weight: 600;
            font-family: 'SF Mono', Monaco, monospace;
            color: #0a0a0a;
            letter-spacing: 0.02em;
        }

        .timeline {
            position: relative;
            padding-left: 32px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 32px;
            bottom: 32px;
            width: 2px;
            background: #e8e8e8;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 32px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -28px;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e8e8e8;
        }

        .timeline-item.active .timeline-dot {
            border-color: #10b981;
            background: #10b981;
        }

        .timeline-item.completed .timeline-dot {
            border-color: #10b981;
            background: white;
        }

        .timeline-item.completed .timeline-dot::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 10px;
            color: #10b981;
            font-weight: 700;
        }

        .timeline-content h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #0a0a0a;
        }

        .timeline-content p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .timeline-item.active .timeline-content h3 {
            color: #10b981;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 14px;
            color: #666;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 500;
            color: #0a0a0a;
            text-align: right;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 3px solid #3b82f6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .info-box h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #0a0a0a;
        }

        .info-box p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .action-group {
            display: grid;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: block;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #0a0a0a;
            color: white;
        }

        .btn-primary:hover {
            background: #2a2a2a;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            color: #0a0a0a;
            border: 1.5px solid #e8e8e8;
        }

        .btn-secondary:hover {
            border-color: #d0d0d0;
            background: #fafafa;
        }

        .support-link {
            text-align: center;
            margin-top: 32px;
        }

        .support-link a {
            color: #666;
            font-size: 14px;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }

        .support-link a:hover {
            border-bottom-color: #666;
        }

        @media (max-width: 640px) {
            .container {
                padding: 48px 20px;
            }

            h1 {
                font-size: 24px;
            }

            .card {
                padding: 24px;
            }

            .detail-row {
                flex-direction: column;
                gap: 4px;
            }

            .detail-value {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-icon">✓</div>
        
        <h1>Booking Confirmed</h1>
        <p class="subtitle">Your payment is secured in escrow. We're reviewing your booking and will notify you once the owner confirms availability.</p>

        <div class="card">
            <div class="booking-ref">
                <div class="booking-ref-label">Booking Reference</div>
                <div class="booking-ref-value">BKG-A7F2K9M1</div>
            </div>

            <div class="timeline">
                <div class="timeline-item completed">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Payment Received</h3>
                        <p>Your payment is held securely in escrow</p>
                    </div>
                </div>

                <div class="timeline-item active">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Pending Owner Confirmation</h3>
                        <p>We're verifying availability with the owner</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Contact Details Released</h3>
                        <p>You'll receive owner information to arrange pickup</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>Rental Active</h3>
                        <p>Payment released to owner after item pickup</p>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h4>What happens next?</h4>
                <p>The owner has 24 hours to confirm availability. If they cannot fulfill your booking, you'll receive a full refund automatically. Once confirmed, we'll share their contact details for pickup coordination.</p>
            </div>
        </div>

        <div class="card">
            <div class="detail-row">
                <span class="detail-label">Item</span>
                <span class="detail-value">Advanced Calculus Textbook</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Rental Period</span>
                <span class="detail-value">Nov 10 - Nov 17 (7 days)</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Paid</span>
                <span class="detail-value">₱850.00</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">Awaiting Confirmation</span>
            </div>
        </div>

        <div class="action-group">
            <a href="/dashboard/bookings" class="btn btn-primary">View My Bookings</a>
            <a href="/item/browse" class="btn btn-secondary">Continue Browsing</a>
        </div>

        <div class="support-link">
            <a href="/support">Need help? Contact Support</a>
        </div>
    </div>
</body>
</html>