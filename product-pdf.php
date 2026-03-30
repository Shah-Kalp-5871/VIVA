<?php
/**
 * VIVA - Product Technical Data Sheet (Print View)
 */

require_once __DIR__ . '/admin/includes/config.php';

$product_slug = isset($_GET['product']) ? $_GET['product'] : null;

if (!$product_slug) {
    die("Product not specified.");
}

// Fetch Product Details
$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.slug = ? AND p.status = 'active'");
$stmt->execute([$product_slug]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}

// Functions parseField() and parseSpecs() are now globally available via functions.php

$specifications = parseSpecs($product['specifications'] ?? '');
$features = parseField($product['features'] ?? '');
$main_image = !empty($product['image']) ? $product['image'] : 'v.jpeg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($product['name']); ?> - Technical Data Sheet</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy: #001a33;
            --orange: #FF5722;
            --steel-blue: #4682B4;
        }
        
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 0;
            margin: 20px auto;
            background: white;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Symmetric Gradient Header */
        .page-header {
            height: 120px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 40px;
            gap: 20px;
        }

        .header-bar {
            height: 6px;
            flex: 1;
            max-width: 250px;
            border-radius: 3px;
        }

        .header-bar-left {
            background: linear-gradient(to right, var(--steel-blue), white);
        }

        .header-bar-right {
            background: linear-gradient(to right, white, var(--orange));
        }

        .header-center {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        .header-logo-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .header-logo-text {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .header-logo-text .navy { color: var(--navy); }
        .header-logo-text .orange { color: var(--orange); }

        .page-body {
            padding: 0 50px 50px;
        }

        .doc-title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .doc-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--orange);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .doc-main-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
            margin: 0;
            line-height: 1.1;
        }

        .doc-date {
            font-size: 12px;
            color: #777;
            font-weight: 600;
        }

        .product-info-grid {
            display: grid;
            grid-template-cols: 300px 1fr;
            gap: 40px;
            margin-bottom: 40px;
            align-items: start;
        }

        .product-image-container {
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 15px;
            background: #fafafa;
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: contain;
        }

        .product-category {
            font-size: 11px;
            font-weight: 800;
            color: var(--steel-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .product-tagline {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
            border-left: 4px solid var(--orange);
            padding-left: 15px;
            margin: 30px 0 20px;
        }

        .features-list {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-cols: 1fr 1fr;
            gap: 12px 30px;
        }

        .feature-item {
            font-size: 13px;
            color: #444;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-item i {
            color: var(--orange);
            font-size: 10px;
        }

        .specs-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .specs-table tr {
            border-bottom: 1px solid #f0f0f0;
        }

        .specs-table td {
            padding: 12px 0;
        }

        .specs-label {
            font-weight: 700;
            color: #666;
            width: 40%;
        }

        .signature-section {
            margin-top: 60px;
            text-align: right;
            padding-right: 40px;
        }

        .signature-name {
            font-family: 'Dancing Script', cursive;
            font-size: 24px;
            color: var(--navy);
            margin-bottom: 5px;
        }

        .signature-title {
            font-size: 11px;
            font-weight: 700;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .page-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fafafa;
            border-top: 1px solid #eee;
            padding: 30px 50px;
        }

        .footer-contacts-right {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
            gap: 30px;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            font-weight: 600;
            color: #666;
        }

        .footer-icon {
            width: 24px;
            height: 24px;
            background: #eee;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
        }

        .footer-icon.orange { background: var(--orange); color: white; }

        .footer-bottom-bars {
            height: 4px;
            display: flex;
            margin-top: 20px;
        }
        
        .no-print-layer {
            position: sticky;
            top: 0;
            z-index: 100;
            background: white;
            padding: 15px 0;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .btn-print {
            background: var(--navy);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-print:hover { background: #002a52; }

        @media print {
            body { background: white; }
            .no-print-layer { display: none; }
            .page { margin: 0; box-shadow: none; width: 100%; }
        }
    </style>
</head>
<body>
    <div class="no-print-layer">
        <button onclick="window.print()" class="btn-print"><i class="fas fa-file-pdf"></i> Print / Save as PDF</button>
        <a href="product-detail.php?product=<?php echo urlencode($product_slug); ?>" style="margin-top: 10px; display: inline-block; color: #666; font-size: 12px; text-decoration: none;">&larr; Back to Product</a>
    </div>

    <div class="page">
        <!-- Header -->
        <header class="page-header">
            <div class="header-bar header-bar-left"></div>
            <div class="header-center">
                <img src="<?php echo get_setting('logo_path'); ?>" alt="Logo" class="header-logo-img">
                <div class="header-logo-text">
                    <span class="navy"><?php 
                        $name = get_setting('site_name');
                        $parts = explode(' ', $name, 2);
                        echo h($parts[0]);
                    ?></span> 
                    <span class="orange"><?php echo h($parts[1] ?? ''); ?></span>
                </div>
            </div>
            <div class="header-bar header-bar-right"></div>
        </header>

        <div class="page-body">
            <div class="doc-title-section">
                <div class="doc-title-block">
                    <span class="doc-label">Technical Data Sheet</span>
                    <h2 class="doc-main-title"><?php echo h($product['name']); ?></h2>
                </div>
                <div class="doc-date">
                    Date: <?php echo date('d F, Y'); ?>
                </div>
            </div>

            <div class="product-info-grid">
                <div class="product-image-container">
                    <img src="<?php echo h($main_image); ?>" alt="<?php echo h($product['name']); ?>" class="product-image">
                </div>
                <div class="product-summary">
                    <div class="product-category"><?php echo h($product['category_name']); ?></div>
                    <div class="product-tagline"><?php echo h($product['tagline'] ?? 'Engineering Excellence for Industrial Scaling'); ?></div>
                    <p style="font-size: 13px; color: #555;">
                        This document contains official technical specifications and performance data for the <?php echo h($product['name']); ?>. 
                        Designed for precision and durability in industrial applications.
                    </p>
                </div>
            </div>

            <?php if (!empty($features)): ?>
            <h3 class="section-title">Key Features</h3>
            <ul class="features-list">
                <?php foreach ($features as $feature): ?>
                <li class="feature-item"><i class="fas fa-check"></i> <?php echo h($feature); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (!empty($specifications)): ?>
            <h3 class="section-title">Technical Specifications</h3>
            <table class="specs-table">
                <tbody>
                    <?php foreach ($specifications as $key => $value): ?>
                    <tr>
                        <td class="specs-label"><?php echo h($key); ?></td>
                        <td><?php echo h($value); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>

            <div class="signature-section">
                <div class="signature-name">Viva Engineering</div>
                <div class="signature-title">Authorized Manager</div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="page-footer">
            <ul class="footer-contacts-right">
                <li class="footer-contact-item">
                    <span><?php echo get_setting('contact_phone'); ?></span>
                    <div class="footer-icon orange"><i class="fas fa-phone"></i></div>
                </li>
                <li class="footer-contact-item">
                    <span><?php echo get_setting('contact_email'); ?></span>
                    <div class="footer-icon"><i class="fas fa-envelope"></i></div>
                </li>
                <li class="footer-contact-item">
                    <span><?php echo get_setting('site_url'); ?></span>
                    <div class="footer-icon"><i class="fas fa-globe"></i></div>
                </li>
            </ul>

            <div class="footer-bottom-bars"></div>
        </footer>
    </div>
</body>
</html>
