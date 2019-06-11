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
				<a href="User/Profil"><i class="fas fa-chalkboard-teacher"></i> Profil</a>
			</li>
			<li>
				<a href="Inbox"><i class="fas fa-envelope"></i> Boîte de réception</a>
			</li>
			<li>
				<a href="Dashboard?Management"><i class="fas fa-user-cog"></i> Managements</a>
			</li>
		</ul>
	</nav>
</section>
<?php
else:
?>
<section id="bel_cms_widget_users">
	<div class="bel_cms_widget_users">
		<img src="assets/images/default_avatar.jpg" alt="avatar_default">
	</div>
	<form id="Login" action="user/sendLogin" method="post">
		<div class="form-row align-items-center">
			<div class="col-auto" style="width: 100%;">
				<div class="input-group">
					<input name="username" required="required" autofocus="" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Nom D'utilisateur">
				</div>
			</div>
			<div class="col-auto" style="width: 100%;">
				<div class="input-group">
					<input name="password" required="required" type="password" class="form-control" id="inlineFormInputGroup" placeholder="Mot de passe">
				</div>
			</div>
			<div class="col-auto" style="width: 100%;">
				<input type="hidden" name="send" value="login">
				<button type="submit" class="btn btn-primary mb-2" style="width: 100%;">Login</button>
			</div>
		</div>
	</form>
</section>
<?php
endif;