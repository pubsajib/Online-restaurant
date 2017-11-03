<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo BASE_URL?>/assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- simple line icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    
    <!-- custom style -->
    <link href="<?php echo BASE_URL?>/assets/admin/custom-style.css" rel="stylesheet" type="text/css">


    <!-- jQuery -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo BASE_URL?>/assets/admin/dist/js/sb-admin-2.js"></script>

</head>

<body>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">
						<!--warning-->
						<div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						</div>
						<div class="alert alert-danger alert-dismissible" role="alert" <?php if (!isset($_SESSION['error'])) {?>style="display: none;" <?php } ?>>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php if (isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error'])?>
						</div>
						<!--warning end-->

						<form id="form_login" action="<?php echo BASE_URL?>/admin-login" method="post" role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /#wrapper -->
	<script>
		$(function () {
			$('#form_login').submit(function (ev) {
				ev.preventDefault();
				console.log('clicked');
				var email = $('input[name="email"]').val();
				var password = $('input[name="password"]').val();
				//console.log(email);return;
				var validate = '';
				if (email == '') {
					validate += 'Email is required';
				}
				if (password == '') {
					validate += '<br>Password is required';
				}

				//console.log(validate);return;
				if (validate != '') {
					$('.alert-success').hide();
					$('.alert-danger').show();
					$('.alert-danger').html(validate);
					setTimeout(function () {
						$('.alert-danger').hide();
					}, 3000);
				} else {
					$(this)[0].submit();
				}
			})
		})
	</script>
</body>
</html>
