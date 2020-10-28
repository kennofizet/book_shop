@extends('admin.layout.main')

@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="">Tất cả <span class="count">({{$count_customer}})</span></a></li>
                </ul>
                <form method="POST" action="{{ route('admin.cart.search-customer') }}" id="form-add-search-cart-customer" class="form-s fl-right">
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
                            <td><span class="thead-text">Họ và tên</span></td>
                            <td><span class="thead-text">Số điện thoại</span></td>
                            <td><span class="thead-text">Email</span></td>
                            <td><span class="thead-text">Địa chỉ</span></td>
                            <td><span class="thead-text">Đơn hàng</span></td>
                            <td><span class="thead-text">Thời gian</span></td>
                        </tr>
                    </thead>
                    <tbody id="body-search-append">
                        @foreach($list_customer as $customer_detail)
                        <tr>
                            <!-- <td><input type="checkbox" name="checkItem" class="checkItem"></td> -->
                            <td><span class="tbody-text">{{$loop->index + 1}}</h3></span>
                            <td>
                                <div class="tb-title fl-left">
                                    <span>{{$customer_detail->name}}</span>
                                </div>
                                <ul class="list-operation fl-right">
                                    <!-- <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li> -->
                                </ul>
                            </td>
                            <td><span class="tbody-text">{{$customer_detail->phone}}</span></td>
                            <td><span class="tbody-text">{{$customer_detail->email}}</span></td>
                            <td><span class="tbody-text">{{$customer_detail->address}}</span></td>
                            <td><span class="tbody-text">{{$customer_detail->Bill->code}}</span></td>
                            <td><span class="tbody-text">{{$customer_detail->created_at}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                            <td><span class="tfoot-body">STT</span></td>
                            <td><span class="tfoot-body">Họ và tên</span></td>
                            <td><span class="tfoot-body">Số điện thoại</span></td>
                            <td><span class="tfoot-body">Email</span></td>
                            <td><span class="tfoot-body">Địa chỉ</span></td>
                            <td><span class="tfoot-body">Đơn hàng</span></td>
                            <td><span class="tfoot-body">Thời gian</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="section" id="paging-wp">
        <div class="section-detail clearfix">
            <ul id="list-paging" class="fl-right">
                {{$list_customer->links()}}
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
        $('#form-add-search-cart-customer').submit();
    });
    
    $('#form-add-search-cart-customer').on('submit', function(e) {
        var key = $('#key_search').val();
        e.preventDefault();
        $.ajax({
          url:"{{ route('admin.cart.search-customer') }}",
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
