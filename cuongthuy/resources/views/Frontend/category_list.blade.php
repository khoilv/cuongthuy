<div class="wrap tags">
    @foreach ($categories as $category)
        <a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $category['id']))!!}">{!!$category['category_name']!!}</a>
    @endforeach
    <div class="clear"></div>
</div>
