@include('home.layout.header')
<div id="content-load">
	@yield('style')
	@yield('content')
	@yield('script')
</div>
@include('home.layout.footer')
