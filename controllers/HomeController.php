<?php
class HomeController {
    private $current_user_role;
    public function __construct() {
        $this->current_user_role = 'instructor'; 
        
        
    }
    public function index() {
        include "./views/home/index.php";
    }

    public function courses(){
        include "views/home/courses.php";
    }
    public function instructorDashboard() {
        if ($this->current_user_role !== 'instructor') {
            // Nếu không phải Instructor, chuyển hướng về trang chủ
            header('Location: index.php');
            exit;
        }
        
        // CHUYỂN HƯỚNG MẶC ĐỊNH CHO INSTRUCTOR
        // Trang quản lý khóa học (CourseController->manage) là trang đầu tiên
        header('Location: index.php?url=course/manage');
        exit;
    }
}
    
