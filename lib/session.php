<?php

/**
 *Session Class
 **/
class Session
{
    // Khởi tạo session nếu phiên bản PHP < 5.4.0 không hỗ trợ session_status()
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    // Thiết lập giá trị cho session
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    // Lấy giá trị của session ứng với khóa $key
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    // Kiểm tra session để xác định người dùng đã đăng nhập chưa
    public static function checkSession()
    {
        // Khởi tạo session
        self::init();   //self gọi method mà không cần object

        // Nếu session 'login' không tồn tại hoặc có giá trị false
        if (self::get("adminlogin") == false) {

            // Hủy session và chuyển hướng người dùng đến trang đăng nhập
            self::destroy();
            header("Location:login.php");
        }
    }

    // Kiểm tra session để xác định người dùng đã đăng nhập hay chưa
    public static function checkLogin()
    {
        // Khởi tạo session
        self::init();

        // Nếu session 'login' đã tồn tại và có giá trị true
        if (self::get("adminlogin") == true) {
            header("Location:index.php");
        }
    }

    // Hủy session và chuyển hướng người dùng đến trang đăng nhập
    public static function destroy()
    {
        // Hủy toàn bộ session và chuyển hướng sang trang login.php
        session_destroy();
        header("Location:login.php");
    }
}
