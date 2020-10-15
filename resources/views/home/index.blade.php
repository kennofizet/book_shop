@extends('home.layout.main')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">

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
                            <p class="desc">1900.9999</p>
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
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-16.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Motorola Moto G5S Plus</a>
                            <div class="price">
                                <span class="new">6.990.000đđ</span>
                                <span class="old">8.990.000đđ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-15.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Samsung Galaxy A5</a>
                            <div class="price">
                                <span class="new">7.990.000đ</span>
                                <span class="old">9.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-14.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Sony Xperia XA Ultra</a>
                            <div class="price">
                                <span class="new">6.990.000đ</span>
                                <span class="old">7.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-13.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Huawei Nova 2i</a>
                            <div class="price">
                                <span class="new">5.990.000đ</span>
                                <span class="old">8.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-12.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Xiaomi Mi A1</a>
                            <div class="price">
                                <span class="new">5.990.000đ</span>
                                <span class="old">6.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-11.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">HTC U Ultra Sapphire</a>
                            <div class="price">
                                <span class="new">16.490.000đ</span>
                                <span class="old">18.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-08.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Sony Xperia XZ Dual</a>
                            <div class="price">
                                <span class="new">9.990.000đ</span>
                                <span class="old">10.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-10.png">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">Bphone 2017</a>
                            <div class="price">
                                <span class="new">9.790.000đ</span>
                                <span class="old">10.790.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-17.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus X441NA</a>
                            <div class="price">
                                <span class="new">7.690.000đ</span>
                                <span class="old">8.690.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-18.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 110</a>
                            <div class="price">
                                <span class="new">9.490.000đ</span>
                                <span class="old">10.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-19.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Acer ES1 533</a>
                            <div class="price">
                                <span class="new">7.490.000đ</span>
                                <span class="old">9.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-20.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 110</a>
                            <div class="price">
                                <span class="new">6.990.000đ</span>
                                <span class="old">7.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-21.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus X441NA</a>
                            <div class="price">
                                <span class="new">6.490.000đ</span>
                                <span class="old">8.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-22.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Acer Aspire ES1</a>
                            <div class="price">
                                <span class="new">6.390.000đ</span>
                                <span class="old">7.390.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-05.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 120S</a>
                            <div class="price">
                                <span class="new">5.190.000đ</span>
                                <span class="old">7.190.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{url('/')}}/home/images/img-pro-23.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus A540UP I5</a>
                            <div class="price">
                                <span class="new">14.490.000đ</span>
                                <span class="old">16.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach($list_category as $detail_category)
                        <li>
                            <a href="?page=category_product" title="">{{$detail_category->title}}</a>
                            @if($detail_category->Child->first())
                                <ul class="sub-menu">
                                    @foreach($detail_category->Child as $category_child_1)
                                    <li>
                                        <a href="?page=category_product" title="">{{$category_child_1->title}}</a>
                                        @if($category_child_1->Child->first())
                                            <ul class="sub-menu">
                                                @foreach($category_child_1->Child as $category_child_2)
                                                <li>
                                                    <a href="?page=category_product" title="">{{$category_child_2->title}}</a>
                                                    @if($category_child_2->Child->first())
                                                        <ul class="sub-menu">
                                                            @foreach($category_child_2->Child as $category_child_3)
                                                            <li>
                                                                <a href="?page=category_product" title="">{{$category_child_3->title}}</a>
                                                                @if($category_child_3->Child->first())
                                                                    <ul class="sub-menu">
                                                                        @foreach($category_child_3->Child as $category_child_4)
                                                                        <li>
                                                                            <a href="?page=category_product" title="">{{$category_child_4->title}}</a>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-13.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Laptop Asus A540UP I5</a>
                                <div class="price">
                                    <span class="new">5.190.000đ</span>
                                    <span class="old">7.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-11.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-12.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-05.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-22.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-23.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-18.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/home/images/img-pro-15.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{url('/')}}/home/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
