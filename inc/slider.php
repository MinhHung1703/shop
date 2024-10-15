<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">

        <?php
            $getLastesDell = $product->getLastesDell();
            if($getLastesDell){
                while($resultdell = $getLastesDell->fetch_assoc()){
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultdell['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>DELL</h2>
                    <p><?php echo $resultdell['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Thêm giỏ hàng</a></span></div>
                </div>
            </div>
        <?php
                }
            }
        ?>
        
        <?php
            $getLastesSamsung = $product->getLastesSamsung();
            if($getLastesSamsung){
                while($resultsamsung = $getLastesSamsung->fetch_assoc()){
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultsamsung['image']; ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>SAMSUNG</h2>
                    <p><?php echo $resultsamsung['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultsamsung['productId'] ?>">Thêm giỏ hàng</a></span></div>
                </div>
            </div>
        <?php
                }
            }
        ?>

        </div>
        <div class="section group">

            <?php
                $getLastesApple = $product->getLastesApple();
                if($getLastesApple){
                    while($resultapple = $getLastesApple->fetch_assoc()){
            ?>
                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                        <a href="details.php"> <img src="admin/uploads/<?php echo $resultapple['image']; ?>" alt="" /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2>APPLE</h2>
                        <p><?php echo $resultapple['productName'] ?></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $resultapple['productId'] ?>">Thêm giỏ hàng</a></span></div>
                    </div>
                </div>
            <?php
                    }
                }
            ?>

            <?php
                $getLastesHuawei = $product->getLastesHuawei();
                if($getLastesHuawei){
                    while($resulthuawei = $getLastesHuawei->fetch_assoc()){
            ?>
                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                        <a href="details.php"> <img src="admin/uploads/<?php echo $resulthuawei['image']; ?>" alt="" /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2>HUAWEI</h2>
                        <p><?php echo $resulthuawei['productName'] ?></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $resulthuawei['productId'] ?>">Thêm giỏ hàng</a></span></div>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                    <li><img src="images/4.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>