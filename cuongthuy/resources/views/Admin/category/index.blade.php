@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('javascript')
<link rel="stylesheet" href="{!!Asset('public/css/admin/jquery.ui.tabs.css')!!}">
    <link rel="stylesheet" href="{!!Asset('public/css/admin/jquery.ui.theme.css')!!}">
    <link rel="stylesheet" href="{!!Asset('public/css/admin/jquery.ui.core.css')!!}">
    <script src="{!!Asset('public/js/jquery.ui.core.js')!!}"></script> 
    <script src="{!!Asset('public/js/jquery.ui.widget.js')!!}"></script> 
    <script src="{!!Asset('public/js/jquery.ui.tabs.js')!!}"></script>
    <script>
        $(document).ready(function() {
            $( "#tabs" ).tabs();
            $( "#parentCategory button" ).click( buttonClickEventListener );
            $( "#childCategory button" ).click( buttonClickEventListener );

            function buttonClickEventListener() {
                var name = $(this).attr('name');
                var kind = $(this).attr('kind');
                var category_master_id = $(this).attr("category_master_id");
                var category_master_id_parent = 0;
                var category_master_name = $('tr[category_master_id='+category_master_id+'] input').val();
                if ( name == "insert" ) $('tr[category_master_id='+category_master_id+'] input').val("")
            
                /**
                 * check category_master_id_parent 
                 */
                if ( name == "insert" && kind == "child" ) {
                    var category_master_id_parent = $("#category_master_id_parent option:selected").val();
                    if ( category_master_id_parent == 0 ) {
                        alert("Vui lòng chọn danh mục cha");
                        return false;
                    }
                }
            
                /**
                 * check category_master_name
                 */
                if ( category_master_name == "" ) {
                    alert("Vui lòng nhập tên danh mục");
                    return false;
                }
            
                /**
                 * ajax
                 */
                $.ajax({
                    url : 'api',
                    type : 'post',
                    data: ({"name"                      : name, 
                        "class"                     : kind, 
                        "category_master_id"        : category_master_id, 
                        "category_master_id_parent" : category_master_id_parent,
                        "category_master_name"      : category_master_name}),
                    success: ajaxSuccessProc
                });
            }
         
            /**
             * AJAX SUCCESS EVENT LISTENER
             */
            function ajaxSuccessProc(result) {
                var object = jQuery.parseJSON(result);
                if ( object.errno == 0 ) {
                    switch ( object.name ) {
                        case "insert":
                            /**
                             * INSERT AFTER
                             */
                            var trHtml = 
                                '<tr category_master_id="' + object.category_master_id + '">\n' +
                                '\t<td class="default" style="width:80%">\n' +
                                '\t\t<input type="text" style="width:99%" value="' + object.category_master_name + '"/>\n' +
                                '\t</td>\n' +
                                '\t<td class="default">\n' +
                                '\t\t<button name="update" kind="parent" category_master_id="' + object.category_master_id + '">Cập nhật</button>\n' +
                                '\t\t<button name="delete" kind="parent" category_master_id="' + object.category_master_id + '">Xoá</button>\n' +
                                '\t</td>\n' +
                                '</tr>';
                            var tableHtml = 
                                '<table cellspacing="0" class="table_blue" cellpadding="15" style="font-size:1.0em" id="' + object.category_master_id + '_childList">\n' +
                                '\t<thead><tr>\n' +
                                '\t\t<th colspan="2">\n' +
                                '\t\t' + object.category_master_name + '\n' +
                                '\t</th>\n' +
                                '</tr></thead>';
                            var tableChild = 
                                '<table cellspacing="0" class="table_blue" cellpadding="15" style="font-size:1.0em" id="' + object.category_master_id_parent + '_childList">\n' +
                                '\t<thead><tr>\n' +
                                '\t\t<th colspan="2">\n' +
                                '\t\t' + object.parent_name + '\n' +
                                '\t</th>\n' +
                                '</tr></thead>';
                            var optionHtml = 
                                '<option value="' + object.category_master_id + '">' + object.category_master_name + '</option>';
                            /**
                             * ADD HTML
                             */
                            switch ( object.class ) {
                                case "parent" : 
                                    $(tableHtml).appendTo('#chlidCategoryList');
                                    $(trHtml).appendTo($('#' + object.class + 'CategoryList'));
                                    $(optionHtml).appendTo($('#category_master_id_parent'));
                                    break;
                                case "child" :
                                    if (document.getElementById(object.category_master_id_parent + '_childList') == null) {
                                        $(tableChild).appendTo('#chlidCategoryList');
                                    }
                                    $(trHtml).appendTo($('#' + object.category_master_id_parent + '_childList'));
                                    break;
                            }
                        
                            /**
                             * ADD BUTTON EVENT LISTENER
                             */
                            $('tr[category_master_id=' + object.category_master_id+'] button').click( buttonClickEventListener );
                            break;
                        
                        case "update":
                            /**
                             * UPDATE AFTER
                             */
                            if ( object.class == "parent" ) {
                                $('#' + object.category_master_id + '_childList b').text('【' + object.category_master_name + '】カテゴリの子カテゴリ一覧');
                                $('#category_master_id_parent option[value=' + object.category_master_id + ']').text(object.category_master_name);
                            }
                            break;
                        
                        case "delete":
                            /**
                             * DELETE AFTER
                             */
                            $('tr[category_master_id=' + object.category_master_id + ']').remove();
                            $('#' + object.category_master_id + '_childList').remove();
                        
                            if ( object.class == "parent" ) {
                                $('#category_master_id_parent option[value=' + object.category_master_id + ']').remove();
                            }
                            break;
                        
                        default:
                            break;
                        }
                        alert("Xử lí thành công.");
                    } else {
                        alert("Đã xảy ra lỗi");
                    }
                }
            });
    </script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí danh mục</p>
