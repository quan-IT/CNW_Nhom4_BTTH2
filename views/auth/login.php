<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/'; ?>">
  <title>Login V1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome CDN (THAY THẾ DÒNG CŨ) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- Vendor CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/login/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/login/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/login/vendor/select2/select2.min.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
</head>
<body>
	<div style="padding: 20px; background: white;">
  <h3>Icon Test:</h3>
  
  <!-- Font Awesome Icons -->
  <p>Font Awesome:
    <i class="fa fa-envelope"></i>
    <i class="fa fa-lock"></i>
    <i class="fa fa-user"></i>
  </p>
  
  <!-- Bootstrap Icons -->
  <p>Bootstrap Icons:
    <i class="b bi-envelope"></i>
    <i class="bi bi-lock"></i>
    <i class="bi bi-person"></i>
  </p>
</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/css/login/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<xi class="fa fa-envelope"></xi>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="assets/css/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/css/login/bootstrap/js/popper.js"></script>
	<script src="assets/css/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/css/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/css/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/login/login.js"></script>

</body>
</html>