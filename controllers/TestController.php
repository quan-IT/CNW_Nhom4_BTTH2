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
    public function categoriesEdit($id){
        $view = 'views/admin/categories/list.php';
        include 'views/layouts/admin/admin_layout.php';
    }

    public function pending(){
        $view = 'views/admin/courses/pending.php';
        include 'views/layouts/admin/admin_layout.php';
    }

    public function instructor(){
        include 'views/layouts/instructor/instructor_layout.php';
    }

}
