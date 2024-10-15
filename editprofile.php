<?php
	include "./inc/header.php";
	// include "./inc/slider.php";
?>

<?php
    //Kiểm tra đã đăng nhập chưa
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
?>

<?php
	// if (!isset($_GET['proid']) || $_GET['proid'] == null) {
	// 	echo "<script>window.location = '404.php'</script>";
	// } else {
	// 	$id = $_GET['proid'];
	// }

    $id = Session::get('customer_id'); 
	//Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    {
		$UpdateCustomers = $cs->update_customer($_POST, $id);
    }
?>

<div class="main">
	<div class="content">
		<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Chỉnh sửa thông tin khách hàng</h3>
                </div>
                <div class="clear"></div>
            </div>

            <form action="" method="post">
                <table class="tblone">
                    <tr>
                            <?php
                                if(isset($UpdateCustomers)){
                                    echo '<td colspan="3">' . $UpdateCustomers . '</td>';
                                }
                            ?>
                    </tr>

                    <?php
                        $id = Session::get('customer_id'); 
                        $get_customers = $cs->show_customers($id);
                        if($get_customers){
                            while($result = $get_customers->fetch_assoc()){
                    ?>
                    <tr>
                        <td>Tên</td>
                        <td>:</td>
                        <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                    </tr>
                    <!-- <tr>
                        <td>Quốc gia</td>
                        <td>:</td>
                        <td><input type="text" name="country" value="<?php echo $result['country'] ?>"></td>
                    </tr> -->
                    <!-- <tr>
                        <td>Thành phố</td>
                        <td>:</td>
                        <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                    </tr> -->
                    <tr>
                        <td>Số điện thoại</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Mã vùng</td>
                        <td>:</td>
                        <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" name="save" value="Lưu thông tin"></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>

                </table>
            </form>
		</div>
	</div>

<?php
	include "./inc/footer.php";
?>