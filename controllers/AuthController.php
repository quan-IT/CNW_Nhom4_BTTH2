<<?php
// controllers/AuthController.php

require_once 'models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new User();
    }

    /**
     * Hiển thị trang đăng ký và xử lý logic đăng ký
     * URL: /register
     */
    public function register()
    {
        $message = ''; // Biến để lưu thông báo lỗi/thành công

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $fullname = trim($_POST['fullname'] ?? '');

            // 1. Kiểm tra dữ liệu bắt buộc
            if (empty($username) || empty($email) || empty($password) || empty($fullname)) {
                $message = "Vui lòng điền đầy đủ các trường.";
            } 
            // 2. Kiểm tra tồn tại
            else if ($this->userModel->checkExists($username, $email)) {
                $message = "Tên người dùng hoặc Email đã tồn tại.";
            } 
            // 3. Tiến hành đăng ký
            else {
                // Băm mật khẩu (Hashing) trước khi lưu vào CSDL
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Mặc định role = 0 (Học viên)
                if ($this->userModel->register($username, $email, $hashed_password, $fullname, 0)) {
                    $message = "Đăng ký thành công! Vui lòng đăng nhập.";
                    // Có thể chuyển hướng thẳng về trang đăng nhập
                    header("Location: /login");
                    exit;
                } else {
                    $message = "Đăng ký thất bại. Vui lòng thử lại sau.";
                }
            }
        }

        // Tải View đăng ký, truyền thông báo nếu có
        include 'views/auth/register.php';
    }

    /**
     * Hiển thị trang đăng nhập và xử lý logic đăng nhập
     * URL: /login
     */
    public function login()
    {
        $message = ''; // Biến để lưu thông báo lỗi

        // Kiểm tra nếu đã đăng nhập rồi thì chuyển hướng về trang chủ
        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? ''); // Có thể là username hoặc email
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $message = "Vui lòng nhập Tên người dùng/Email và Mật khẩu.";
            } else {
                // Gọi hàm login trong User Model
                $user = $this->userModel->login($username, $password);

                if ($user) {
                    // Đăng nhập thành công, lưu thông tin vào session
                    $_SESSION['user'] = $user;

                    // Chuyển hướng theo vai trò (role)
                    if ($user['role'] == 2) {
                        // Admin: Chuyển hướng đến trang quản trị
                        header("Location: /admin/dashboard");
                    } else {
                        // Học viên/Giảng viên: Chuyển hướng đến trang chủ
                        header("Location: /");
                    }
                    exit;
                } else {
                    $message = "Tên người dùng hoặc Mật khẩu không đúng, hoặc tài khoản đang bị vô hiệu hóa.";
                }
            }
        }

        // Tải View đăng nhập, truyền thông báo nếu có
        include 'views/auth/login.php';
    }

    /**
     * Đăng xuất
     * URL: /logout
     */
    public function logout()
    {
        // Hủy session của người dùng
        session_unset();
        session_destroy();

        // Chuyển hướng về trang chủ hoặc trang đăng nhập
        header("Location: /login"); 
        exit;
    }
}
