<?php

require_once 'models/User.php';
// require_once 'models/Category.php';
// require_once 'models/Course.php';
// require_once 'models/Enrollment.php';

class AuthController
{
  public $userModel;
  public function __construct()
  {
    $this->userModel = new User();
  }

  public function showlogin()
  {
    include "./views/auth/login.php";
  }

  public function login()
  {
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (!$email || !$password) {
      echo json_encode([
        'success' => false,
        'message' => 'ko email'
      ]);
      exit;
    }

    // kiểm tra login với model
    $user = $this->userModel->login($email, $password);
    if ($user) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['username'];
      $_SESSION['role'] = $user['role'];

      switch ((int)$_SESSION['role']) {
        case 0:
          $view = 'views/student/dashboard.php';
          include 'views/layouts/student/student_layout.php';
          break;
        case 1:
          $view = 'views/instructor/dashboard.php';
          include 'views/layouts/instructor/instructor_layout.php';
          break;
        case 2:
          $view = 'views/admin/dashboard.php';
          include 'views/layouts/admin/admin_layout.php';
          break;
        default:
          include "./views/auth/login.php";
          echo "Role không hợp lệ!";
          break;
      }

      exit;
    }
  }

  public function showregister()
  {
    include "./views/auth/register.php";
  }
}
