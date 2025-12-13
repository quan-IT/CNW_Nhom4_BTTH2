<?php
require_once 'models/User.php';
require_once 'models/Course.php';
require_once 'models/Enrollment.php';
class StudentController
{
    public $userModel;
    public $courseModel;
    public $enrollmentModel;
    public function __construct()
    {
        $this->enrollmentModel = new Enrollment();
        $this->userModel = new User();
        $this->courseModel = new Course();
    }

    public function dashboard($id)
    {
        $user = $this->userModel->getUserById($id);
        $view = 'views/student/dashboard.php';
        include 'views/layouts/student/student_layout.php';
    }

    public function mycourse($id)
    {
        $courses = $this->enrollmentModel->getCourseByUser($id);

        $view = 'views/student/my_courses.php';
        include 'views/layouts/student/student_layout.php';
    }

    public function profile()
    {
        //lay thong tin của
        $view = 'views/layouts/profile.php';
        include 'views/layouts/student/student_layout.php';
    }
    public function updateprofile()
    {
        header("Content-Type: application/json");

        $id = $_SESSION['user_id'] ?? null;
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "Không tìm thấy user"]);
            exit;
        }

        $first = $_POST["firstName"] ?? "";
        $last  = $_POST["lastName"] ?? "";

        $data = [
            "fullname" => trim($first . " " . $last),
            "username" => $_POST["username"] ?? "",
            "email"    => $_POST["email"] ?? "",
        ];

        $updated = $this->userModel->updateUser($id, $data);

        echo json_encode([
            "status" => $updated ? "success" : "error",
            "message" => $updated ? "OK" : "Cập nhật thất bại"
        ]);
        exit;
    }
}
