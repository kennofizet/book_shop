<!DOCTYPE html>
<html lang="zxx">
<!-- Head -->

<head>
    <title>Login</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Key Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="{{url('/')}}/login-fix/css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="{{url('/')}}/login-fix/css/font-awesome.min.css" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->
	
	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->
    <link rel="stylesheet" href="{{url('/')}}/login-fix/css/bootstrap.min.css">

</head>
<!-- //Head -->
<!-- Body -->
<style type="text/css">
	<?php if ($style_login): ?>
		.main {
		    background: url({{url('/')}}/upload/source/api/setting/page-login/images/{{$style_login}}) no-repeat center;
		    background-size: cover;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    -ms-background-size: cover;
			position: relative;
		    min-height: 100vh;
		}
	<?php else: ?>
		.main {
		    background: url({{url('/')}}/login-fix/images/bg.jpg) no-repeat center;
		    background-size: cover;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    -ms-background-size: cover;
			position: relative;
		    min-height: 100vh;
		}
	<?php endif ?>
</style>
<body>

<section class="main">
	<div class="layer">
		
		<div class="bottom-grid">
			<div class="logo">
				<h1> <a href="index.html"><span class="fa fa-key"></span> Key</a></h1>
			</div>
			<div class="links">
				<ul class="links-unordered-list">
					<li class="active">
						<a id="click_reset_password_account_change_form" class="">Reset Password</a>
					</li>
					<li class="">
						<a href="#" class="">About Us</a>
					</li>
					<li class="">
						<a href="#" class="">Register</a>
					</li>
					<li class="">
						<a href="#" class="">Contact</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-w3ls">
			<div class="text-center icon">
				<span class="fa fa-html5"></span>
			</div>
			@if(count($errors) > 0)
                <div class="alert alert-danger text-center">
                    @foreach($errors->all() as $err)
                        <strong>{{ $err }}</strong><br/>
                    @endforeach
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-danger text-center">
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-center">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

			<div class="content-bottom" id="login_form" 
			
			>
				<form role="form" method="POST" autocomplete="off" action="{{route('post_login')}}">
                    {{ csrf_field() }}
					<div class="field-group">
						<span class="fa fa-user" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="email" type="text" value="" placeholder="Username" required>
						</div>
					</div>
					<div class="field-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="password" type="Password" placeholder="Password">
						</div>
					</div>
					<div class="wthree-field">
						<button type="submit" name="name_btn" value="login" class="btn">Get Started</button>
					</div>
					<ul class="list-login">
						<li class="switch-agileits">
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								keep Logged in
							</label>
						</li>
						<li>
							<a id="click_forgot_password_account_change_form" class="text-right">forgot password?</a>
						</li>
						<li class="clearfix"></li>
					</ul>
					<ul class="list-login-bottom">
						<li class="">
							<a class="" id="click_create_account_change_form">Create Account</a>
						</li>
						<li class="">
							<a href="#" class="text-right">Need Help?</a>
						</li>
						<li class="clearfix"></li>
					</ul>

				</form>
			</div>

			<div class="content-bottom" id="register_form" 
			style="display: none;"
			>
				<form role="form" method="POST" action="{{route('post_register')}}" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="col-md-12" style="width: 100%!important">
						<div class="col-md-6">
							<div class="field-group">
								<span class="fa fa-user" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="firstname" type="text" value="" placeholder="First Name" required>
								</div>
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="field-group">
								<span class="fa fa-lock" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="lastname" type="text" placeholder="Last Name">
								</div>
							</div>
						</div>
						<div class="col-md-12" style="float: right;">
							<div class="field-group">
								<span class="fa fa-user" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="email" type="email" value="" placeholder="Email" required>
								</div>
							</div>
							<div class="field-group">
								<span class="fa fa-lock" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="password" type="Password" placeholder="Password">
								</div>
							</div>
							<div class="field-group">
								<span class="fa fa-lock" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="password_confirmation" type="Password" placeholder="Password required">
								</div>
							</div>
						</div>
					</div>

					<div class="wthree-field">
						<button type="submit" name="name_btn" value="login" class="btn">Register</button>
					</div>
					<ul class="list-login">
						<li class="switch-agileits">
							<label class="switch">
								<input type="checkbox">
								<span class="slider round"></span>
								Login
							</label>
						</li>
						<li>
							<a href="#" class="text-right">forgot password?</a>
						</li>
						<li class="clearfix"></li>
					</ul>
					<ul class="list-login-bottom">
						<li class="">
							<a class="" id="click_register_account_change_form">Back To Login</a>
						</li>
						<li class="">
							<a href="#" class="text-right">Need Help?</a>
						</li>
						<li class="clearfix"></li>
					</ul>

				</form>
			</div>

			<div class="content-bottom" id="forgot_password_form" 
			style="display: none;"
			>
				<form role="form" method="POST" action="{{route('post_forgot_password')}}" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="col-md-12" style="width: 100%!important">
						<div class="col-md-12" style="float: right;">
							<div class="field-group">
								<span class="fa fa-user" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="email" type="email" value="" placeholder="Email" required>
								</div>
							</div>
						</div>
					</div>

					<div class="wthree-field">
						<button type="submit" name="name_btn" value="forgot_password" class="btn">Submit</button>
					</div>
					<ul class="list-login-bottom">
						<li class="">
							<a class="" id="click_register_account_change_form">Back To Login</a>
						</li>
						<li class="">
							<a href="#" class="text-right">Need Help?</a>
						</li>
						<li class="clearfix"></li>
					</ul>

				</form>
			</div>

			<div class="content-bottom" id="reset_password_form" 
			style="display: none;"
			>
				<form role="form" method="POST" action="{{route('resetpassword')}}" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="col-md-12" style="width: 100%!important">
						<div class="col-md-12" style="float: right;">
							<div class="field-group">
								<span class="fa fa-user" aria-hidden="true"></span>
								<div class="wthree-field">
									<input name="email" type="email" value="" placeholder="Email" required>
								</div>
							</div>
						</div>
					</div>

					<div class="wthree-field">
						<button type="submit" name="name_btn" value="forgot_password" class="btn">Submit</button>
					</div>
					<ul class="list-login-bottom">
						<li class="">
							<a class="" id="click_register_account_change_form">Back To Login</a>
						</li>
						<li class="">
							<a href="#" class="text-right">Need Help?</a>
						</li>
						<li class="clearfix"></li>
					</ul>

				</form>
			</div>

		</div>
		<div class="bottom-grid1">
			<div class="links">
				<ul class="links-unordered-list">
					<li class="">
						<a href="#" class="">About Us</a>
					</li>
					<li class="">
						<a href="#" class="">Privacy Policy</a>
					</li>
					<li class="">
						<a href="#" class="">Terms of Use</a>
					</li>
				</ul>
			</div>
			<div class="copyright">
				<p>© 2019 Key. All rights reserved | Design by
					<a href="http://w3layouts.com">W3layouts</a>
				</p>
			</div>
		</div>
    </div>
</section>
<script type="text/javascript" src="{{url('/')}}/home/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
	$('#click_create_account_change_form').click(function () {
		$('#login_form').css('display','none');
		$('#register_form').css('display','block');
	});
	$('#click_register_account_change_form').click(function () {
		$('#login_form').css('display','block');
		$('#register_form').css('display','none');
	});
	$('#click_forgot_password_account_change_form').click(function () {
		$('#login_form').css('display','none');
		$('#register_form').css('display','none');
		$('#forgot_password_form').css('display','block');
	});
	$('#click_reset_password_account_change_form').click(function () {
		$('#login_form').css('display','none');
		$('#register_form').css('display','none');
		$('#forgot_password_form').css('display','none');
		$('#reset_password_form').css('display','block');
	});
	
</script>
</body>
<!-- //Body -->
</html>
