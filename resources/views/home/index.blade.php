@extends('home.layout.main')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right" id="body-search-append">

        	<!-- slider banner -->
        	<!-- @include('home.layout.layout-home.layout-slider-banner') -->
        	<!-- end slider banner -->

            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{url('/')}}/home/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{url('/')}}/home/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">@if($infor_web->phone){{$infor_web->phone}} @else Chưa có thông tin @endif</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{url('/')}}/home/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{url('/')}}/home/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{url('/')}}/home/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- slider sub -->
        	<!-- @include('home.layout.layout-home.layout-slider-sub') -->
        	<!-- end slider sub -->

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm mới nhất</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($newest_product as $detail_new_product)
                        <li>
                            <a href="{{route('product-detail',$detail_new_product->slug)}}" title="" class="thumb">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_new_product->image}}">
                            </a>
                            <a href="{{route('product-detail',$detail_new_product->slug)}}" title="" style="
                             display: block;
                             display: -webkit-box;
                             max-width: 100%;
                             height: 49px;
                             /*margin: 0 auto;*/
                             font-size: 14px;
                             line-height: 1;
                             -webkit-line-clamp: 2;
                             -webkit-box-orient: vertical;
                             overflow: hidden;
                             text-overflow: ellipsis;
                            " class="product-name">{{$detail_new_product->name}}</a>
                            <div class="price">
                                <span class="new">{{$detail_new_product->price}} vnd</span>
                                @if($detail_new_product->sale_price)
                                <span class="old">{{$detail_new_product->sale_price}} vnd</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <span title="Thêm giỏ hàng" data-id="{{$detail_new_product->id}}" class="add-cart fl-left">Thêm giỏ hàng</span>
                                <a href="{{route('cart-check-out')}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Có thể bạn quan tâm</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($random_product as $detail_new_product_random)
                        <li>
                            <a href="{{route('product-detail',$detail_new_product_random->slug)}}" title="" class="thumb">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_new_product_random->image}}">
                            </a>
                            <a href="{{route('product-detail',$detail_new_product_random->slug)}}" title="" style="
                             display: block;
                             display: -webkit-box;
                             max-width: 100%;
                             height: 49px;
                             /*margin: 0 auto;*/
                             font-size: 14px;
                             line-height: 1;
                             -webkit-line-clamp: 2;
                             -webkit-box-orient: vertical;
                             overflow: hidden;
                             text-overflow: ellipsis;
                            " class="product-name">{{$detail_new_product_random->name}}</a>
                            <div class="price">
                                <span class="new">{{$detail_new_product_random->price}} vnd</span>
                                @if($detail_new_product_random->sale_price)
                                <span class="old">{{$detail_new_product_random->sale_price}} vnd</span>
                                @endif
                            </div>
                            <div class="action clearfix">
                                <span title="Thêm giỏ hàng" data-id="{{$detail_new_product_random->id}}" class="add-cart fl-left">Thêm giỏ hàng</span>
                                <a href="{{route('cart-check-out')}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('home.layout.layout-home.menu')
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($top_cart_product as $detail_product_top)
                        <li class="clearfix">
                            <a href="{{route('product-detail',$detail_product_top->slug)}}" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product_top->image}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('product-detail',$detail_product_top->slug)}}" title="" class="product-name">{{$detail_product_top->name}}</a>
                                <div class="price">
                                    <span class="new">{{$detail_product_top->price}} vnd</span>
                                    @if($detail_product_top->sale_price)
                                    <span class="old">{{$detail_product_top->sale_price}} vnd</span>
                                    @endif
                                </div>
                                <span style="border: 1px solid #333;color: #333;display: block;padding: 2px 10px;font-size: 12px;cursor: pointer;" title="Thêm giỏ hàng" data-id="{{$detail_new_product_random->id}}" class="add-cart fl-left">Đặt Hàng</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <!-- <img src="{{url('/')}}/home/images/banner.png" alt=""> -->
                    </a>
                </div>
            </div>
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
    $('.add-cart').on('click',function (e) {
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('source.api.user.cart.add-to-cart') }}",
          method:"POST",
          data:{id:id},
          success:function(data){
            if (data.message == "fail") {
            }else if(data.message == "success"){
                loadCountCart();
            }
          }
        });
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
