<?php
    $filepath = realpath(dirname(__FILE__));        //Cái này để chuyển đường dẫn tương đối thành tuyệt đối - Hãy tự tìm hiểu nó nha

    include_once $filepath . '/../lib/database.php';
    include_once $filepath . '/../helpers/format.php';
    //Cái này về sau có trang include nhiều trang mỗi trang lại include 1 lần database.php sẽ lỗi
    //Cái này sẽ nhận biết nếu có thì không gán lại nữa
?>

<?php
    class product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            //Khởi tạo object từ class Database
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data, $files)
        {
            //Lấy dữ liệu data
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            //Kiểm tra hình ảnh và tạo đường dẫn cho hình ảnh trong folder uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];          //Tên ảnh (VD: aa.PNG)
            $file_size = $_FILES['image']['size'];          //Kích cỡ
            $file_temp = $_FILES['image']['tmp_name'];      //Đường dẫn tạm (Nó sẽ tạm thời lấy bản sao lưu ở xampp -> VD: C:\xampp\tmp\php1050.tmp)
            $div = explode('.', $file_name);                //Tách chuỗi (VD [aa, PNG])
            $file_ext = strtolower(end($div));              //Quy đổi phần tử mảng cuối thành chữ phường -> png          
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   //Tạo phần đuôi độc đáo giúp mã hoá ảnh tránh bị trùng tên -> VD: 9b4eab8473.png (Tự đọc thử xem nha)
            $uploaded_image = "uploads/" . $unique_image;       //Tạo tệp chỉ định để ảnh có thể lưu vào đây    

            if ($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '' || $file_name == '') 
            {
                $alert = "<span class='error'>Không được để trống các trường này</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);    //Chuyển file từ đường dẫn tạo đến tệp chỉ định
                $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, image) VALUES('$productName', '$category', '$brand', '$product_desc', '$type', '$price', '$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_product() {

            //Cách 1: lấy dữ liệu cả dữ liệu bảng product và tên của category và brand tương ứng -> Nên dùng nhưng cái này nhìn chuyên hơn
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
                      FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
                      INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
                      ORDER BY tbl_product.productId DESC";

            // //Cách 2: Na ná cách 1 thôi nhưng viết bằng cách thu gọn tên bảng và dùng WHERE
            // $query = "SELECT p.*, c.catName, b.brandName 
            //           FROM tbl_product as p, tbl_category as c, tbl_brand as b
            //           WHERE p.catId = c.catId AND p.brandId = b.brandId
            //           ORDER BY p.productId DESC";

            // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";

            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data, $files, $id){
            
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            //Kiểm tra hình ảnh và tạo đường dẫn cho hình ảnh trong folder uploads
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];          //Tên ảnh (VD: aa.PNG)
            $file_size = $_FILES['image']['size'];          //Kích cỡ
            $file_temp = $_FILES['image']['tmp_name'];      //Đường dẫn tạm (Nó sẽ tạm thời lấy bản sao lưu ở xampp -> VD: C:\xampp\tmp\php1050.tmp)
            $div = explode('.', $file_name);                //Tách chuỗi (VD [aa, PNG])
            $file_ext = strtolower(end($div));              //Quy đổi phần tử mảng cuối thành chữ phường -> png          
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;   //Tạo phần đuôi độc đáo giúp mã hoá ảnh tránh bị trùng tên -> VD: 9b4eab8473.png (Tự đọc thử xem nha)
            $uploaded_image = "uploads/" . $unique_image;       //Tạo tệp chỉ định để ảnh có thể lưu vào đây    

            if ($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '') 
            {
                $alert = "<span class='error'>Không được để trống các trường này</span>";
                return $alert;
            } else{
                if(!empty($file_name))  //Nếu ta chọn ảnh mới -> $file_name có giá trị => true (Đọc lại xem như nào là true như nào là false nha)
                {
                    //Nếu ta thay ảnh mới thì dùng cái này xoá ảnh cũ đi đỡ bị đầy bộ nhớ nha
                    $image_cu = product::getproductbyId($id);
                    if(isset($image_cu)){
                        $image_cu = $image_cu->fetch_assoc();
                        $link_image_cu = "uploads/" . $image_cu['image'];
                        unlink($link_image_cu);
                    }
                    
                    //Kiểm tra tên miền của ảnh vào kích thước của ảnh
                    if($file_size > 10000000000){   //Nên để 2048 = 2MB thôi là nặng rồi
                        $alert = "<span class='error'>Kích thước hình ảnh phải nhỏ hơn 2MB</span>";
                        return $alert;
                    }
                    else if (in_array($file_ext, $permited) === false) {
                        $alert = "<span class='error'>Bạn chỉ được up ảnh: " . implode(', ', $permited) . "</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);    //Chuyển file từ đường dẫn tạo đến tệp chỉ định
                    
                    $query = "UPDATE tbl_product SET
                              productName='$productName', 
                              brandId='$brand',
                              catId='$category',
                              type='$type',
                              price='$price',
                              image='$unique_image',
                              product_desc='$product_desc'
                              WHERE productId = '$id'";
                    
                } 
                else        //Nếu ta không chọn ảnh mới -> Nhận ảnh cũ -> $file_name k có giá trị => false (Đọc lại xem như nào là true như nào là false nha)
                    {
                        $query = "UPDATE tbl_product SET
                              productName='$productName', 
                              brandId='$brand',
                              catId='$category',
                              type='$type',
                              price='$price',
                              product_desc='$product_desc'
                              WHERE productId = '$id'";
                    }
            }
            
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
                return $alert;
            } else{
                $alert = "<span class='error'>Sửa sản phẩm không thành công</span>";
                return $alert;
            }

        }

        public function delete_product($id){
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá sản phẩm thành công</span>";
                return $alert;
            } else{
                $alert = "<span class='error'>Xoá sản phẩm không thành công</span>";
                return $alert;
            }
        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
//-----------------END BACKEND-------------------------------------------------------------------------------------


        public function getproduct_feathered(){
            $query = "SELECT * FROM tbl_product WHERE type = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 4";
            //lấy ra toàn bộ dữ liệu bảng sắp xếp giảm dần -> Từ đó lấy ra 4 thằng đầu tiên
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id){
            
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
                      FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
                      INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
                      WHERE tbl_product.productId = '$id'";

            $result = $this->db->select($query);
            return $result;
        }

        //Lấy ra SP mới nhất của từng hãng
        public function getLastesDell(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesApple(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesAsus(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesHP(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '9' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesHuawei(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastesSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>