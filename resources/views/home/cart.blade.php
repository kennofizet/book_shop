@extends('home.layout.main')

@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('cart')}}" title="">Giỏ Hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cart_list)
                        @foreach($cart_list as $detail_product)
                        <tr>
                            <td>{{$detail_product["item"]->type}}</td>
                            <td>
                                <a href="{{route('product-detail',$detail_product['item']->slug)}}" title="" class="thumb">
                                    <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product['item']->image}}" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="{{route('product-detail',$detail_product['item']->slug)}}" title="" class="name-product">{{$detail_product["item"]->name}}</a>
                            </td>
                            <td>@if($detail_product["item"]->sale_price) {{$detail_product["item"]->sale_price}} @else {{$detail_product["item"]->price}} @endif</td>
                            <td>
                                <input type="text" name="num-order" data-id="{{$detail_product['item']->id}}" value="{{$detail_product['qty']}}" class="num-order cart-update-num-order">
                            </td>
                            <td>{{$detail_product["price"]}}</td>
                            <td>
                                <span title="" data-id="{{$detail_product['item']->id}}" class="del-product" ><i class="fa fa-trash-o"></i></span>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <h1 style="color: red">Bạn chưa có sản phẩm nào trong giỏ hàng</h1>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span>{{$total_price}} vnđ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="{{route('cart')}}" title="" id="update-cart">Load lại</a>
                                        <a href="{{route('cart-check-out')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Nhập số liệu trực tiếp vào ô trong cột số lượng</p>
            </div>
        </div>
    </div>
</div>
<a href="{{route('cart')}}" id="link-redirect"></a>
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
    // "{{url('/')}}/home/js/main.js"
  ]).done(function() {
    console.log("All scripts loaded1");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
    ]).done(function() {
        console.log("All scripts loaded2");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");

    });
    
</script>
<script type="text/javascript">
    $('.cart-update-num-order').on('change',function () {
        var number = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('source.api.user.cart.update-to-cart-single') }}",
          method:"POST",
          data:{id:id,number:number},
          success:function(data){
            if (data.message == "fail") {
            }else if(data.message == "success"){
                loadCountCart();
                $('#link-redirect').click();
            }else if(data.message == "qty"){
                $('#link-redirect').click();
            }else{}
          }
        });
    });
    $('.del-product').on('click',function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('source.api.user.cart.delete-cart-item') }}",
          method:"POST",
          data:{id:id},
          success:function(data){
            if (data.message == "fail") {
            }else if(data.message == "success"){
                loadCountCart();
                $('#link-redirect').click();
            }else{}
          }
        });
    });
</script>
<script type="text/javascript">
    $('.zoomContainer').css('display','none');
</script>
<script type="text/javascript">
  $('.key_search_home').on('keyup',function (e) {
    if ($(this).val()) {
        $('#link-search').attr('href',"{{url('/')}}/search/"+$(this).val());
        $('#link-search').click();
    }
  });
</script>
@endsection
