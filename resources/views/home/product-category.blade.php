@extends('home.layout.main')

@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">{{$category->slug}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" id="body-search-append">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">{{$category->title}}</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 20 trên {{$count_product}} sản phẩm</p>
                        @if(Auth::user())
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select" id="actions-active-sort-form">
                                    <option value="" @if($sort_name == 0) selected @endif>Sắp xếp</option>
                                    <option value="1" @if($sort_name == 1) selected @endif>Từ A-Z</option>
                                    <option value="2" @if($sort_name == 2) selected @endif>Từ Z-A</option>
                                    <option value="3" @if($sort_name == 3) selected @endif>Giá cao xuống thấp</option>
                                    <option value="4" @if($sort_name == 4) selected @endif>Giá thấp lên cao</option>
                                </select>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
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
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{$list_product->links()}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('home.layout.layout-home.menu')
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1" class="actions-active-sort-price-form" @if($session_sort == 1) checked="checked" @endif></td>
                                    <td>Không lọc</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="50000" class="actions-active-sort-price-form" @if($session_sort == 50000) checked="checked" @endif></td>
                                    <td>Dưới 50.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="100000" class="actions-active-sort-price-form" @if($session_sort == 100000) checked="checked" @endif></td>
                                    <td>50.000đ - 100.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="500000" class="actions-active-sort-price-form" @if($session_sort == 500000) checked="checked" @endif></td>
                                    <td>100.000đ - 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1000000" class="actions-active-sort-price-form" @if($session_sort == 1000000) checked="checked" @endif></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1000001" class="actions-active-sort-price-form" @if($session_sort == 1000001) checked="checked" @endif></td>
                                    <td>Trên 1.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <!-- <img src="{{url('/')}}/home/images/banner.png" alt=""> -->
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{route('product-by-category',$category->slug)}}" id="redirect-link"></a>
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
$('#actions-active-sort-form').on('change', function() {
  $.ajax({
      url:"{{ route('source.api.user.product.sort-product-category') }}",
      method:"POST",
      data:{sort_by:this.value},
      success:function(data){
        if (data.message == "no_action") {
        }else if(data.message == "success"){
            $('#redirect-link').click();
        }
      }
    });
});
$('.actions-active-sort-price-form').on('change', function() {
  $.ajax({
      url:"{{ route('source.api.user.product.sort-price-product-category') }}",
      method:"POST",
      data:{sort_price:this.value},
      success:function(data){
        if (data.message == "no_action") {
        }else if(data.message == "success"){
            $('#redirect-link').click();
        }
      }
    });
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
