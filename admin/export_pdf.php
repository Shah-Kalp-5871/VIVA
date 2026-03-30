<?php
/**
 * VIVA Admin - Export Products to PDF (Print View)
 */

require_once 'includes/config.php';

// Check login
check_admin_login();

// Build category stats for the summary
$total_categories = count($product_categories);
$total_subproducts = 0;
$total_variants = 0;

foreach ($product_categories as $cat) {
    if (isset($cat['sub_categories'])) {
        $total_subproducts += count($cat['sub_categories']);
        foreach ($cat['sub_categories'] as $sub) {
            if (isset($sub['variants'])) {
                $total_variants += count($sub['variants']);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVA Products Report - <?php echo date('Y-m-d'); ?></title>
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
            width: 45px;
            height: 45px;
            object-fit: contain;
            border: 1px solid #eee;
            padding: 2px;
        }

        .header-logo-text {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .header-logo-text .navy {
            color: var(--navy);
        }

        .header-logo-text .orange {
            color: var(--orange);
        }

        /* Body Section */
        .page-body {
            padding: 40px 70px 140px 70px;
        }

        .doc-title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }

        .doc-title-block {
            text-align: left;
        }

        .doc-label {
            color: var(--orange);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

        .doc-main-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--navy);
            margin: 0;
            text-transform: uppercase;
        }

        .doc-date {
            text-align: right;
            font-size: 13px;
            color: #777;
            font-weight: 600;
        }

        /* List Styling V4 */
        .category-list {
            list-style-type: none;
            counter-reset: category-counter;
            padding: 0;
        }
        .category-item {
            margin-bottom: 30px;
            counter-increment: category-counter;
        }
        .category-title {
            font-weight: 800;
            font-size: 16px;
            color: #000;
            margin-bottom: 12px;
            display: flex;
            align-items: baseline;
        }
        .category-title::before {
            content: counter(category-counter) ". ";
            color: var(--orange);
            margin-right: 10px;
        }
        
        .sub-category-list {
            list-style-type: none;
            padding-left: 20px;
        }
        .sub-category-item {
            margin-bottom: 12px;
        }
        .sub-category-title {
            font-weight: 700;
            font-size: 14px;
            color: #444;
            display: flex;
            align-items: baseline;
        }
        .sub-category-title i {
            font-size: 10px;
            color: var(--orange);
            margin-right: 10px;
        }
        
        .variant-list {
            list-style-type: none;
            padding-left: 25px;
            margin-top: 5px;
        }
        .variant-item {
            font-size: 13px;
            color: #666;
            margin-bottom: 4px;
            display: flex;
            align-items: baseline;
        }
        .variant-item::before {
            content: "\2022";
            color: var(--orange);
            margin-right: 10px;
            font-weight: 800;
        }

        /* V4 Signature & Footer */
        .signature-section {
            margin-top: 60px;
            padding-left: 20px;
        }

        .signature-name {
            font-family: 'Dancing Script', cursive;
            font-size: 28px;
            color: var(--navy);
            margin-bottom: 5px;
        }

        .signature-title {
            font-size: 12px;
            color: #777;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .page-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
        }

        .footer-contacts-right {
            position: absolute;
            bottom: 40px;
            right: 60px;
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }

        .footer-contact-item {
            font-size: 12px;
            color: #444;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .footer-icon {
            width: 24px;
            height: 24px;
            background: var(--navy);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .footer-icon.orange {
            background: var(--orange);
        }

        .footer-bottom-bars {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 12px;
            background: linear-gradient(to right, 
                var(--steel-blue) 0%, 
                var(--steel-blue) 45%, 
                white 55%, 
                var(--orange) 65%, 
                var(--orange) 100%
            );
        }

        /* No Print Layer */
        .no-print-layer {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .btn-print {
            background: var(--orange);
            color: white;
            border: none;
            padding: 12px 25px;
            font-weight: 700;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 87, 34, 0.4);
            transition: all 0.3s;
        }

        @media print {
            .no-print-layer { display: none; }
            body { background: white; }
            .page { margin: 0; box-shadow: none; border: none; }
        }
    </style>
</head>
<body>
    <div class="no-print-layer">
        <button onclick="window.print()" class="btn-print"><i class="fas fa-file-pdf mr-2"></i> Print to PDF</button>
    </div>

    <div class="page">
        <!-- Symmetric Gradient Header -->
        <header class="page-header">
            <div class="header-bar header-bar-left"></div>
            <div class="header-center">
                <img src="../v.jpeg" alt="Logo" class="header-logo-img">
                <div class="header-logo-text">
                    <span class="navy">VIVA</span> <span class="orange">ENGINEERING</span>
                </div>
            </div>
            <div class="header-bar header-bar-right"></div>
        </header>

        <div class="page-body">
            <div class="doc-title-section">
                <div class="doc-title-block">
                    <span class="doc-label">Official Report</span>
                    <h2 class="doc-main-title">Product group</h2>
                </div>
                <div class="doc-date">
                    Date: <?php echo date('d F, Y'); ?>
                </div>
            </div>

            <div class="content">
                <ul class="category-list">
                    <?php foreach ($product_categories as $cat_slug => $category): ?>
                        <li class="category-item">
                            <div class="category-title"><?php echo $category['name']; ?></div>
                            
                            <?php if (isset($category['sub_categories']) && !empty($category['sub_categories'])): ?>
                                <ul class="sub-category-list">
                                    <?php foreach ($category['sub_categories'] as $sub_slug => $sub_category): ?>
                                        <li class="sub-category-item">
                                            <div class="sub-category-title"><i class="fas fa-chevron-right"></i> <?php echo $sub_category['name']; ?></div>
                                            
                                            <?php if (isset($sub_category['variants']) && !empty($sub_category['variants'])): ?>
                                                <ul class="variant-list">
                                                    <?php foreach ($sub_category['variants'] as $var_slug => $variant): ?>
                                                        <li class="variant-item"><?php echo $variant['name']; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="signature-section">
                <div class="signature-name">Viva Engineering</div>
                <div class="signature-title">Authorized Manager</div>
            </div>
        </div>

        <!-- V4 Footer -->
        <footer class="page-footer">
            <ul class="footer-contacts-right">
                <li class="footer-contact-item">
                    <span>+91 123 456 7890</span>
                    <div class="footer-icon orange"><i class="fas fa-phone"></i></div>
                </li>
                <li class="footer-contact-item">
                    <span>info@vivaengineering.com</span>
                    <div class="footer-icon"><i class="fas fa-envelope"></i></div>
                </li>
                <li class="footer-contact-item">
                    <span>www.vivaengineering.com</span>
                    <div class="footer-icon"><i class="fas fa-globe"></i></div>
                </li>
            </ul>

            <div class="footer-bottom-bars"></div>
        </footer>
    </div>
</body>
</html>
