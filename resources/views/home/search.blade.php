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
                        <a href="#" title="">Search</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" id="body-search-append">
            <div class="section" id="list-product-wp">

                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($list_product as $detail_product)
                        <li>
                            <a href="{{route('product-detail',$detail_product->slug)}}" title="" class="thumb">
                                <img src="{{url('/')}}/upload/source/api/product/thumbnail/{{$detail_product->image}}">
                            </a>
                            <a href="{{route('product-detail',$detail_product->slug)}}" title="" class="product-name" style="
                             display: block;
                             display: -webkit-box;
                             max-width: 100%;
                             height: 49px;
                             /*margin: 0 auto;*/
                             font-size: 14px;
                             -webkit-line-clamp: 2;
                             -webkit-box-orient: vertical;
                             overflow: hidden;
                             text-overflow: ellipsis;
                            ">{{$detail_product->name}}</a>
                            <div class="price">
                                <span class="new">{{$detail_product->price}} vnd</span>
                                @if($detail_product->sale_price)<span class="old">{{$detail_product->sale_price}} vnd</span>@endif
                            </div>
                            <div class="action clearfix">
                                <span title="Thêm giỏ hàng" data-id="{{$detail_product->id}}" class="add-cart fl-left">Thêm giỏ hàng</span>
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
    $('.key_search_home').on('keyup', function(e) {
        var key = $(this).val();
        e.preventDefault();
        $.ajax({
          url:"{{ route('search-pro-post') }}",
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
