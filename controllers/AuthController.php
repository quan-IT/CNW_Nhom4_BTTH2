<?php
<<<<<<< HEAD
// controllers/AuthController.php

require_once 'models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        // Khởi tạo Model User.
        // ✅ Đã sửa: Không cần truyền tham số DB vì User.php tự khởi tạo kết nối.
        $this->userModel = new User(); 
        
        // Bắt đầu session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /* ================= XỬ LÝ ĐĂNG NHẬP (LOGIN) ================= */

    public function login()
    {
        // Nếu có dữ liệu POST (người dùng nhấn nút Đăng nhập)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $errors = [];

            if (empty($username) || empty($password)) {
                $errors[] = "Vui lòng nhập đầy đủ Tên người dùng/Email và Mật khẩu.";
            }

            if (empty($errors)) {
                // ✅ Sử dụng hàm login() có sẵn trong User.php
                $user = $this->userModel->login($username, $password);

                if ($user) {
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'fullname' => $user['fullname'],
                        'role'     => $user['role'],
                    ];
                    
                    // Chuyển hướng theo Role (2=Admin, 1=Giảng viên, 0=Học viên)
                    if ($user['role'] == 2) {
                        header("Location: /admin/dashboard");
                    } else if ($user['role'] == 1) {
                        header("Location: /instructor/dashboard");
                    } else {
                        header("Location: /student/dashboard");
                    }
                    exit;
                } else {
                    $errors[] = "Tên người dùng hoặc mật khẩu không chính xác.";
                }
            }
            // Nếu có lỗi, hiển thị lại trang đăng nhập kèm thông báo lỗi
            $login_errors = $errors;
            include 'views/auth/login.php';
        } else {
            // Hiển thị trang đăng nhập khi truy cập bằng GET
            include 'views/auth/login.php';
        }
    }

    /* ================= XỬ LÝ ĐĂNG KÝ (REGISTER) ================= */

    public function register()
    {
        // Nếu có dữ liệu POST (người dùng nhấn nút Đăng ký)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $fullname = trim($_POST['fullname'] ?? '');
            $errors = [];

            // 1. Validate cơ bản
            if (empty($username) || empty($email) || empty($password) || empty($fullname)) {
                $errors[] = "Vui lòng điền đầy đủ thông tin.";
            }

            // 2. Kiểm tra tồn tại (sử dụng hàm checkExists() có sẵn trong User.php)
            if (empty($errors) && $this->userModel->checkExists($username, $email)) { 
                $errors[] = "Tên người dùng hoặc Email đã tồn tại.";
            }

            if (empty($errors)) {
                // 3. Hash mật khẩu (QUAN TRỌNG)
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // ✅ Sử dụng hàm register() có sẵn trong User.php
                if ($this->userModel->register($username, $email, $hashed_password, $fullname, 0)) { // Mặc định role = 0 (Học viên)
                    $_SESSION['success_message'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                    header("Location: /login");
                    exit;
                } else {
                    $errors[] = "Đã xảy ra lỗi trong quá trình đăng ký, vui lòng thử lại.";
                }
            }
            
            // Nếu có lỗi, hiển thị lại trang đăng ký kèm thông báo lỗi
            $registration_errors = $errors;
            include 'views/auth/register.php';

        } else {
            // Hiển thị trang đăng ký khi truy cập bằng GET
            include 'views/auth/register.php';
        }
    }

    /* ================= LOGOUT ================= */
    
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login");
        exit;
    }
=======
class AuthController{
  public function login(){
    include "./views/auth/login.php";
  }

  public function register(){
    include "./views/auth/register.php";
  }
>>>>>>> 588dd344f340677b78e53db84f6e74df4336bb81
}