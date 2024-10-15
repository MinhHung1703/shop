<?php
	include "./inc/header.php";
?>

<?php
	if(isset($_GET['cartid']))	//Không có else quay lại trang vì truy từ admin -> admin/catlist.php thì chạy if trước lúc này không có GET nên nó vòng lặp quay lại trang liên tục vô tận luôn
	{
		$id = $_GET['cartid'];

		$delcart = $ct->del_product_cart($id);
	}
	// print_r($_SESSION);
	// echo session_id();


	//Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    {
		$quantity = $_POST['quantity'];
        $cartId = $_POST['cartId'];
		$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);

		//Nếu chọn số lượng <= 0 thì
		if($quantity<=0){
			$delcart = $ct->del_product_cart($cartId);
		}
    }
?>

<?php
	if(!isset($_GET['id'])){
		echo '<meta http-equiv="refresh" content="0;URL=?id=live">';	//Lệnh chuyển hướng trang -> Mục đích cập nhập Qty khi mới thêm sản phẩm thôi
	}
?>


<div class="main">
	<div class="content">
		<div class="cartoption">
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
						<th width="20%">Tên sản phẩm</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Giá</th>
						<th width="25%">Số lượng</th>
						<th width="20%">Tổng giá</th>
						<th width="10%">Xoá sản phẩm</th>
					</tr>

					<?php
						$get_product_cart = $ct->get_product_cart();
						if($get_product_cart){
							$subtotal = 0;
							$qty = 0;
							while($result = $get_product_cart->fetch_assoc()){
					?>
					<tr>
						<td><?php echo $result['productName']; ?></td>
						<td><img src="admin/uploads/<?php echo $result['image']; ?>" alt="" /></td>
						<td><?php echo $result['price']; ?></td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
								<input type="number" name="quantity" min="0" value="<?php echo $result['quantity']; ?>" />
								<input type="submit" name="submit" value="Update" />
							</form>
						</td>
						<td><?php echo $result['quantity'] * $result['price']; ?></td>
						<td><a onclick="return confirm('Bạn có chắc sẽ xoá sản phẩm không?')" href="?cartid=<?php echo $result['cartId'] ?>">Xoá</a></td>
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
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Tổng tiền hàng : </th>
						<td>
							<?php
								echo $subtotal;

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
								echo $VAT = $subtotal*0.1;
							?>
						</td>
					</tr>
					<tr>
						<th>Tổng cộng :</th>
						<td> <?php echo $gtotal = $subtotal + $VAT ?> </td>
					</tr>
				</table>
				<?php
					} else {
						echo 'Giỏ hàng của bạn đang trống! Xin hãy thêm sản phẩm';
					}
				?>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	include "./inc/footer.php";
?>