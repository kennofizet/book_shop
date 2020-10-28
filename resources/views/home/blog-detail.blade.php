@extends('home.layout.main')
@section('style')
<style type="text/css">
    .color-red{
        color: red;
    }
</style>
@endsection
@section('content')
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('blog')}}" title="">Blog</a>
                    </li>
                    <li>
                        <a href="{{route('blog-detail',$post_detail->slug)}}" title="">{{$post_detail->slug}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$post_detail->title}}</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">{{$post_detail->title}}</span>
                    <div class="detail">
                        <p><strong>{!! $post_detail->title_content !!}</strong></p>
                        
                        <p style="text-align: center;">
                            <img src="{{url('/')}}/upload/source/api/blog/images/{{$post_detail->file}}" alt="">
                        </p>
                        <p>{!! $post_detail->content !!}</p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="post-meta">
                        <div class="meta-share">
                            <span class="share-text">Like
                            </span>
                            <i class="like-post-{{$post_detail->slug}} fa fa-heart like-post
                            @if(Auth::user())
                                @if(Auth::user()->CheckLike($post_detail->id))
                                    color-red
                                @endif
                            @endif
                            " data-post="{{$post_detail->slug}}" style="cursor: pointer;">
                            @if($post_detail->countLikePost)
                            {{$post_detail->countLikePost->count}}
                            @else
                            0
                            @endif
                            </i>
                            <span class="share-text">Share
                            </span>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('blog-detail',$post_detail->slug)}}">
                                <i class="fa fa-facebook">
                                </i>
                            </a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?text=Check%20out%20this%20article:%20{{$post_detail->title}}&amp;url={{route('blog-detail',$post_detail->slug)}}">
                                <i class="fa fa-twitter">
                                </i>
                            </a>
                            <a data-pin-do="none" target="_blank" href="https://pinterest.com/pin/create/button/?url={{route('blog-detail',$post_detail->slug)}}&amp;media={{url('/')}}/upload/iloveyou/api/gallery/blog/post/images/{{$post_detail->file}}&amp;description={{$post_detail->title}}">
                                <i class="fa fa-pinterest">
                                </i>
                            </a>
                            <a target="_blank" href="https://plus.google.com/share?url={{route('blog-detail',$post_detail->slug)}}">
                                <i class="fa fa-google-plus">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="{{url('/')}}/home/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type="text/javascript">
    $('.like-post').on('click',function (e) {
        var post = $(this).attr('data-post');
        e.preventDefault();
        $.ajax({
            url:"{{ route('source.api.user.blog.like-post') }}",
            method:"POST",
            data:{post:post},
            success:function(data){
                if (data.message === "like") {
                    $('.like-post-'+data.slug).addClass('color-red');
                    $('.like-post-'+data.slug).html(data.like);
                }else if(data.message === "un-like"){
                    $('.like-post-'+data.slug).removeClass('color-red');
                    $('.like-post-'+data.slug).html(data.like);
                }else{}
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
