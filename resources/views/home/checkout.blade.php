@extends('home.layout.main')
@section('style')

@endsection
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('cart-check-out')}}" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="{{ route('source.api.user.cart.cart-check-out') }}" id="form-checkout">
            {{csrf_field()}}
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <span style="display: none;">Đặt hàng thành công, chúng tôi sẽ liên hệ lại với bạn để xác nhận lại sau!</span>
                <div class="section-detail">
                    
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname" id="mess_name">Họ tên *</label>
                                <input type="text" name="name" id="fullname">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address" id="mess_address">Địa chỉ *</label>
                                <input type="text" name="address" id="address">
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone" id="mess_phone">Số điện thoại *</label>
                                <input type="tel" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cart_list)
                            @foreach($cart_list as $detail_product)
                            <tr class="cart-item">
                                <td class="product-name">{{$detail_product["item"]->name}}<strong class="product-quantity">x {{$detail_product["qty"]}}</strong></td>
                                <td class="product-total">{{$detail_product["price"]}} vnđ</td>
                            </tr>
                            @endforeach
                            @else
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price">{{$total_price}} vnđ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <span style="color: red;display: none;" id="mess_payment">Vui lòng chọn phương thức thanh toán</span>
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" class="payment-check" id="direct-payment" name="payment_method" value="direct-payment">
                                <label for="direct-payment">Thanh toán khi nhận hàng</label>
                            </li>
                            <li>
                                <input type="radio" class="payment-check" id="payment-home" name="payment_method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<a href="{{route('home')}}" id="link_redirect"></a>
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
    $('#form-checkout').on('submit',function (e) {
        e.preventDefault();
        $('#mess_payment').css('display',"none");
        $('#mess_name').css('color',"#272727");
        $('#mess_address').css('color',"#272727");
        $('#mess_phone').css('color',"#272727");
        $.ajax({
            url:"{{ route('source.api.user.cart.cart-check-out') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
              if (data.message == "success") {
                loadCountCart();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Done!',
                  showConfirmButton: false,
                  timer: 1500
                })
                setTimeout(function(){ 
                    $('#link_redirect').click();
                }, 1000);
              }else if(data.message == "payment"){
                    $('#mess_payment').css('display',"block");
              }else{
                  
              }
            },
            error: function(jqXhr, json, errorThrown){
                if (jqXhr['responseJSON']['errors']['name']) {
                    $('#mess_name').css('color',"red");
                };
                if (jqXhr['responseJSON']['errors']['address']) {
                    $('#mess_address').css('color',"red");
                };
                if (jqXhr['responseJSON']['errors']['phone']) {
                    $('#mess_phone').css('color',"red");
                };
            }
        });
    });
</script>
<script type="text/javascript">
    $('.payment-check').on('change',function () {
        $('#mess_payment').css('display',"none");
    });
    $('#fullname').on('change',function () {
        $('#mess_name').css('color',"#272727");
    });
    $('.address').on('change',function () {
        $('#mess_address').css('color',"#272727");
    });
    $('.phone').on('change',function () {
        $('#mess_phone').css('color',"#272727");
    });
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
