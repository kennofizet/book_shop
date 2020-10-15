<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý ISMART</title>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="{{url('/')}}/admin/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/> -->
        <link href="{{url('/')}}/admin/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/admin/reset.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/admin/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <!-- /*STYLE*/ -->
        <link href="{{url('/')}}/admin//css/import/fonts.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/global.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/list_post.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/list_product.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="{{url('/')}}/admin-default/css/bootstrap.min.css">

        <link href="{{url('/')}}/admin//css/import/add_cat.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/info_account.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/change_pass.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/sidebar.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/menu.css" rel="stylesheet" type="text/css"/>

        <link href="{{url('/')}}/admin//css/import/detail_order.css" rel="stylesheet" type="text/css"/>


        <link href="{{url('/')}}/admin/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="{{url('/')}}/admin//js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/admin//js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="{{url('/')}}/notification/notification.css">
        <link rel="stylesheet" href="{{url('/')}}/admin-default/css/cropper/cropper.min.css">


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
        </script>
        <script type="text/javascript">
        function head_script(src) {
            if(document.querySelector("script[src='" + src + "']")){ return; }
            let script = document.createElement('script');
            script.setAttribute('src', src);
            script.setAttribute('type', 'text/javascript');
            document.head.appendChild(script)
        }

        function body_script(src) {
            if(document.querySelector("script[src='" + src + "']")){ return; }
            let script = document.createElement('script');
            script.setAttribute('src', src);
            script.setAttribute('type', 'text/javascript');
            document.body.appendChild(script)
        }
        loadCkeditor = (error, script) => {
            if (error) {
                handleError(error);
            } else {
                new CKEDITOR( 'desc' );
                new CKEDITOR( 'desc-detail' );
            }
        }
        </script>
    </head>
    <body>
        <div class="notification-push animate-nt">
            <a href="#" id="id_tag_notification_erro_image" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Cần chọn hình ảnh trước! " data-title=" Validation :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_erro_video" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Cần chọn video trước! " data-title=" Validation :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_validator_select_video" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Bạn cần chọn một video để có thể cập nhật! " data-title=" Validation :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_validator_select_images" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Bạn cần chọn một mục cập nhật! " data-title=" Validation :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_success_select_images" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Đã cập nhật danh mục ảnh! " data-title=" Success :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>

            <!-- notification default -->
            <a href="#" id="id_tag_notification_success_default_style1" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Đã cập nhật ! " data-title=" Success :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_validation_default_style1" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Bạn nhập dữ trước khi cập nhật ! " data-title=" Validation :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_error_default_style1" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Lỗi gì đó đã xảy ra ! " data-title=" Error :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>
            <a href="#" id="id_tag_notification_erro_default_style1" class="btn btn-info nt-mg-btm-0" data-type="inverse" data-mess=" Lỗi gì đó đã xảy ra ! " data-title=" Error :" data-animation-in="animated rotateIn" data-animation-Out="animated rotateOut" style="display: none;">Rotate In</a>

        </div>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?page=list_post" title="" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?page=list_post" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_page" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_page" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=list_post" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_post" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_post" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_cat" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=list_product" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=add_product" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_product" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_cat" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=list_order" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="?page=list_order" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=menu" title="">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="{{url('/')}}/admin//images/img-admin.png">
                                </div>
                                <h3 id="account" class="fl-right">Admin</h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?page=info_account" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="{{route('logout')}}" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
