<?php
class HomeController {
    public function index() {
        include "./views/home/index.php";
    }

    public function courses(){
        include "views/home/courses.php";
    }
}
    
