@if ($lastPage > 1)
    @if ($currentPage != 1)
        <a href="{!!action('Admin\ContactController@index', array_merge($input,array('page' => 1)))!!}" class="tab_off"><<</a>
        <a href="{!!action('Admin\ContactController@index', array_merge($input,array('page' => $previousPage)))!!}" class="tab_off"><</a>
    @endif
    @for ($page = $begin; $page <= $end; $page++)
        @if ($page == $currentPage)
            <em>{!!$page!!}</em>
        @else
           <a href="{!!action('Admin\ContactController@index', array_merge($input,array('page' => $page)))!!}" class="tab_off"><?php echo $page; ?></a>
        @endif
    @endfor
    @if ($currentPage != $lastPage)
        <a href="{!!action('Admin\ContactController@index', array_merge($input,array('page' => $nextPage)))!!}" class="tab_off">></a>
        <a href="{!!action('Admin\ContactController@index', array_merge($input,array('page' => $lastPage)))!!}" class="tab_off">>></a>
    @endif
@endif