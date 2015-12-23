<div class="wrap banner">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <?php if(!empty($arrBannerList)) { ?>
                <?php foreach ($arrBannerList as $key => $value) { ?>
                    <a href="#"><img src="{!!Asset('public/images/upload/banner/'.$value['banner_image_path'])!!}" width="1024px" height="289px"></a>
               <?php } ?>
           <?php } ?>
        </div>
    </div>
</div>