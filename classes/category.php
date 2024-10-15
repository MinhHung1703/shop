<?php
    $filepath = realpath(dirname(__FILE__));

    include_once $filepath . '/../lib/database.php';
    include_once $filepath . '/../helpers/format.php';
    //Cái này về sau có trang include nhiều trang mỗi trang lại include 1 lần database.php sẽ lỗi
    //Cái này sẽ nhận biết nếu có thì không gán lại nữa
?>

<?php
    class category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            //Khởi tạo object từ class Database
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_category($catName)
        {
            $catName = $this->fm->validation($catName);

            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if (empty($catName)) {
                $alert = "<span class='error'>Không được để trống phần này</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm danh mục thành công</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Thêm danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_category() {
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
                $result = $this->db->select($query);
                return $result;
        }

        public function update_category($catName, $id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id      = mysqli_real_escape_string($this->db->link, $id);

            if (empty($catName)) {
                $alert = "<span class='error'>Không được để trống phần này</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_category SET catName='$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa danh mục thành công</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Sửa danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function delete_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá danh mục thành công</span>";
                return $alert;
            } else{
                $alert = "<span class='error'>Xoá danh mục không thành công</span>";
                return $alert;
            }
        }

        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_category_fontend() {
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY catId DESC LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        //Cái này code theo nên thấy nó loằng ngoằng -> Ta có thể lấy tên trực tiếp từ bảng category thông qua id tương ứng luôn
        // SELECT * FROM tbl_category WHERE catId = '$id'
        public function get_name_by_cat($id){
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
    }
?>























