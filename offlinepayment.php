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
    .box_left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 7px;
        margin-top: 10px;
    }
    .box_left h2{
        width: 100%;
    }
    .box_right{
        width: 45%;
        border: 1px solid #666;
        float: right;
        padding: 7px;
        margin-top: 10px;
    }
    .a_order{
        border: none;
        padding: 10px 50px;
        background: red;
        font-size: 25px;
        color: #fff;
        margin: 10px;
        cursor: pointer;
    }
</style>

<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h2>Thông tin đơn hàng</h2>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="box_left">
                    <div class="cartpage">
                        <h2>Giỏ hàng của bạn</h2>
                        <?php
                            if(isset($update_quantity_cart)){
                                echo $update_quantity_cart;
                            }
                        ?>
                        <?php
                            if(isset($delcart)){
                                echo $delcart;
                            }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Tên sản phẩm</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="15%">Giá</th>
                                <th width="25%">Số lượng</th>
                                <th width="20%">Tổng giá</th>
                            </tr>

                            <?php
                                $get_product_cart = $ct->get_product_cart();
                                if($get_product_cart){
                                    $subtotal = 0;
                                    $qty = 0;
                                    $i = 0;
                                    while($result = $get_product_cart->fetch_assoc()){
                                        $i++
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image']; ?>" alt="" /></td>
                                <td><?php echo $result['price'] . ' VNĐ'; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['quantity'] * $result['price'] . ' VNĐ'; ?></td>
                            </tr>
                            <?php
                                    $subtotal += ($result['quantity'] * $result['price']);
                                    $qty = $qty + $result['quantity'];
                                    }
                                }
                            ?>
                            
                        </table>

                        <?php
                        //check giỏ hàng có sản phẩm không?
                            $check_cart = $ct->check_cart();
                            if($check_cart){
                        ?>
                        <table style="float:right;text-align:left; margin: 5px;" width="40%">
                            <tr>
                                <th>Tiền hàng : </th>
                                <td>
                                    <?php
                                        echo $subtotal . ' VNĐ';

                                        //Lưu thông tin vào session
                                        Session::set('sum', $subtotal);
                                        Session::set('qty', $qty);

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT(10%) : </th>
                                <td>
                                    <?php
                                        $VAT = $subtotal*0.1;
                                        echo $VAT . ' VNĐ';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tổng cộng :</th>
                                <td> 
                                    <?php 
                                        $gtotal = $subtotal + $VAT;
                                        echo $gtotal . ' VNĐ'; 
                                    ?> 
                                </td>
                            </tr>
                        </table>
                        <?php
                            } else {
                                echo 'Giỏ hàng của bạn đang trống! Xin hãy thêm sản phẩm';
                            }
                        ?>

                    </div>
                </div>
                <div class="box_right">
                    <div class="cartpage">
                        <h2>Thông tin khách hàng</h2>
                        <table class="tblone">
                            <?php
                                $id = Session::get('customer_id'); 
                                $get_customers = $cs->show_customers($id);
                                if($get_customers){
                                    while($result = $get_customers->fetch_assoc()){
                            ?>
                            <tr>
                                <td>Tên</td>
                                <td>:</td>
                                <td><?php echo $result['name'] ?></td>
                            </tr>
                            <!-- <tr>
                                <td>Quốc gia</td>
                                <td>:</td>
                                <td><?php echo $result['country'] ?></td>
                            </tr> -->
                            <!-- <tr>
                                <td>Thành phố</td>
                                <td>:</td>
                                <td><?php echo $result['city'] ?></td>
                            </tr> -->
                            <tr>
                                <td>Số điện thoại</td>
                                <td>:</td>
                                <td><?php echo $result['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>Mã vùng</td>
                                <td>:</td>
                                <td><?php echo $result['zipcode'] ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>:</td>
                                <td><?php echo $result['address'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><a href="editprofile.php">Chỉnh sửa thông tin</a></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <center><a href="?orderid=order" class="a_order">Đặt hàng</a></center><br>
    </div>
</form>


<?php
	include "./inc/footer.php";
?>