<?php
class TestController
{

    public function dashboard()
    {
        $view = 'views/admin/dashboard.php';
        include 'views/layouts/admin/admin_layout.php';
    }
    public function manage()
    {
        $view = 'views/admin/users/manage.php';
        include 'views/layouts/admin/admin_layout.php';
    }
    public function categories()
    {
        $view = 'views/admin/categories/list.php';
        include 'views/layouts/admin/admin_layout.php';
    }
    public function categoriesEdit($id)
    {
        $view = 'views/admin/categories/list.php';
        include 'views/layouts/admin/admin_layout.php';
    }

    public function pending()
    {
        $view = 'views/admin/courses/pending.php';
        include 'views/layouts/admin/admin_layout.php';
    }

    public function instructor()
    {
        $view = 'views/instructor/dashboard.php';
        include 'views/layouts/instructor/instructor_layout.php';
    }

    public function lesson()
    {
        include 'views/student/detail_mycourses.php';
    }

    public function intructorcoursemanage()
    {
        $view = 'views/instructor/course/manage.php';
        include 'views/layouts/instructor/instructor_layout.php';
    }
    public function intructorlessonmanage()
    {
        $view = 'views/instructor/lessons/manage.php';
        include 'views/layouts/instructor/instructor_layout.php';
    }
    public function intructormaterialsmanage()
    {
        $view = 'views/instructor/materials/upload.php';
        include 'views/layouts/instructor/instructor_layout.php';
    }
}