<h2 id="page_midashi_02">Quản lí danh mục</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <div id="tabs">
        <ul>
            <li><a href="#parentCategory">Danh mục cha</a></li>
            <li><a href="#childCategory">Danh mục con</a></li>
        </ul>
        <div id="parentCategory">
            <table cellspacing="0" class="table_blue" cellpadding="15" id="parentCategoryList" style="font-size:1.0em">
                <thead>
                    <tr>
                        <th colspan="2">Danh mục</th>
                    </tr>
                </thead>
                <?php $i = 0;?>
                @foreach ($parentList as $key => $category)
                    @if($category['category_parent'] == 0)
                    <tr category_master_id="{!!$category['id']!!}" >
                        <td class="default" style="width:80%">
                            <input type="text" style="width:99%" value="{!!$category['category_name']!!}"/>
                        </td>
                        <td class="default">
                            <button name="update" kind="parent" category_master_id="{!!$category['id']!!}">Cập nhật</button>
                            <button name="delete" kind="parent" category_master_id="{!!$category['id']!!}">Xoá</button>
                        </td>
                    </tr>
                    <?php $i ++; ?>
                    @endif
                @endforeach
            </table>
            @if($i < 4 )
            <br/>
            <table cellspacing="0" class="table_blue" cellpadding="15" id="parentCategoryList" style="font-size:1.0em">
                <thead><tr>
                        <th colspan="2">Thêm danh mục</th>
                    </tr></thead>
                <tr category_master_id="parent_new">
                    <td class="default" style="width:80%">
                        <input type="text" style="width:99%" value=""/>
                    </td>
                    <td class="default">
                        <button name="insert" kind="parent" category_master_id="parent_new">Thêm</button>
                    </td>
                </tr>
            </table>
            @endif
        </div>
        <div id="childCategory">
            <div id="chlidCategoryList">
                @foreach ($parentList as $id => $parentData)
                    @if($parentData['category_parent'] == 0 || !empty($childList[$id]))
                    <br/>
                    <table cellspacing="0" class="table_blue" cellpadding="15" id="{!!$id!!}_childList" style="font-size:1.0em">
                        <thead><tr>
                                <th colspan="2">@if($parentData['category_parent'] != 0) {!!$parentList[$parentData['category_parent']]['category_name']!!} >  @endif {!!$parentData['category_name']!!}</th>
                        </tr></thead>
                        @if(!empty($childList[$id]))
                            @foreach($childList[$id] as $key => $val)
                            <tr category_master_id="{!!$val['id']!!}" >
                                <td class="default" style="width:80%">
                                    <input type="text" style="width:99%" value="{!!$val['category_name']!!}"/>
                                </td>
                                <td class="default">
                                    <button name="update" kind="child" category_master_id="{!!$val['id']!!}">Cập nhật</button>
                                    <button name="delete" kind="child" category_master_id="{!!$val['id']!!}">Xoá</button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
                    @endif
                @endforeach
            </div>
            <br/>
            <table cellspacing="0" class="table_blue" cellpadding="15" id="childCategoryInsert" style="font-size:1.0em">
                <thead>
                    <tr>
                        <th colspan="3">Thêm danh mục con</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <td style="width:25%; border: 1px #80a3ea solid;">Danh mục cha</td>
                        <td style="width:60%;border: 1px #80a3ea solid;">Tên danh mục</td>
                        <td style="border: 1px #80a3ea solid;"></td>
                    </tr>
                </thead>
                <tr category_master_id="child_new">
                    <td class="default">
                        <select id="category_master_id_parent" style="width:99%">
                            <option value="0">Chọn danh mục cha</option>
                            @foreach ( $parentList as $id => $parentData )
                            <option value="{!!$id !!}">{!! $parentData['category_name']; !!}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="default">
                        <input type="text" style="width:99%" value=""/>
                    </td>
                    <td class="default">
                        <button name="insert" kind="child" category_master_id="child_new">Thêm</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection