<div class="nav_top">
    <div class="wrap">
        <nav class="f_left">
            <ul class="ul1">
                <li><a href="{!!action('Frontend\ProductController@getIndex')!!}">Sản phẩm mới</a></li>
                <?php foreach ($arrParentList as $parentId => $parentValue){?>
                <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $parentValue['id']))!!}"><?php echo $parentValue['category_name']; ?></a>
                    <?php if($arrChirdList[$parentId]){?>
                       <ul class="ul2">
                            <?php foreach ($arrChirdList[$parentId] as $childId => $childValue){?>
                                <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $childValue['id']))!!}"><?php echo $childValue['category_name'];?></a>
                                <?php if($arrChirdList[$childId]){?>
                                    <ul class="ul3">
                                        <?php foreach ($arrChirdList[$childId] as $key => $value){?>
                                            <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $value['id']))!!}"><?php echo $value['category_name'];?></a></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <div class="f_right">
            HOTLINE : 0988 123 123
        </div>
        <div class="clear"></div>
    </div>
</div>