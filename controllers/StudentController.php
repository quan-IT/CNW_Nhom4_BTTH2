<?php
    class StudentController {

        public function dashboard() {
            $view = 'views/student/dashboard.php';
            include 'views/layouts/student/student_layout.php';
        }

        public function mycourse() {
            $view = 'views\student\my_courses.php';
            include 'views/layouts/student/student_layout.php';
        }

        public function courseProgress() {
            $view = 'views/student/course_progress.php';
            include 'views/layouts/student/student_layout.php';
        }
    }
?>
