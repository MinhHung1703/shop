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

	// //Nếu trang gửi dững liệu bằng phương thức POST
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    // {
	// 	$quantity = $_POST['quantity'];
    //     $AddtoCart = $ct->add_to_cart($quantity, $id);
    // }
?>

<style>
    h3.payment{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }
    .wrapper_method{
        text-align: center;
        width: 550px;
        margin: 0px auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }
    .wrapper_method a{
        padding: 10px;
        background: red;
        color: #fff;
    }
    .wrapper_method h3{
        margin-bottom: 20px;
    }
</style>

<div class="main">
	<div class="content">
		<div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Phương thức thanh toàn</h3>
                </div>
            </div>
            <div class="clear"></div>
            <div class="wrapper_method">
                <h3>Bạn hãy chọn phương thức thanh toán</h3>
                <a href="offlinepayment.php">Thanh toán khi nhận hàng</a>
                <a href="onlinepayment.php">Thanh toán trực tuyến</a><br><br><br>
                <a style="background: grey;" href="cart.php"><< Previous</a>
            </div>
		</div>
	</div>

<?php
	include "./inc/footer.php";
?>