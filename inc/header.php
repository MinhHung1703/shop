<?php
    include 'lib/session.php';
    Session::init();        //Nếu chưa có Session mới khởi tạo nha (Đọc lại sẽ hiểu) -> Nhưng đây chỉ tạo chứ kp là đăng nhập rồi nha
    //Nó sẽ khác một chút so với trang admin đó đọc và ngẫm thử coi
?>

<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';

    //Đây là cách để ta k cần include nhiều cái mà không phải viết lại nhiều lần
    spl_autoload_register(function($className){
        include_once "classes/" . $className . ".php";
    });

    $db = new Database();
    $fm = new Format();

    $ct = new cart();
    $us = new user();
    $cat = new category();
    $product = new product();
    $cs = new customer();
?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form>
                        <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Giỏ hàng</span>
                            <span class="no_product">
                                <?php
                                    $check_cart = $ct->check_cart();
                                    if($check_cart){
                                        $sum = session::get("sum");
                                        $qty = session::get("qty");
                                        echo $sum . ' đ' . ' - ' . 'Sản phẩm: ' . $qty;
                                    } else{
                                        echo 'Rỗng';
                                    }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>

                <?php
                    if(isset($_GET[''])){
                        $delCart = $ct->del_all_data_cart();
                        Session::destroy();
                    }
                ?>

                <div class="login">

                    <?php
                        //Kiểm tra đã đăng nhập chưa
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
                            echo '<a href="login.php">Đăng nhập</a>';
                        } else {
                            echo '<a href="?customerid=' . Session::get('customer_id') . '">Đăng xuất</a>';
                        }
                    ?>

                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a> </li>
                <li><a href="topbrands.php">Top thương hiệu</a></li>

                <?php
                    $check_cart = $ct->check_cart();
                    if($check_cart == true){
                        echo '<li><a href="cart.php">Cart</a></li>';
                    } else{
                        echo '';
                    }
                ?>

                <?php
                    $customer_id = Session::get('customer_id');
                    $check_order = $ct->check_order($customer_id);
                    if($check_order == true){
                        echo '<li><a href="orderdetails.php">Ordered</a></li>';
                    } else{
                        echo '';
                    }
                ?>

                <?php
                     //Kiểm tra đã đăng nhập chưa
                     $login_check = Session::get('customer_login');
                     if($login_check == true){
                         echo '<li><a href="profile.php">Profile</a> </li>';
                     } else{
                        echo '';
                     }
                ?>

                <li><a href="contact.php">Liên hệ</a> </li>
                <div class="clear"></div>
            </ul>
        </div>