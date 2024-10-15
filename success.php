<?php
	include "./inc/header.php";
	// include "./inc/slider.php";
?>

<?php
	if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
		$customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();    //Khi mà đặt hàng thì ta xoá toàn bộ giỏ hàng đi
        header('Location:success.php');
	}

	// //Nếu trang gửi dững liệu bằng phương thức POST
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    // {
	// 	$quantity = $_POST['quantity'];
    //     $AddtoCart = $ct->add_to_cart($quantity, $id);
    // }
?>

<style type="text/css">
    h2.success_order{
        text-align: center;
        color: red;
    }
    p.success_note{
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>

<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Đặt hàng thành công</h2>
                <?php
                    $customer_id = Session::get('customer_id');
                    $get_amont = $ct->getAmountPrice($customer_id);
                    if($get_amont){
                        $amount = 0;
                        while($result = $get_amont->fetch_assoc()){
                            $amount += $result['price'];
                        }
                        $vat = $amount * 0.1;
                    }
                ?>
                <p class="success_note">Tổng tiền bạn đã mua từ chúng tôi là: <?php echo $amount + $vat; ?> VNĐ</p>
                <p class="success_note">Chúng tôi sẽ liên lạc sớm nhất có thể. Làm ơn xem lại đơn hàng của bạn <a href="orderdetails.php">Ở đây</a></p>
            </div>
        </div>
    </div>
</form>


<?php
	include "./inc/footer.php";
?>