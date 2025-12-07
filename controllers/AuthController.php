<?php
class AuthController{
  public function login(){
    require "views/student/dashboard.php";
  }

  public function register(){
    require "./views/auth/register.php";
  }
}