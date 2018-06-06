<?php
if (isset($msg)) {
	$pesan = '<div class="alert alert-danger">'.$msg.'</div>';
} else {
	$pesan = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo BASE_PATH; ?>assets/ico/icon.png">
	<title>Content Management System</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo BASE_PATH; ?>assets/css/bootstrap.css" rel="stylesheet">

	<!-- font awesome -->
	<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/font-awesome.min.css" />

	<!-- Custom Styles -->
	<link href="<?php echo BASE_PATH; ?>assets/css/tema_login.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div id="particles-js"></div>
	<div class="content-login">
		<div class="text-center">
		<!-- <img src="<?php echo BASE_PATH; ?>assets/images/logo.png" width="350px" border="0" class="img-responsive" style="margin: 10px auto;" /> -->
			
			<form class="form-signin" action="<?php echo BASE_URL; ?>login/check" method="post">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-header">LOGIN</h2>
						<?php echo $pesan; ?>
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-user"></span></span>
							<input name="username" type="text" autofocus class="form-control" id="username" placeholder="Username">
						</div>
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-lock"></span></span>
							<input name="password" type="password" class="form-control" id="pass" placeholder="Password">
						</div>
						
						<!-- <div class="text-center"><img class="captcha" src="includes/captcha2/captcha.php" id="captcha" /></div> -->

						<!-- <div class="input-group">
							<span class="input-group-addon"><span class="fa fa-key"></span></span>
							<input type="text" name="captcha" id="captcha-form" class="input-teks" autocomplete="off" placeholder="Captcha"/>
						</div> -->
						<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
						<input name="kirim" type="hidden" value="kirim" />
					</div>
				</div>
			</form>
		</div>

	<!-- /container -->
	</div>

	<!-- jquery -->
	<script  type="text/javascript" src="<?php echo BASE_PATH; ?>assets/js/jquery.js"></script>
	<script  type="text/javascript" src="<?php echo BASE_PATH; ?>assets/js/particles.min.js"></script>
	<script  type="text/javascript" src="<?php echo BASE_PATH; ?>assets/js/app.js"></script>
</body>
</html>