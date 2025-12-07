<?php
// Bật lỗi (tắt khi lên host)  
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Autoload models, controllers
spl_autoload_register(function ($class) {
    $paths = ['controllers/', 'models/'];
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
$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$url = trim($url, '/');
$parts = explode('/', $url);

// Controller
$controllerName = ucfirst($parts[0]) . "Controller";
$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

// Kiểm tra controller tồn tại
if (!file_exists("controllers/$controllerName.php")) {
    die("Controller '$controllerName' không tồn tại!");
}

// Gọi controller
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
