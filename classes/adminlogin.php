<?php
    $filepath = realpath(dirname(__FILE__));

    include $filepath . '/../lib/session.php';
    Session::checkLogin();

    include $filepath . '/../lib/database.php';
    include $filepath . '/../helpers/format.php'
?>

<?php
    class adminlogin
    {
        private $db;
        private $fm;

        public function __construct()
        {
            //Khởi tạo object từ class Database
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function login_admin($adminUser, $adminPass)
        {
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if (empty($adminUser) || empty($adminPass)) {
                $alert = "Không được để trống các trường";
                return $alert;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);

                if ($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin', true);               //Đã tồn tại adminlogin này rồi
                    Session::set('adminId', $value['adminId']);     //Đồng thời lưu Id mà ta tài khoản đăng nhập để phân biệt tài khoản đăng nhập
                    Session::set('adminUser', $value['adminUser']); //Lưu luôn User và Pass để đảm bảo tránh sai sót
                    Session::set('adminName', $value['adminName']);
                    header('Location:index.php');
                } else {
                    $alert = 'User and Password not match';
                    return $alert;
                }
            }
        }
    }
?>























