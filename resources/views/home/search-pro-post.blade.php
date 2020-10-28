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
