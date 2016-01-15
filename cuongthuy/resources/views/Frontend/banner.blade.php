<div class="wrap banner">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <?php if(!empty($arrBannerList)) { ?>
                <?php foreach ($arrBannerList as $key => $value) { ?>
                    <a href="#"><img src="{!!Asset('public/images/upload/banner/'.$value['banner_image_path'])!!}"></a>
               <?php } ?>
           <?php } ?>
        </div>
    </div>
</div>