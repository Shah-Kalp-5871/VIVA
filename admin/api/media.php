<?php
header('Content-Type: application/json');
require_once '../includes/functions.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'fetch':
        try {
            // Clear any previous output (whitespaces, notices) to ensure clean JSON
            if (ob_get_length()) ob_clean();
            
            // Proactive check if table exists
            $tableCheck = $pdo->query("SHOW TABLES LIKE 'media'");
            if ($tableCheck->rowCount() == 0) {
                echo json_encode(['success' => false, 'message' => 'Media table missing. Please run admin/setup_media.php']);
                exit;
            }

            // Pagination
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 12;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Total count for pagination UI
            $totalStmt = $pdo->query("SELECT COUNT(*) FROM media");
            $total = $totalStmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT * FROM media ORDER BY id DESC LIMIT ? OFFSET ?");
            $stmt->execute([$limit, $offset]);
            $media = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true, 
                'data' => $media,
                'pagination' => [
                    'total' => (int)$total,
                    'limit' => $limit,
                    'page' => $page,
                    'pages' => ceil($total / $limit)
                ]
            ]);
        } catch (PDOException $e) {
            if (ob_get_length()) ob_clean();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;

    case 'upload':
        if (!isset($_FILES['files'])) {
            echo json_encode(['success' => false, 'message' => 'No files uploaded.']);
            exit;
        }

        $files = $_FILES['files'];
        $uploaded = [];
        $errors = [];

        // Normalize files array if multiple
        $file_count = is_array($files['name']) ? count($files['name']) : 1;

        for ($i = 0; $i < $file_count; $i++) {
            $file = [
                'name' => is_array($files['name']) ? $files['name'][$i] : $files['name'],
                'type' => is_array($files['type']) ? $files['type'][$i] : $files['type'],
                'tmp_name' => is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'],
                'error' => is_array($files['error']) ? $files['error'][$i] : $files['error'],
                'size' => is_array($files['size']) ? $files['size'][$i] : $files['size'],
            ];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = "Error uploading " . $file['name'];
                continue;
            }

            // Custom upload logic for media library
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!in_array($file['type'], $allowed_types)) {
                $errors[] = $file['name'] . " has an invalid file type.";
                continue;
            }

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_filename = 'viva_media_' . time() . '_' . uniqid() . '.' . $ext;
            $target_dir = '../../uploads/media/';
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $file_path = 'uploads/media/' . $new_filename;
                
                // Save to DB
                $stmt = $pdo->prepare("INSERT INTO media (file_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?)");
                $stmt->execute([$file['name'], $file_path, $file['type'], $file['size']]);
                
                $uploaded[] = [
                    'id' => $pdo->lastInsertId(),
                    'file_name' => $file['name'],
                    'file_path' => $file_path
                ];
            } else {
                $errors[] = "Failed to move " . $file['name'];
            }
        }

        echo json_encode([
            'success' => count($uploaded) > 0,
            'uploaded' => $uploaded,
            'errors' => $errors
        ]);
        break;

    case 'delete':
        $id = $_POST['id'] ?? null;
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'No ID provided.']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("SELECT file_path FROM media WHERE id = ?");
            $stmt->execute([$id]);
            $item = $stmt->fetch();

            if ($item) {
                $full_path = '../../' . $item['file_path'];
                if (file_exists($full_path)) {
                    unlink($full_path);
                }
                
                $stmt = $pdo->prepare("DELETE FROM media WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Media not found.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}
