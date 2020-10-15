<div id="main-menu-wp" class="fl-right">
    <ul id="main-menu" class="clearfix">
        <li>
            <a href="{{route('home')}}" title="">Trang chủ</a>
        </li>
        <li>
            <a href="{{route('blog')}}" title="">Blog</a>
        </li>
        <!-- <li>
            <a href="{{route('about')}}" title="">Giới thiệu</a>
        </li> -->
        <li>
            <a href="{{route('contact')}}" title="">Liên hệ</a>
        </li>
        @if(Auth::user())
        <li>
            <a href="#" title="">{{Auth::user()->name}}</a>
        </li>
        @else
        <li>
            <a href="{{route('login_admin')}}" title="">Đăng Nhập</a>
        </li>
        @endif
    </ul>
</div>
