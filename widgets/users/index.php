<?php
if (Users::isLogged()):
?>
<section id="bel_cms_widget_users">
	<div class="bel_cms_widget_users">
		<img src="<?=$user->avatar;?>" alt="avatar_<?=$user->username;?>">
	</div>
	<nav>
		<ul>
			<li>
				<a class="simple-tooltip" title="<?=PROFIL?>" href="User/Profil"><i class="fas fa-chalkboard-teacher"></i></a>
			</li>
			<li>
				<a class="simple-tooltip" title="<?=MESSAGING_PRIVATE?>" href="Inbox"><i class="fas fa-envelope"></i></a>
			</li>
			<li>
				<a class="simple-tooltip" title="<?=ADMIN?>" href="?admin"><i class="fas fa-user-cog"></i></a>
			</li>
		</ul>
	</nav>
</section>
<?php
else:
?>
<section id="bel_cms_widget_users">
	<form id="Login" action="user/sendLogin" method="post">
		<div>
			<i class="fas fa-lock-open"></i> Connexion identifiant
		</div>
		<div class="login-form">
			<div class="main-div">
				<div class="panel">
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
						<a href="user/lostpassword&echo">Forgot password?</a>
					</div>
					<div class="nouser">
						<a href="User/register&echo">Don't have account?</a>
					</div>
					<input type="hidden" name="send" value="login">
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	</form>
</section>
<?php
endif;