<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if ($this->data):
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
						<h2>Register</h2>
						<p>Please enter your all information for the register</p>
					</div>
					<form id="Login" action="User/Send" method="post">
						<div class="form-group">
							<input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
						</div>
						<div class="form-group">
							<input name="username" type="text" class="form-control" id="inputEmail" placeholder="Username">
						</div>				
						<div class="form-group">
							<input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
						</div>
						<div class="form-group">
							<input name="passwordrepeat" type="password" class="form-control" id="inputPassword" placeholder="Repeat Password">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<?=$_SESSION['TMP_QUERY_REGISTER']['NUMBER_1']?> + 
									<?=$_SESSION['TMP_QUERY_REGISTER']['NUMBER_2']?>
								</div>
							</div>
							<input name="query_register" type="number" min="1" max="18" class="form-control" id="security-password" placeholder="Your Answer" autocomplete="off">
						</div>
						<div class="forgot">
							<a href="lostpassword&echo">Forgot password?</a>
						</div>
						<div class="nouser">
							<a href="Login&echo">You have account?</a>
						</div>
						<input type="hidden" name="send" value="register">
						<button type="submit" class="btn btn-primary">Register</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
endif;
?>
