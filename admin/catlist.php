<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/category.php' ?>
<?php
    $cat = new category();

	if(isset($_GET['delid']))	//Không có else quay lại trang vì truy từ admin -> admin/catlist.php thì chạy if trước lúc này không có GET nên nó vòng lặp quay lại trang liên tục vô tận luôn
	{
		$id = $_GET['delid'];

		$delCat = $cat->delete_category($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục</h2>
                <div class="block"> 
					<?php
						if(isset($delCat)) {
							echo $delCat;
						}
					?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th>Hoạt động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show_cate = $cat->show_category();
							if($show_cate){
								$i = 0;
								while($result = $show_cate->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Sửa</a> || 
								<a onclick="return confirm('Bạn có chắc sẽ xoá không?')" href="?delid=<?php echo $result['catId'] ?>">Xoá</a></td>
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

