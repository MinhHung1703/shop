<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php include_once '../helpers/format.php'?>	
<!-- Có thể bỏ cái này hoặc dùng include_once vì trong các class khác đã gán format rồi xong ta gán class vào đây
	Thì có nghĩa cơ bản nó đã có format trong này rồi nhưng nếu muốn ghi lại cho tường minh hơn thì dùng include_once -->
<?php
	$pd = new product();
	$fm = new Format();

	if(isset($_GET['productId']))	//Không có else quay lại trang vì truy từ admin -> admin/catlist.php thì chạy if trước lúc này không có GET nên nó vòng lặp quay lại trang liên tục vô tận luôn
	{
		$id = $_GET['productId'];

		$delpro = $pd->delete_product($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block"> 
			<?php
				if(isset($delpro)) {
					echo $delpro;
				}
			?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Ảnh sản phẩm</th>
					<th>Mô tả</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Kiểu</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pdlist = $pd->show_product();
					if($pdlist){
						$i = 0;
						while($result = $pdlist->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result["image"] ?>" width="100"></td>
					<td><?php echo $fm->textShorten($result['product_desc'], 30); ?></td>
					<td><?php echo $result['catName'] ?></td> <!-- Vì câu lệnh SQL lấy toàn bộ dữ liệu bảng product nhưng đồng thời lấy thêm 2 cột catName từ bảng category và brandName từ bảng brand hãy xem lại SQL để hiểu rõ hơn -->
					<td><?php echo $result['brandName'] ?></td>
					<td><?php 
						if($result['type'] == 0){
							echo 'Tầm trung';
						} else{
							echo 'Cao cấp';
						}
					?></td>
					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a href="?productId=<?php echo $result['productId'] ?>">Delete</a></td>
				</tr>
				 <?php
				 		}
				 	}
				 ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
