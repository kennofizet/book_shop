@include('admin.layout.header')
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        @include('admin.layout.navbar')
		<div id="content-load">
			@yield('style')
			@yield('content')
			@yield('script')
		</div>
	</div>
</div>
@include('admin.layout.footer')
