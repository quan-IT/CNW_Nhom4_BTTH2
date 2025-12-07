<?php

require_once 'models/Enrollment.php';

require_once "config/database.php";
$db = new Database();

class EnrollmentController
{
    public $EnrollmentModel;

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->EnrollmentModel = new Enrollment($this->db);
    }

    // Đăng ký khóa học
    public function register($user_id, $course_id)
    {
        if ($this->EnrollmentModel->isRegistered($user_id, $course_id)) {
            return "Bạn đã đăng ký khóa học này!";
        }

        $success = $this->EnrollmentModel->register($user_id, $course_id);
        return $success ? "Đăng ký thành công!" : "Đăng ký thất bại!";
    }
}
