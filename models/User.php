<?php
// models/User.php

// ✅ Đã xác nhận: File Database.php của bạn là hợp lệ
require_once 'config/Database.php';

class User
{
    private $db;
    private $table_name = "users";

    public function __construct()
    {
        // Khởi tạo Database (Code này đã được xác nhận là đúng cú pháp)
        $database = new Database(); 
        $this->db = $database->getConnection();
    }

    /* ======================================= */
    /* ======== CHỨC NĂNG XÁC THỰC (AUTH) ======== */
    /* ======================================= */

    /**
     * Đăng ký tài khoản (Mặc định: is_active = 1)
     */
    public function register($username, $email, $password, $fullname, $role = 0)
    {
        $sql = "INSERT INTO {$this->table_name}
                (username, email, password, fullname, role, is_active, created_at)
                VALUES (:username, :email, :password, :fullname, :role, 1, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Đăng nhập (username hoặc email)
     */
    public function login($username, $password)
    {
        // Kiểm tra is_active = 1 (chỉ cho phép đăng nhập nếu tài khoản đang hoạt động)
        $sql = "SELECT * FROM {$this->table_name}
                WHERE (username = :username OR email = :username) AND is_active = 1
                LIMIT 1"; 

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Kiểm tra tồn tại username hoặc email
     */
    public function checkExists($username, $email)
    {
        $sql = "SELECT id FROM {$this->table_name}
                WHERE username = :username OR email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /* ======================================= */
    /* ======== CHỨC NĂNG QUẢN TRỊ (ADMIN) ======== */
    /* ======================================= */

    /**
     * Lấy user theo ID (Dùng cho AdminController::editUser)
     */
    public function getUserById($id)
    {
        $sql = "SELECT id, username, email, fullname, role, is_active, created_at
                FROM {$this->table_name}
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tất cả user (Dùng cho AdminController::manageUsers)
     */
    public function getAllUsers()
    {
        $sql = "SELECT id, username, email, fullname, role, is_active, created_at
                FROM {$this->table_name}
                ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
    
    /**
     * Thay đổi trạng thái kích hoạt (active/inactive) (Dùng cho AdminController::toggleUserStatus)
     */
    public function toggleUserStatus($id)
    {
        $sql = "UPDATE {$this->table_name} SET is_active = 1 - is_active WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Đếm số người dùng theo vai trò (Dùng cho AdminController::statistics)
     */
    public function countByRole($role)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table_name} WHERE role = :role";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Cập nhật thông tin user (fullname, email)
     * ✅ ĐỒNG BỘ: Hàm này nhận 3 tham số để khớp với AdminController.php
     */
    public function updateUser($id, $fullname, $email)
    {
        $sql = "UPDATE {$this->table_name}
                SET fullname = :fullname, email = :email
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Đổi mật khẩu (changePassword)
     * ✅ ĐỒNG BỘ: AdminController sử dụng tên hàm này
     */
    public function changePassword($id, $newPassword)
    {
        $sql = "UPDATE {$this->table_name}
                SET password = :password
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Cập nhật quyền (ADMIN)
     */
    public function updateRole($id, $role)
    {
        $sql = "UPDATE {$this->table_name}
                SET role = :role
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xóa user
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM {$this->table_name}
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}