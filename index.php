<?php
// index.php
session_start();
// Bật lỗi (tắt khi lên host)  
define('BASE_DIR', __DIR__);
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Autoload models, controllers
spl_autoload_register(function ($class) {
    // Đảm bảo tìm kiếm cả trong thư mục con 'instructor/'
    $paths = ['controllers/', 'models/', 'controllers/instructor/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load cấu hình DB
require_once 'config/Database.php';

// Lấy URL: domain.com/index.php?url=controller/action/param
$url = isset($_GET['url']) ? $_GET['url'] : 'home/index'; // Default to 'home/index'
$url = trim($url, '/');

// Xử lý URL thành các phần tử (đảm bảo luôn có ít nhất 1 phần tử)
$parts = explode('/', $url);

// Đảm bảo $parts không rỗng nếu $url bị trống (mặc dù default là 'home/index' đã đảm bảo)
if (empty($parts) || $parts[0] === '') {
    $parts = ['home', 'index'];
}

// Controller
$requestedController = $parts[0]; // home, course, lesson, etc.
$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;


// --- LOGIC XỬ LÝ CONTROLLER NAME VÀ VỊ TRÍ ---

$instructorControllers = ['course', 'lesson', 'material'];
$controllerName = ucfirst($requestedController) . "Controller";

if (in_array($requestedController, $instructorControllers)) {
    // Nếu Controller thuộc khu vực Instructor, tên Class vẫn là CourseController
    // và Autoload sẽ tìm file trong controllers/instructor/
    // (Không cần sửa $controllerName hay $controllerPath ở đây vì Autoload đã lo)
} else {
    // Controller thường (home, auth,...)
    // Autoload sẽ tìm file trong controllers/
}

// --- KẾT THÚC LOGIC XỬ LÝ ---

// Gọi controller (Autoload sẽ tự tìm file và require_once)
try {
    $controller = new $controllerName();

    // Kiểm tra action
    if (!method_exists($controller, $action)) {
        die("Action '$action' không tồn tại trong controller '$controllerName'");
    }

    // Gọi hàm xử lý
    if ($param !== null) {
        $controller->$action($param);
    } else {
        $controller->$action();
    }
    return;
} catch (Error $e) {
    // Bắt lỗi khi Class không được tìm thấy (Autoload thất bại)
    if (strpos($e->getMessage(), "Class '{$controllerName}' not found") !== false) {
        die("Controller '$controllerName' không tồn tại!");
    }
    // Xử lý lỗi khác (ví dụ: lỗi cú pháp trong Controller/Model)
    die("Lỗi hệ thống không xác định: " . $e->getMessage());
}


////Router (Quân)
// require_once 'controllers/EnrollmentController.php';

// $EnrollmentControlle = new EnrollmentController();

// // Lấy action từ URL
// $action = $_GET['action'] ?? 'default';

// switch ($action) {
//     case 'register_course':
//         $EnrollmentControlle->register($id, $id);
//         break;
//     default:
//         echo "404 Not Found";
//         break;
// }
