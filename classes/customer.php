<!-- Giỏ hàng -->
<?php
    $filepath = realpath(dirname(__FILE__));

    include_once $filepath . '/../lib/database.php';
    include_once $filepath . '/../helpers/format.php';
    //Cái này về sau có trang include nhiều trang mỗi trang lại include 1 lần database.php sẽ lỗi
    //Cái này sẽ nhận biết nếu có thì không gán lại nữa
?>

<?php
    class customer
    {
        private $db;
        private $fm;

        public function __construct()
        {
            //Khởi tạo object từ class Database
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customers($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if ($name == '' || $city == '' || $zipcode == '' || $email == '' || $address == '' || $country == '' || $phone == '' || $password == '') 
            {
                $alert = "<span class='error'>Không được để trống các trường này</span>";
                return $alert;
            } else {
                $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email này đã được đăng ký với một tài khoản khác</span>";
                    return $alert;
                } else {
                    $query = "INSERT INTO tbl_customer(name, city, zipcode, email, address, country, phone, password) VALUES('$name', '$city', '$zipcode', '$email', '$address', '$country', '$phone', '$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Tạo tài khoản thành công</span>";
                        return $alert;
                    } else{
                        $alert = "<span class='error'>Tạo tài khoản không thành công</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customers($data) {
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, ($data['password']));

            if ($email == '' || $password == '') 
            {
                $alert = "<span class='error'>Không được để trống các trường này</span>";
                return $alert;
            } else {
                $password = md5($password);     //Vì nếu md5 ở ngoài mà ta k nhập gì nó sẽ mã hoá chuỗi rỗng
                $check_login = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $value['id']);
                    Session::set('customer_name', $value['name']);
                    header('Location:order.php');
                } else {
                    $alert = "<span class='error'>Email hoặc mật khẩu đã sai rồi!</span>";
                    return $alert;
                }
            }
        }

        public function show_customers($id){
            $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_customer($data, $id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

            if ($name == '' || $zipcode == '' || $email == '' || $address == '' || $phone == '') 
            {
                $alert = "<span class='error'>Không được để trống các trường này</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_customer SET name = '$name', zipcode = '$zipcode', email = '$email', address = '$address', phone = '$phone' WHERE id = '$id'";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Sửa thông tin thành công</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Sửa thông tin không thành công</span>";
                    return $alert;
                }
            }
        }

    }
?>