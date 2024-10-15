<!-- Quản lý người dùng (Đăng ký đăng nhập đặt hàng) -->
<?php
    $filepath = realpath(dirname(__FILE__));

    include_once $filepath . '/../lib/database.php';
    include_once $filepath . '/../helpers/format.php';
    //Cái này về sau có trang include nhiều trang mỗi trang lại include 1 lần database.php sẽ lỗi
    //Cái này sẽ nhận biết nếu có thì không gán lại nữa
?>

<?php
    class user
    {
        private $db;
        private $fm;

        public function __construct()
        {
            //Khởi tạo object từ class Database
            $this->db = new Database();
            $this->fm = new Format();
        }

    }
?>