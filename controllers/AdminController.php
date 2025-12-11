<?php
// controllers/AdminController.php

require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/Course.php';
require_once 'models/Enrollment.php';

class AdminController
{
    private $userModel;
    private $categoryModel;
    private $courseModel;
    private $enrollmentModel;

    public function __construct()
    {
        // 1. Kiểm tra đăng nhập & quyền Admin
        session_start();
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? 0) != 2) {
            header("Location: /login");
            exit;
        }

        // 2. KHỞI TẠO CÁC MODEL
        // Các Model đều đã tự kết nối DB (dựa trên các file bạn cung cấp)
        $this->userModel       = new User();
        $this->categoryModel   = new Category();
        $this->courseModel     = new Course();
        $this->enrollmentModel = new Enrollment(); 
    }

    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        // ✅ ĐÃ SỬA: Sử dụng hàm getAllUsers()->rowCount() có sẵn
        $totalUsers = $this->userModel->getAllUsers()->rowCount(); 
        
        $stats = [
            'total_users'       => $totalUsers,
            // ❌ CHÚ THÍCH/DỮ LIỆU GIẢ: Không thể đếm khóa học và đăng ký vì thiếu hàm countAll()
            'courses'           => "N/A (Thiếu hàm countAll trong Course)", 
            'enrollments'       => "N/A (Thiếu hàm countAll trong Enrollment)" 
        ];
        
        // Hoặc nếu bạn muốn bỏ qua lỗi và chỉ hiển thị phần người dùng:
        // $stats = ['total_users' => $totalUsers];

        include 'views/admin/dashboard.php';
    }

    /* ================= USER MANAGEMENT ================= */

    public function manageUsers()
    {
        // ✅ Dùng getAllUsers() có sẵn trong User.php
        $users = $this->userModel->getAllUsers()->fetchAll(PDO::FETCH_ASSOC); 
        include 'views/admin/users/manage.php';
    }
    
    public function toggleUserStatus($id)
    {
        // ✅ Dùng toggleUserStatus($id) có sẵn trong User.php
        $this->userModel->toggleUserStatus($id); 
        header("Location: /admin/users/manage");
        exit;
    }
    
    /* ================= CATEGORY MANAGEMENT ================= */
    
    // Các hàm này OK vì chúng đều tồn tại trong Category.php
    public function manageCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        include 'views/admin/categories/manage.php';
    }

    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'];

            $this->categoryModel->createCategory($name, $description);
            header("Location: /admin/categories");
            exit;
        }
        include 'views/admin/categories/create.php';
    }

    public function editCategory($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id          = $_POST['id'];
            $name        = $_POST['name'];
            $description = $_POST['description'];

            $this->categoryModel->updateCategory($id, $name, $description);
            header("Location: /admin/categories");
            exit;
        }

        $category = $this->categoryModel->getCategoryById($id);
        include 'views/admin/categories/edit.php';
    }

    public function deleteCategory($id)
    {
        $this->categoryModel->deleteCategory($id);
        header("Location: /admin/categories");
        exit;
    }

    /* ================= COURSE APPROVAL & STATISTICS ================= */
    
    // ❌ LOẠI BỎ: Các hàm này yêu cầu hàm không tồn tại trong Course.php (getPendingCourses, approve, reject)
    // public function pendingCourses() { /* ... */ }
    // public function approveCourse($id) { /* ... */ }
    // public function rejectCourse($id) { /* ... */ }


    public function statistics()
    {
        // ✅ Dùng các hàm có sẵn trong User.php
        $data = [
            // ❌ LOẠI BỎ: Hàm topEnrollCourses() không tồn tại trong Course.php
            'top_courses' => "N/A (Thiếu hàm topEnrollCourses trong Course)",
            
            // ✅ Dùng countByRole() có sẵn trong User.php
            'students'    => $this->userModel->countByRole(0), 
            'instructors' => $this->userModel->countByRole(1),
            'admins'      => $this->userModel->countByRole(2)
        ];
        
        include 'views/admin/reports/statistics.php';
    }
}