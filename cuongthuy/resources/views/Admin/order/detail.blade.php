@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="../index.html">TOP</a> &gt; <a href="index">Quản lí đơn hàng</a> &gt; Chi tiết đơn hàng</p>
<h2 id="page_midashi_02">Chi tiết đơn hàng</h2>
<div id="bg_blue" class="mb15">
    <p>・Tại đây bạn có thể cập nhật tình trạng đơn hàng</p>
    <p class="alert_red_error mb10">Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới </p>
    <p class="mt10 mb5 bold big">■Trạng thái đơn hàng</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Ngày đặt hàng</th>
            <td>2013/01/15 12:34:56</td>
            <th>Mã đơn hàng</th>
            <td>20130115</td>
        </tr>
        <tr class="menu">
            <th>Trạng thái đơn hàng</th>
            <td>
                <select name="order_status">
                    <option value="">Đơn hàng đang chờ</option>
                    <option value="">Đơn hàng đang xử lí </option>
                    <option value="">Đơn hàng đã xử lý xong</option>
                </select>
            </td>
            <th>Số tiền</th>
            <td>
                <input type="text" name="or_price" class="text" value="10500" style="width:150px;" /> VNĐ
            </td>
        </tr>
        <tr class="menu">
            <th>発注済み日時</th>
            <td>2013/01/20/ 12:34:56</td>
            <th>配送完了日時</th>
            <td>2013/01/20/ 12:34:56</td>
        </tr>
        <tr class="menu">
            <th>メモ</th>
            <td colspan="3" class="pt10 pb10">
                <textarea name="event_etc" class="mb5" style="width:550px; height:100px;"></textarea>
            </td>
        </tr>
    </table>
    <div class="mt15">
        <p id="button" class="mb5">更新</p>
        <div class="clear"></div>
    </div>
</div>

<div id="bg_blue">
    <p class="mb5 bold big">■注文内容</p>
    <p>・各金額は、ハート決済時のハート単価を基に計算しています。</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th class="alignC" colspan="2">利用可能ハート数/金額(税込)</th>
            <th class="alignC" colspan="2">利用ハート数/金額(税込)</th>
            <th class="alignC" colspan="2">残ハート数/金額(税込)</th>
        </tr>
        <tr class="menu">
            <td class="alignR">45ハート</td>
            <td class="alignR">23,625円</td>
            <td class="alignR">45ハート</td>
            <td class="alignR">23,625円</td>
            <td class="alignR">0ハート</td>
            <td class="alignR">0円</td>
        </tr>
    </table>

    <table cellspacing="0" class="table_blue mt5" cellpadding="15">
        <tr class="menu">
            <th class="alignC">商品コード</th>
            <th class="alignC">商品名</th>
            <th class="alignC">数量</th>
            <th class="alignC">ハート数</th>
        </tr>
        <tr class="menu">
            <td>1111111</td>
            <td><a href="../product/detailed.html">アクアコラーゲンゲル エンリッチリフトEX 50g</a></td>
            <td class="alignR">1個</td>
            <td class="alignR">15ハート</td>
        </tr>
        <tr class="menu">
            <td>2222222</td>
            <td><a href="../product/detailed.html">アクアコラーゲンゲル エンリッチリフトEX 100g</a></td>
            <td class="alignR">2個</td>
            <td class="alignR">30ハート</td>
        </tr>
    </table>

    <p class="mt10 mb5 bold big">■配送内容</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th width="20%">氏名</th>
            <td width="30%">浅野 勝也</td>
            <th width="10%">フリガナ</th>
            <td width="30%">アサノ カツヤ</td>
        </tr>
        <tr class="menu">
            <th>郵便番号</th>
            <td colspan="3">〒600-8216</td>
        </tr>
        <tr class="menu">
            <th>都道府県</th>
            <td colspan="3">京都府</td>
        </tr>
        <tr class="menu">
            <th>市区町村</td>
            <td colspan="3">京都市下京区東塩小路町593番地</td>
        </tr>
        <tr class="menu">
            <th>アパート・マンション</th>
            <td colspan="3">トラスコクリスタル　10F</td>
        </tr>
        <tr class="menu">
            <th>電話番号</th>
            <td colspan="3">075-365-2260</td>
        </tr>
    </table>
</div>
<!-- InstanceEndEditable -->
@endsection