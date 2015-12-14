@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('javascript')
<script>
    $(document).ready( function () {
        $('#search_button').click(function() {
            $('#cmd').attr({value: "search"});
            $('#product_form').submit();
        });
        $('#csv_button').click(function() {
            $('#cmd').attr({value: "csv_download"});
            $('#product_form').submit();
        });
    });
</script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/category')!!}">Quản lí danh mục</a> &gt; Danh mục cha</p>
<h2 id="page_midashi_02">Danh mục cha</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue" class="mt15">
    <p class="mb15 big">※ Click vào danh sách danh mục con để xem và cập nhật danh mục con.</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>ID</th>
                <th>Tên danh mục</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parentList as $key => $category)
            <tr class="table_list {!!$key % 2 == 0 ? 'bg_yellow' : ''!!}">
                <td>{!!$category['id']!!}</td>
                <td class="bold"><input type="text" class="text" style="width:100%;" value="{!!$category['category_name']!!}" /></td>
                <td><a href="">Danh sách danh mục con</a></td>
                <td>
                    <button name="update" kind="parent" category_id="1">Update</button>
                    <button name="delete" kind="parent" category_id="1">Delete</button>
                </td>
            </tr>
            @endforeach
    </table>
</div>
<!-- InstanceEndEditable -->
@endsection