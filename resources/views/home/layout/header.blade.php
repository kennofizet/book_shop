<!DOCTYPE html>
<html>
    <head>
        <title>ISMART STORE</title>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{url('/')}}/home/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/reset.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/home/css/import/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/global.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/header.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/footer.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/home.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/category_product.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/blog.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/detail_product.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/detail_blog.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/cart.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/home/css/import/checkout.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.6.1/sweetalert2.min.js">

        <link href="{{url('/')}}/home/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="{{url('/')}}/home/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/home/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <!-- costume -->
        <script src="{{url('/')}}/home/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/home/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <!-- <script src="{{url('/')}}/home/js/main.js" type="text/javascript"></script> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
        
        <script type="text/javascript">
          $(function(){
        // pjax
        $(document).pjax('a', '#content-load')
        })
          $(document).ready(function(){

        // does current browser support PJAX
          if ($.support.pjax) {
          $.pjax.defaults.timeout = 2000; // time in milliseconds
          $.pjax.defaults.scrollTo = false;
          }

          });
            function clearText(field){
                if (field.defaultValue == field.value) field.value = '';
                else if (field.value == '') field.value = field.defaultValue;

            }
        </script>
    </head>
    <body>
        <a href="" id="link-search"></a>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            @include('home.layout.navbar')
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="?page=home" title="" id="logo" class="fl-left"><img src="{{url('/')}}/home/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                    <input type="text" name="key" class="key_search_home" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">@if($infor_web->phone){{$infor_web->phone}} @else Chưa có thông tin @endif</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="{{route('cart')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num" class="number-cart-count">{{$count_item}}</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num" class="number-cart-count">{{$count_item}}</span>
                                    </div>
                                    <!-- <div id="dropdown">
                                        <p class="desc">Có <span>2 sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{url('/')}}/home/images/img-pro-11.png" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title="" class="product-name">Sony Express X6</a>
                                                    <p class="price">6.250.000đ</p>
                                                    <p class="qty">Số lượng: <span>1</span></p>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{url('/')}}/home/images/img-pro-23.png" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title="" class="product-name">Laptop Lenovo 10</a>
                                                    <p class="price">16.250.000đ</p>
                                                    <p class="qty">Số lượng: <span>1</span></p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right">18.500.000đ</p>
                                        </div>
                                        <dic class="action-cart clearfix">
                                            <a href="{{route('cart')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
