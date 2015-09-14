@extends('layout')
@section('stylesheets')
{!!Html::style('css/jobs.css')!!}
@section('content')
 @if(Session::has('success'))
          <div class="alert-box success">
          <h2>{!!Session::get('success') !!}</h2>
          </div>
    @endif
<table class="jobs">
@if (!empty($jobs))
  @foreach ($jobs as $job)
    <tr class="">
      <td class="location">{!! $job['location'] !!}</td>
      <td class="position">
          {!! link_to_action('Job\JobController@show', $job['position'], array($job['id'])) !!}
      </td>
      <td class="company">{!! $job['company'] !!}</td>
    </tr>
  @endforeach
@endif
</table> 
@if ($lastPage > 1)
    <div class="pagination">
      <a href="{!!URL::route('index',array(1,'keywords'=>$key))!!}">
          {!! Html::image('images/first.png','First page') !!}
      </a>
 
      <a href="{!!URL::route('index',array($previousPage,'keywords'=>$key))!!}">
         {!! Html::image('images/previous.png','Previous page') !!}
      </a>
 
      @for ($page = 1; $page <= $lastPage; $page++)
        @if ($page == $currentPage )
          {!!$page!!}
        @else
        <a href="{!!URL::route('index',array($page,'keywords'=>$key))!!}">{!!$page!!}</a>
        @endif
      @endfor
 
      <a href="{!!URL::route('index',array($nextPage,'keywords'=>$key))!!}">
        {!! HTML::image('images/next.png','Next page') !!}
      </a>
 
      <a href="{!!URL::route('index',array($lastPage,'keywords'=>$key))!!}">
        {!! HTML::image('images/last.png','Last page') !!}
      </a>
    </div>
  @endif
 
  <div class="pagination_desc">
    <strong>{!! $totalRecord !!}</strong> jobs in this category
 
    @if ($lastPage > 1)
      - page <strong>{!! $currentPage !!}/{!! $lastPage !!}</strong>
    @endif
  </div>
@stop