@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="">Tất cả <span class="count">({{$count_bill}})</span></a> |</li>
                    <li class="publish"><a href="">Chưa xử lý <span class="count">({{$count_bill_active}})</span></a> |</li>
                    <li class="publish"><a href="">Đang vận chuyển <span class="count">({{$count_bill_transport}})</span></a> |</li>
                    <li class="pending"><a href="">Đã xử lý<span class="count">({{$count_bill_done}})</span> |</a></li>
                </ul>
                <form method="POST" action="{{ route('admin.cart.search') }}" id="form-add-search-cart-list" class="form-s fl-right">
                {{csrf_field()}}
                    <input type="text" name="key" id="key_search">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
            </div>
           
            <div class="table-responsive">
                <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Mã đơn hàng</span></td>
                            <td><span class="thead-text">Họ và tên</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Tổng giá</span></td>
                            <td><span class="thead-text">Ghi chú</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                            <td><span class="thead-text">Chi tiết</span></td>
                        </tr>
                    </thead>
                    <tbody id="body-search-append">
                        @foreach($list_bill as $detail_bill)
                        <tr>
                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                            <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
                            <td><span class="tbody-text">{{$detail_bill->code}}</h3></span>
                            <td>
                                <div class="tb-title fl-left">
                                    <a href="{{route('admin.cart.customer-by-id',$detail_bill->Customer->id)}}" title="Khác hàng">{{$detail_bill->Customer->name}}</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <!-- <li><span title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></span></li> -->
                                </ul>
                            </td>
                            <td><span class="tbody-text">@if($detail_bill->status == 1) Chưa hoàn thành @elseif($detail_bill->status == 2) Đang vận chuyển @else Đã hoàn thành @endif</span></td>
                            <td><span class="tbody-text">{{$detail_bill->total}} VNĐ</span></td>
                            <td><span class="tbody-text">{{$detail_bill->note}}</span></td>
                            <td><span class="tbody-text">{{$detail_bill->created_at}}</span></td>
                            <td><a href="{{route('admin.cart.list-detail',$detail_bill->id)}}" title="" class="tbody-text">Chi tiết</a></td>
                            @endforeach
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Mã đơn hàng</span></td>
                            <td><span class="thead-text">Họ và tên</span></td>
                            <td><span class="thead-text">Trạng thái</span></td>
                            <td><span class="thead-text">Tổng giá</span></td>
                            <td><span class="thead-text">Ghi chú</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                            <td><span class="thead-text">Chi tiết</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
                {{$list_bill->links()}}
            </ul>
        </div>
    </div>
</div>
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
    $('#key_search').on('keyup', function() {
        $('#form-add-search-cart-list').submit();
    });
    
    $('#form-add-search-cart-list').on('submit', function(e) {
        var key = $('#key_search').val();
        e.preventDefault();
        $.ajax({
          url:"{{ route('admin.cart.search') }}",
          method:"POST",
          data:{key:key},
          success:function(data){
               $('#body-search-append').html(data.html);
          },
          error:function(jqXHR, textStatus, errorThrown) {
              pushNotify("error",1,"Có gĩ đó lỗi!");
          }
        });
    });
</script>
@endsection
