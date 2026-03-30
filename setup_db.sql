-- VIVA Database Setup Script
-- Hierarchical Categories and Products

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create Database (User should run this or select their DB)
-- CREATE DATABASE IF NOT EXISTS viva_db;
-- USE viva_db;

-- --------------------------------------------------------

-- TABLE: categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `fk_parent_category` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- TABLE: products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `specifications` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- SEED DATA: Level 1 Categories
INSERT INTO `categories` (`name`, `slug`, `parent_id`) VALUES
('Slitting Rewinding Applications', 'slitting-rewinding-applications', NULL),
('Center Shaft Slitting Rewinding Machines', 'center-shaft-slitting-rewinding', NULL),
('Roll to Roll Processing Machines', 'roll-to-roll-processing', NULL),
('Aluminium Foil Processing Machines', 'aluminium-foil-processing', NULL),
('Printing Converting & Processing Machines', 'printing-converting-processing', NULL),
('Adhesive Tape Processing Machines', 'adhesive-tape-processing', NULL),
('Coating Processing Machines', 'coating-processing', NULL),
('Plastic Film Embossing Machine', 'plastic-film-embossing', NULL),
('Extra Converting Machines & Equipment', 'extra-converting-equipment', NULL);

-- SEED DATA: Subcategories (Linked to Level 1)
-- Get IDs dynamically in a real app, but here we assume IDs 1-9 for seed
INSERT INTO `categories` (`name`, `slug`, `parent_id`) VALUES
-- Slitting Rewinding (ID 1)
('Paper Slitting Rewinding Machine', 'paper-slitting-rewinding', 1),
('Plastic Slitting Rewinding Machine', 'plastic-slitting-rewinding', 1),
('Non-woven Slitting Rewinding Machine', 'non-woven-slitting-rewinding', 1),

-- Center Shaft (ID 2)
('Paper Center Shaft Slitting Rewinding Machine', 'paper-center-shaft-slitting', 2),
('Plastic Center Shaft Slitting Rewinding Machine', 'plastic-center-shaft-slitting', 2),

-- Roll to Roll (ID 3)
('Winding Rewinding Machine', 'winding-rewinding', 3),
('Doctoring Rewinding Machine for batch Coding', 'doctoring-rewinding-coding', 3),
('Paper Rewinding Machine', 'paper-rewinding', 3),
('HM Paper / Notebook Rewinding Machine', 'hm-paper-notebook-rewinding', 3),

-- Aluminium Foil (ID 4)
('Aluminium Foil Rewinding Machine', 'aluminium-foil-rewinding', 4),
('Aluminium Jumbo Roll Slitting Machine', 'aluminium-jumbo-roll-slitting', 4),

-- Printing (ID 5)
('Rotogravure Printing Machine', 'rotogravure-printing', 5),
('Flexographic Printing Machine', 'flexographic-printing', 5),

-- Adhesive Tape (ID 6)
('BOPP Tape Slitting & Rewinding Machine', 'bopp-tape-slitting-rewinding', 6),
('Masking Tape Rewinding Machine', 'masking-tape-rewinding', 6),
('Slicer Cutting Machine', 'slicer-cutting-machine', 6),
('PVC Tape Cutting Machine', 'pvc-tape-cutting-machine', 6),

-- Coating (ID 7)
('BOPP Tape Coating Machine', 'bopp-tape-coating', 7),
('Water Base Coating Machine', 'water-base-coating', 7),
('Paper Coating Machine', 'paper-coating', 7),
('Foam tape coating machine', 'foam-tape-coating', 7),

-- Extra Converting (ID 9)
('Web Guide System', 'web-guide-system', 9),
('Air Shafts', 'air-shafts', 9),
('Safety Chucks', 'safety-chucks', 9),
('wrapping Machine', 'wrapping-machine', 9),
('Core Cutting Machine', 'core-cutting-machine-extra', 9);

-- SEED DATA: Sub-Subcategories (Linked to Level 2)
-- Link specific variants to BOPP Tape and Slicer (assuming IDs from above)
-- Since IDs can vary, this is illustrative. A PHP seeder is better for exactness.

COMMIT;
