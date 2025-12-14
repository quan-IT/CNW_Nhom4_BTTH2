<?php
// controllers/AdminController.php

require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/Course.php';
require_once 'models/Enrollment.php';
// Tùy chọn: Thêm dòng này nếu Database.php chưa được require ở nơi khác (thường là không cần)
// require_once 'config/Database.php'; 

class AdminController
{
    private $userModel;
    private $categoryModel;
    private $courseModel;
    private $enrollmentModel;

    public function __construct()
    {
        // 1. Khởi tạo Session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // 2. Kiểm tra quyền Admin (role = 2) và chuyển hướng
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? 0) != 2) {
            header("Location: /login"); 
            exit;
        }

        // 3. Khởi tạo Models
        $this->userModel       = new User();
        $this->categoryModel   = new Category();
        $this->courseModel     = new Course();
        $this->enrollmentModel = new Enrollment();
    }

    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        // ✅ Dùng hàm getAllUsers() có sẵn
        $totalUsers = $this->userModel->getAllUsers()->rowCount(); 
        
        $stats = [
            'total_users'       => $totalUsers,
            // ❌ KHÔNG KHẢ DỤNG: Các hàm này chưa có trong các Model tương ứng
            'courses'           => "N/A (Thiếu hàm countAll trong Course.php)", 
            'enrollments'       => "N/A (Thiếu hàm countAll trong Enrollment.php)" 
        ];

        include 'views/admin/dashboard.php';
    }

    /* ================= USER MANAGEMENT (CRUD) ================= */
    
    public function manageUsers()
    {
        // ✅ Dùng getAllUsers()
        $users = $this->userModel->getAllUsers()->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/users/manage.php';
    }

    public function toggleUserStatus($id)
    {
        // ✅ Dùng toggleUserStatus($id)
        $this->userModel->toggleUserStatus($id);
        header("Location: /admin/users/manage"); 
        exit;
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $fullname = trim($_POST['fullname'] ?? '');
            $role     = (int)($_POST['role'] ?? 0);
            
            if (empty($password) || $this->userModel->checkExists($username, $email)) {
                 // Xử lý lỗi: Mật khẩu trống hoặc User đã tồn tại
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->register($username, $email, $hashed_password, $fullname, $role);
            }
            
            header("Location: /admin/users/manage");
            exit;
        }
        include 'views/admin/users/create.php';
    }

    public function editUser($id)
    {
        $id = (int)$id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $email    = trim($_POST['email'] ?? ''); // Thêm email
            $role     = (int)($_POST['role'] ?? 0);
            $password = $_POST['password'] ?? '';
            
            // 1. Cập nhật thông tin cơ bản: ✅ FIX LỖI: Gọi updateUser với 3 tham số
            $this->userModel->updateUser($id, $fullname, $email); 
            
            // 2. Cập nhật Role
            $this->userModel->updateRole($id, $role);

            // 3. Cập nhật mật khẩu nếu có nhập: ✅ FIX LỖI: Dùng changePassword()
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->changePassword($id, $hashed_password); 
            }
            
            header("Location: /admin/users/manage");
            exit;
        }

        // ✅ Dùng getUserById()
        $user = $this->userModel->getUserById($id); 
        if (!$user) {
            header("Location: /admin/users/manage");
            exit;
        }
        include 'views/admin/users/edit.php';
    }

    public function deleteUser($id)
    {
        // ✅ Dùng deleteUser($id)
        $this->userModel->deleteUser($id); 
        header("Location: /admin/users/manage");
        exit;
    }

    /* ================= CATEGORY MANAGEMENT ================= */

    public function manageCategories() 
    {
        // ✅ Dùng getAllCategories()
        $categories = $this->categoryModel->getAllCategories();
        include 'views/admin/categories/manage.php'; 
    }

    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'];
            
            // ✅ Dùng createCategory()
            $this->categoryModel->createCategory($name, $description);
            header("Location: /admin/categories/manage"); 
            exit;
        }
        include 'views/admin/categories/create.php';
    }

    public function editCategory($id)
    {
        $id = (int)$id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id     = $_POST['id'] ?? $id; 
            $name        = $_POST['name'];
            $description = $_POST['description'];

            // ✅ Dùng updateCategory()
            $this->categoryModel->updateCategory($post_id, $name, $description); 
            header("Location: /admin/categories/manage"); 
            exit;
        }

        // ✅ Dùng getCategoryById()
        $category = $this->categoryModel->getCategoryById($id); 
        include 'views/admin/categories/edit.php';
    }

    public function deleteCategory($id)
    {
        // ✅ Dùng deleteCategory()
        $this->categoryModel->deleteCategory($id);
        header("Location: /admin/categories/manage"); 
        exit;
    }

    /* ================= COURSE APPROVAL & STATISTICS ================= */
    
    // ❌ CÁC HÀM NÀY ĐÃ ĐƯỢC LOẠI BỎ ĐỂ TRÁNH LỖI "Undefined method"
    // public function pendingCourses() { ... }
    // public function approveCourse($id) { ... }
    // public function rejectCourse($id) { ... }

    public function statistics()
    {
        // ✅ Dùng countByRole() có sẵn trong User.php
        $data = [
            'top_courses' => "N/A (Thiếu hàm topEnrollCourses)",
            'students'    => $this->userModel->countByRole(0),
            'instructors' => $this->userModel->countByRole(1),
            'admins'      => $this->userModel->countByRole(2)
        ];

        include 'views/admin/reports/statistics.php'; 
    }
}