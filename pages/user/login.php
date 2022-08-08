<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
exit(ERROR_INDEX);
}

if (Users::isLogged() === false):
?>
<!doctype html>
<html lang="fr">
	<head>
		<link href="/pages/user/css/login.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body id="LoginForm">
		<div class="container">
			<div class="login-form">
				<div class="main-div">
					<div class="panel">
						<h2>Login</h2>
						<p>Please enter your email or username and password</p>
					</div>
					<form id="Login" action="/user/sendLogin" method="post">
						<div class="form-group">
							<input name="username" required="required" autofocus="" type="text" class="form-control" id="inputEmail" placeholder="Email or username">
						</div>
						<div class="form-group">
							<input name="password" required="required" type="password" class="form-control" id="inputPassword" placeholder="Password">
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" name="remember" value="true" checked="checked">
									Remember me on this computer
							</label>
						</div>
						<div class="forgot">
							<a href="lostpassword&echo">Forgot password?</a>
						</div>
						<div class="nouser">
							<a href="register&echo">Don't have account?</a>
						</div>
						<input type="hidden" name="send" value="login">
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
endif;
?>
