</div>
<div class="footer">
    <div class="wrapper">
        <div class="section group">
            <div class="col_1_of_4 span_1_of_4">
                <h4>Thông tin</h4>
                <ul>
                    <li><a href="#">Thông tin về chúng tôi</a></li>
                    <li><a href="#">Dịch vụ khách hàng</a></li>
                    <li><a href="#"><span>Tìm kiếm nâng cao</span></a></li>
                    <li><a href="#">Đơn hàng</a></li>
                    <li><a href="#"><span>Liên hệ với chúng tôi</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Tại sao nên mua từ chúng tôi</h4>
                <ul>
                    <li><a href="about.php">Thông tin về chúng tôi</a></li>
                    <li><a href="faq.php">Dịch vụ khách hàng</a></li>
                    <li><a href="#">Chính sách quyền riêng tư</a></li>
                    <li><a href="contact.php"><span>Sơ đồ trang web</span></a></li>
                    <li><a href="details.php"><span>Cụm từ tìm kiếm</span></a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Tài khoản của tôi</h4>
                <ul>
                    <li><a href="contact.php">Đăng nhập</a></li>
                    <li><a href="index.php">Xem giỏ hàng</a></li>
                    <li><a href="#">Danh sách mong muốn của tôi</a></li>
                    <li><a href="#">Theo dõi đơn hàng của tôi</a></li>
                    <li><a href="faq.php">Trợ giúp</a></li>
                </ul>
            </div>
            <div class="col_1_of_4 span_1_of_4">
                <h4>Liên hệ</h4>
                <ul>
                    <li><span>+88-0123456789</span></li>
                    <li><span>+88-0987654321</span></li>
                </ul>
                <div class="social-icons">
                    <h4>Theo dõi tôi</h4>
                    <ul>
                        <li class="facebook"><a href="#" target="_blank"> </a></li>
                        <li class="twitter"><a href="#" target="_blank"> </a></li>
                        <li class="googleplus"><a href="#" target="_blank"> </a></li>
                        <li class="contact"><a href="#" target="_blank"> </a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div class="copy_right">
            <p>Training with live project &amp; All rights Reseverd </p>
        </div> -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        /*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(function() {
        SyntaxHighlighter.all();
    });
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>
</body>

</html>