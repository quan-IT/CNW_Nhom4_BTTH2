<?php
class AuthController{
  public function login(){
    require "./views/layouts/sidebar.php";
  }

  public function register(){
    require "./views/auth/register.php";
  }
}