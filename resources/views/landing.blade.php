<!DOCTYPE html>
<html lang="zxx">
<!-- Head -->

<head>
    <title>AirCode.com: Book your flights with ease and convenience</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="AirCode.com Book your flights with ease and convenience">
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="{{ asset('_login/css/style.css') }}" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="{{ asset('_login/css/font-awesome.min.css') }}" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->
	
	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->

</head>
<!-- //Head -->
<!-- Body -->

<body>

<section class="main">
	<div class="layer">
		
		<div class="bottom-grid">
			<div class="logo">
				<h1> <a href="index.html"><span class="fa fa-flight"></span></a></h1>
			</div>
			<div class="links">
				<ul class="links-unordered-list">
					<li class="active">
						<a href="#" class="">Login</a>
					</li>
					<li class="">
						<a href="{{ url('register') }}" class="">Register</a>
					</li>
					<li class="">
						<a href="{{ url('booking') }}" class="">Check Availability</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-w3ls">
			<div class="text-center icon">
				<span class="fa">
					<img class="logo-container" src="{{ asset('images/logo.png') }}" />
				</span>
			</div>
			<div class="content-bottom">
				<form action="#" method="post">
					<div class="field-group">
						<span class="fa fa-user" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="text1" id="text1" type="text" value="" placeholder="Username" required>
						</div>
					</div>
					<div class="field-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<div class="wthree-field">
							<input name="password" id="myInput" type="Password" placeholder="Password">
						</div>
					</div>
					<div class="wthree-field">
						<button type="submit" class="btn">Get Started</button>
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
							<a href="#" class="text-right">forgot password?</a>
						</li>
						<li class="clearfix"></li>
					</ul>
					<ul class="list-login-bottom">
						<li class="">
							<a href="#" class="">Create Account</a>
						</li>
						<li class="">
							<a href="#" class="text-right">Need Help?</a>
						</li>
						<li class="clearfix"></li>
					</ul>
				</form>
			</div>
		</div>
    </div>
</section>

</body>
<!-- //Body -->
</html>