<div class="wrap banner">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <?php if(!empty($arrBannerList)) { ?>
                <?php foreach ($arrBannerList as $key => $value) { ?>
                    <a href="#"><img src="<?php echo $value['banner_url'];?>"></a>
               <?php } ?>
           <?php } ?>
        </div>
    </div>
</div>