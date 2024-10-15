<?php
	include "./inc/header.php";
	// include "./inc/slider.php";
?>

<?php
	//Kiểm tra đã đăng nhập chưa
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:order.php');
	}
?>

<?php
    //Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    {
        $insertCustomers = $cs->insert_customers($_POST);
    }
?>

<?php
    //Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    {
        $login_Customers = $cs->login_customers($_POST);
    }
?>


<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Đăng nhập tài khoản</h3>
			<p>Đăng nhập để có một trải nhiệm tốt nhất.</p>
			<?php
				if(isset($login_Customers)){
					echo $login_Customers;
				}
			?>
			<form action="" method="POST">
				<input type="text" name="email" class="field" placeholder="Email">
				<input type="password" name="password" class="field" placeholder="Password">
				<p class="note">Quên mật khẩu thì click ở <a href="#">đây</a></p>
				<div class="buttons">
					<div><input type="submit" class="grey" name="login" value="Đăng nhập"></div>				
				</div>
			</form>
		</div>
		<?php
			
		?>
		<div class="register_account">
			<h3>Tạo tài khoản mới</h3>
			<?php
				if(isset($insertCustomers)){
					echo $insertCustomers;
				}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>

								<div>
									<input type="text" name="city" placeholder="Thành phố">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Mã vùng">
								</div>
								<div>
									<input type="text" name="email" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Địa chỉ">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>

										<option value="vn">VietNam</option>
										<option value="my">USA</option>
										<option value="nga">Nga</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Số điện thoại">
								</div>

								<div>
									<input type="text" name="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div>
				</div>
				<p class="terms">Bạn đồng ý với những <a href="#">Điều khoản &amp; Điều kiện</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	include "./inc/footer.php";
?>