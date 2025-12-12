<?php
// helpers/FileUploader.php

class FileUploader {
    private $upload_dir;
    // Cấu hình các loại file cho phép (ví dụ)
    private $allowed_types = [
        'application/pdf' => 'pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/msword' => 'doc',
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'application/zip' => 'zip'
    ];
    private $max_size = 5242880; // 5MB in bytes

    public function __construct($upload_dir) {
        $this->upload_dir = $upload_dir;
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0777, true);
        }
    }

    public function handleUpload($file) {

        $file_type = mime_content_type($file['tmp_name']);
    
    // BỔ SUNG: Kiểm tra xem mime_content_type có trả về giá trị hợp lệ không
    if (!$file_type || !is_string($file_type)) {
        return ['success' => false, 'error' => 'Không thể xác định loại file (MIME type).'];
    }

    if (!array_key_exists($file_type, $this->allowed_types)) {
        return ['success' => false, 'error' => 'Loại file không được phép: ' . htmlspecialchars($file_type)];
    }
        // ... (các kiểm tra) ...

        $extension = $this->allowed_types[$file_type];

        // 3. Tạo tên file mới an toàn
        $new_filename = uniqid('file_', true) . '.' . $extension;
        $target_file = $this->upload_dir . $new_filename;

        // 4. Di chuyển file
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            
            // THÊM: Tính toán đường dẫn tương đối để lưu vào CSDL
            // Giả định $this->upload_dir = BASE_DIR . '/uploads/materials/'
            
            // Chúng ta cần một biến chứa BASE_DIR (được định nghĩa trong index.php)
            // LƯU Ý: Phải đảm bảo BASE_DIR được định nghĩa và có thể truy cập được ở đây
            if (defined('BASE_DIR')) {
                $db_file_path = str_replace(BASE_DIR . '/', '', $target_file);
            } else {
                // Xử lý lỗi nếu BASE_DIR không được định nghĩa
                $db_file_path = $target_file; 
                // LƯU Ý: Nếu BASE_DIR không định nghĩa, $db_file_path sẽ là đường dẫn tuyệt đối,
                // có thể gây lỗi sau này nếu chuyển server. Cần kiểm tra lại Autoload/Router.
            }

            return [
                'success' => true,
                'filepath_db' => $db_file_path, // <-- Đã được gán giá trị!
                'filepath_full' => $target_file, 
                'original_name' => basename($file['name']),
                'file_type' => $file_type,
            ];
        } else {
            return ['success' => false, 'error' => 'Không thể di chuyển file đã upload.'];
        }
    }
}
?>