<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php
    $pd = new product();
    //Nếu trang gửi dững liệu bằng phương thức POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))   //Có cài submit để tăng tính bảo an toàn hơn thôi
    {
        $insertProduct = $pd->insert_product($_POST, $_FILES);
        //Khi ta gửi có ảnh dữ liệu sẽ lưu ở $_POST còn ảnh thì lưu ở $_FILES
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm mới</h2>
        <div class="block">

            <?php
                if(isset($insertProduct)){
                    echo $insertProduct;
                }
            ?>

            <form action="productadd.php" method="post" enctype="multipart/form-data"> <!-- Nếu form có hình ảnh phải có thuộc tính enctype này -> Từ đó dẫn đến việc ảnh lưu ở $_FILES -->
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Danh mục</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Danh mục<option>

                                <?php
                                    $cat = new category();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                ?>


                                <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                
                                <?php
                                        }
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Thương hiệu</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>Tên thương hiệu</option>

                                <?php
                                    $brand = new brand();
                                    $brandlist = $brand->show_brand();
                                    if($brandlist){
                                        while($result = $brandlist->fetch_assoc()){
                                ?>

                                <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>

                                <?php
                                        }
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Mô tả</label>
                        </td>
                        <td>
                            <textarea name="product_desc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá</label>
                        </td>
                        <td>
                            <input type="text" name="price" placeholder="Nhập giá..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Hình ảnh</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Chất lượng</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Lựa chọn</option>
                                <option value="1">Cao cấp</option>
                                <option value="0">Tầm trung</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>