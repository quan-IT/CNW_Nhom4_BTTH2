<?php
class AuthController{
  public function login(){
    require "./views/layout/sidebar.php";
  }

  public function register(){
    require "./views/auth/register.php";
  }
}