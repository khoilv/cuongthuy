<?php if ($lastPage > 1) {
    $arrParam = array();
    if ($categoryId !== '') {
        $arrParam['category_id'] = $categoryId;
    }
    if($search_key) {
        $arrParam['search_key'] = $search_key;
    }
    if($search_value) {
        $arrParam['search_value'] = $search_value;
    }
    if ($currentPage != 1) { ?>
        <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => 1))!!}"><<</a></li>
        <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $previousPage))!!}"><</a></li>
    <?php } ?>
    <?php for ($page = $begin; $page <= $end; $page++) { ?>
        <?php if ($page == $currentPage) { ?>
            <li><?php echo $page; ?></li>
        <?php } else { ?>
            <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $page))!!}"><?php echo $page; ?></a></li>
        <?php } ?>
    <?php } ?>
    <?php if ($currentPage != $lastPage) { ?>
        <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $nextPage))!!}">></a></li>
        <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $lastPage))!!}">>></a></li>
    <?php } ?>
<?php } ?>