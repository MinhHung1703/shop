<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
    $brand = new brand();
    //Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $brandName = $_POST['brandName'];

        $insertBrand = $brand->insert_brand($brandName);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm thương hiệu</h2>
        <div class="block copyblock">
            <?php
                if(isset($insertBrand)) {
                    echo $insertBrand;
                }
            ?>
            <form action="brandadd.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Tên thương hiệu cần thêm ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Thêm" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php 
    include 'inc/footer.php'; 
?>