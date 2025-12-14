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

        // ===== Nhận input =====
        $firstName = trim($_POST["firstName"] ?? "");
        $lastName  = trim($_POST["lastName"] ?? "");
        $fullname  = $firstName . " " . $lastName;

        $username = trim($_POST["username"] ?? "");
        $email    = trim($_POST["email"] ?? "");

        $old = $_POST["oldPassword"] ?? "";
        $new = $_POST["newPassword"] ?? "";

        // ===== Validate backend =====
        if (!$firstName || !$lastName || !$username || !$email) {
            echo json_encode(["status" => "error", "message" => "Thiếu thông tin bắt buộc"]);
            exit;
        }

        // ===== Lấy user hiện tại =====
        $user = $this->userModel->getUserById($id);

        // ===== Kiểm tra mật khẩu =====
        if (!empty($new)) {
            if (empty($old)) {
                echo json_encode(["status" => "error", "message" => "Vui lòng nhập mật khẩu cũ"]);
                exit;
            }

            if ($old !== $user["password"]) {
                echo json_encode(["status" => "error", "message" => "Mật khẩu cũ không đúng!"]);
                exit;
            }

            $this->userModel->changePassword($id, $new);
        }

        // ===== Update =====
        $data = [
            "fullname" => $fullname,
            "username" => $username,
            "email"    => $email
        ];

        $updated = $this->userModel->updateUser($id, $data);

        echo json_encode([
            "status" => $updated ? "success" : "error",
            "message" => $updated ? "Cập nhật thành công" : "Cập nhật thất bại"
        ]);
        exit;
    }
}
