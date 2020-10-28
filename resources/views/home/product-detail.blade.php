@extends('home.layout.main')

@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('product-by-category',$detail_product->Category->slug)}}" title="">{{$detail_product->Category->slug}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" id="body-search-append">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}" data-zoom-image="{{url('/')}}/upload/source/api/product/room-sezi/{{$detail_product->image}}"/>
                        </a>
                        <div id="list-thumb">
                            <span data-image="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}" data-zoom-image="{{url('/')}}/upload/source/api/product/room-sezi/{{$detail_product->image}}">
                                <img data-image="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}" data-zoom-image="{{url('/')}}/upload/source/api/product/room-sezi/{{$detail_product->image}}" id="zoom{{$detail_product->image}}zzz" class="room" src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}" />
                            </span>
                            @foreach($detail_product->TypeProduct as $detail_type)
                            <span data-image="{{url('/')}}/upload/source/api/product/type/thumbnail/{{$detail_type->image}}" data-zoom-image="{{url('/')}}/upload/source/api/product/type/room-sezi/{{$detail_type->image}}">
                                <img data-image="{{url('/')}}/upload/source/api/product/type/thumbnail/{{$detail_type->image}}" data-zoom-image="{{url('/')}}/upload/source/api/product/type/room-sezi/{{$detail_type->image}}" id="zoom{{$detail_type->image}}" class="room" src="{{url('/')}}/upload/source/api/product/type/thumbnail/{{$detail_type->image}}" />
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{url('/')}}/home/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$detail_product->name}}</h3>
                        <div class="desc">
                            {!! $detail_product->description !!}
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">@if($detail_product->status_count == 1)Còn hàng @else Hết hàng @endif</span>
                        </div>
                        @if($detail_product->sale_price)
                        <p class="price">{{$detail_product->sale_price}} VND</p>
                        @else
                        <p class="price">{{$detail_product->price}} VND</p>
                        @endif
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <span title="Thêm giỏ hàng" data-id="{{$detail_product->id}}" class="add-cart-qty">Thêm giỏ hàng</span>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    {!! $detail_product->content !!}
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($product_near as $detail_near_product)
                        <li>
                            <a href="{{route('product-detail',$detail_near_product->slug)}}" title="" class="thumb">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_near_product->image}}">
                            </a>
                            <a href="{{route('product-detail',$detail_near_product->slug)}}" title="" style="
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
                            " class="product-name">{{$detail_near_product->name}}</a>
                            <div class="price">
                                <span class="new">{{$detail_near_product->price}} vnd</span>
                                @if($detail_near_product->sale_price)<span class="old">{{$detail_near_product->sale_price}} vnd</span>@endif
                            </div>
                            <div class="action clearfix">
                                <span style="display: block;padding: 2px 10px;font-size: 12px;" title="" class="add-cart fl-left" data-id="{{$detail_near_product->id}}">Thêm giỏ hàng</span>
                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('home.layout.layout-home.menu')
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
    "{{url('/')}}/home/js/main.js"
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
    $('.room').on('click',function (e) {
        console.log("a");
        var image = $(this).attr('data-image');
        var image_zoom = $(this).attr('data-zoom-image');
        $('#zoom').attr('src',image);
        $('#zoom').attr('data-zoom-image',image_zoom);
        $('.zoomWindow').css('background-image',"url('"+image_zoom+"')");
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
    $('.add-cart-qty').on('click',function (e) {
        var id = $(this).attr('data-id');
        var qty = $('#num-order').val();
        $.ajax({
          url:"{{ route('source.api.user.cart.add-to-cart-multi') }}",
          method:"POST",
          data:{id:id,qty:qty},
          success:function(data){
            if (data.message == "fail") {
            }else if(data.message == "success"){
                loadCountCart();
            }else if(data.message == "qty"){
            }else{}
          }
        });
    });
</script>
<script type="text/javascript">
    function update_href (e) {
        
    }
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
