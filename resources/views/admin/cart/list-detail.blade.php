@extends('admin.layout.main')

@section('content')
<div id="content" class="detail-exhibition fl-right">
    <div class="section" id="info">
        <div class="section-head">
            <h3 class="section-title">Thông tin đơn hàng</h3>
        </div>
        <ul class="list-item">
            <li>
                <h3 class="title">Mã đơn hàng</h3>
                <span class="detail">{{$bill_detail->code}}</span>
            </li>
            <li>
                <h3 class="title">Địa chỉ nhận hàng</h3>
                <span class="detail">{{$bill_detail->Customer->address}} / {{$bill_detail->Customer->phone}}</span>
            </li>
            <li>
                <h3 class="title">Thông tin vận chuyển</h3>
                <span class="detail">@if($bill_detail->payment == 1) Thanh toán khi nhận hàng @else Thanh toán qua tài khoản @endif</span>
            </li>
            <form method="POST" id="form-update-bill-status">
                {{csrf_field()}}
                <li>
                    <h3 class="title">Tình trạng đơn hàng</h3>
                    <select name="status">

                        <option  value='1' @if($bill_detail->status == 1) selected @endif>Chờ xử lý</option>
                        <option  value='2' @if($bill_detail->status == 2) selected @endif>Đang vận chuyển</option>
                        <option  value='0' @if($bill_detail->status == 0) selected @endif>Đã hoàn thành</option>

                    </select>
                    <input style="display: none;" type="text" name="id" value="{{$bill_detail->id}}">
                    <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                </li>
            </form>
        </ul>
    </div>
    <div class="section">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm đơn hàng</h3>
        </div>
        <div class="table-responsive">
            <table class="table info-exhibition">
                <thead>
                    <tr>
                        <td class="thead-text">STT</td>
                        <td class="thead-text">Ảnh sản phẩm</td>
                        <td class="thead-text">Tên sản phẩm</td>
                        <td class="thead-text">Đơn giá</td>
                        <td class="thead-text">Số lượng</td>
                        <td class="thead-text">Thành tiền</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill_detail->BillDetail as $detail)
                    <tr>
                        <td class="thead-text">{{$loop->index + 1}}</td>
                        <td class="thead-text">
                            <div class="thumb">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail->Product->image}}" alt="">
                            </div>
                        </td>
                        <td class="thead-text">{{$detail->Product->name}}</td>
                        <td class="thead-text">@if($detail->Product->sale_price) {{$detail->Product->sale_price}} @else {{$detail->Product->price}} @endif VNĐ</td>
                        <td class="thead-text">{{$detail->quantity}}</td>
                        <td class="thead-text">{{$detail->unit_price}} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="section">
        <h3 class="section-title">Giá trị đơn hàng</h3>
        <div class="section-detail">
            <ul class="list-item clearfix">
                <li>
                    <span class="total-fee">Tổng số lượng</span>
                    <span class="total">Tổng đơn hàng</span>
                </li>
                <li>
                    <span class="total-fee">{{$bill_detail->BillDetail->count()}} sản phẩm</span>
                    <span class="total">{{$bill_detail->total}} VNĐ</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<a href="{{route('admin.cart.list')}}" id="redirect-link"></a>
@endsection
@section('script')
<script type="text/javascript">
function loadScripts(scripts) {
var deferred = jQuery.Deferred();

function loadScript(i) {
  if (i < scripts.length) {
    jQuery.ajax({
      url: scripts[i],
      dataType: "script",
      cache: true,
      success: function() {
        loadScript(i + 1);
      }
    });
  } else {
    deferred.resolve();
  }
}
loadScript(0);

return deferred;
}

  var d1 = loadScripts([

  ]).done(function() {
    console.log("All scripts loaded1");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
    ]).done(function() {
        console.log("All scripts loaded2");
        $('input[name="checkAll"]').click(function () {
            var status = $(this).prop('checked');
            $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
            $('.list-table-wp tbody tr td input[type="checkbox"]').addClass("product-type-list-table-checked");
        });
        $('input[name="checkItem"]').click(function () {
            $(this).toggleClass("product-type-list-table-checked");
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
      body_script("{{url('/')}}/admin/js/main.js");
    });
    
</script>
<script type="text/javascript">
    $('#form-update-bill-status').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            url:"{{ route('source.api.admin.cart.update-bill-status') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                  pushNotify("success",1,"Đã cập nhật đơn hàng!");
                  $('#redirect-link').click();
              }else if(data.message == "fail"){
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }else{
                  pushNotify("error",1,"Có gĩ đó lỗi!");
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['id']) {
                    pushNotify("error",1,"Có gĩ đó lỗi!");
                };
                if (jqXhr['responseJSON']['errors']['status']) {
                    pushNotify("error",1,"Vui lòng chọn lại trạng thái!");
                };
            }
        });
    });
</script>
@endsection
