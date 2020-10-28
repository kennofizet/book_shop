<div id="sidebar" class="fl-left">
    <ul id="sidebar-menu">
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-pencil-square-o icon"></span>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('admin.blog.create')}}" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.blog.list')}}" title="" class="nav-link">Danh sách bài viết</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-product-hunt icon"></span>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('admin.product.create')}}" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product.list')}}" title="" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product.type.list')}}" title="" class="nav-link">Chi tiết sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product.category')}}" title="" class="nav-link">Danh mục sản phẩm</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('admin.cart.list')}}" title="" class="nav-link">Danh sách đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.cart.list-customer')}}" title="" class="nav-link">Danh sách khách hàng</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                <span class="title">Giao Diện</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('admin.setting.template.login')}}" title="Setting Page Login" class="nav-link">Trang đăng nhập</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="title">Tài khoản</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('admin.account.list')}}" title="List Account" class="nav-link">Danh Sách tài khoản</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
