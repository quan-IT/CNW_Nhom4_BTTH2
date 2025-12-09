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
        // 1. Sửa lỗi: Đảm bảo session được khởi tạo (Mặc dù bạn đã có session_start(), 
        // nhưng tốt nhất nên dùng cách này để đảm bảo)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // 2. Sửa lỗi: Kiểm tra quyền Admin và chuyển hướng
        // Trong file gốc của bạn là header("Location: /login"); -> Đã sửa thành /auth/login
        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? 0) != 2) {
            header("Location: /auth/login"); 
            exit;
        }

        $this->userModel       = new User();
        $this->categoryModel   = new Category();
        $this->courseModel     = new Course();
        $this->enrollmentModel = new Enrollment();
    }

    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        // $stats = [
        //     'users'       => $this->userModel->countAll(),
        //     'courses'     => $this->courseModel->countAll(), 
        //     'enrollments' => $this->enrollmentModel->countAll() 
        // ];
        //mình đã thay hiển thị view qua layout rồi nhé| admin_layout nhé thân!
        $view = 'views/admin/dashboard.php'
        include 'views/admin/dashboard.php';
    }

    /* ================= USER MANAGEMENT ================= */
    // ... (Các hàm khác không bị lỗi tên) ...
    public function manageUsers()
    {
        $users = $this->userModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/users/manage.php';
    }

    public function toggleUserStatus($id)
    {
        $this->userModel->toggleStatus($id);
        header("Location: /admin/users/manage"); 
        exit;
    }


    /* ================= CATEGORY MANAGEMENT ================= */

    public function listCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        include 'views/admin/categories/list.php';
    }

    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'];
            
            $this->categoryModel->createCategory($name, $description);
            header("Location: /admin/categories/list"); 
            exit;
        }

        include 'views/admin/categories/create.php';
    }

    public function editCategory($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'];
            
            // 🔥 SỬA LỖI 1: Gọi đúng hàm updateCategory() thay vì update()
            $this->categoryModel->updateCategory($id, $name, $description); 
            // Sửa lỗi: Chuyển hướng về /admin/categories/list thay vì /admin/categories
            header("Location: /admin/categories/list"); 
            exit;
        }

        // 🔥 SỬA LỖI 2: Gọi đúng hàm getCategoryById() thay vì getById()
        $category = $this->categoryModel->getCategoryById($id); 
        include 'views/admin/categories/edit.php';
    }

    public function deleteCategory($id)
    {
        // 🔥 SỬA LỖI 3: Gọi đúng hàm deleteCategory() thay vì delete()
        $this->categoryModel->deleteCategory($id);
        // Sửa lỗi: Chuyển hướng về /admin/categories/list thay vì /admin/categories
        header("Location: /admin/categories/list"); 
        exit;
    }

    /* ================= COURSE APPROVAL & STATISTICS ================= */
    
    public function pendingCourses()
    {
        $courses = $this->courseModel->getPendingCourses()->fetchAll(PDO::FETCH_ASSOC);
        include 'views/admin/reports/course_pending.php';
    }

    public function approveCourse($id)
    {
        $this->courseModel->approve($id); 
        header("Location: /admin/courses/pending");
        exit;
    }

    public function rejectCourse($id)
    {
        $this->courseModel->reject($id); 
        header("Location: /admin/courses/pending");
        exit;
    }

    public function statistics()
    {
        $data = [
            'top_courses' => $this->courseModel->topEnrollCourses(),
            'students'    => $this->userModel->countByRole(0),
            'instructors' => $this->userModel->countByRole(1)
        ];

        include 'views/admin/statistics.php';
    }
}