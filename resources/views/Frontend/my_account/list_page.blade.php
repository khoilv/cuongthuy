<?php if ($lastPage > 1) {
    if ($currentPage != 1) { ?>
        <li><a href="{!!action('Frontend\MyOrderController@getIndex', array('page' => 1))!!}"><<</a></li>
        <li><a href="{!!action('Frontend\MyOrderController@getIndex', array('page' => $previousPage))!!}"><</a></li>
    <?php } ?>
    <?php for ($page = $begin; $page <= $end; $page++) { ?>
        <?php if ($page == $currentPage) { ?>
            <li><?php echo $page; ?></li>
        <?php } else { ?>
            <li><a href="{!!action('Frontend\MyOrderController@getIndex', array('page' => $page))!!}"><?php echo $page; ?></a></li>
        <?php } ?>
    <?php } ?>
    <?php if ($currentPage != $lastPage) { ?>
        <li><a href="{!!action('Frontend\MyOrderController@getIndex', array('page' => $nextPage))!!}">></a></li>
        <li><a href="{!!action('Frontend\MyOrderController@getIndex', array('page' => $lastPage))!!}">>></a></li>
    <?php } ?>
<?php } ?>