<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}
if (Users::isLogged() === true):
?>
<nav id="belcms_user_nav">
	<ul>
		<li>
			<a href="User">Mon Compte</a>
		</li>
		<li>
			<a href="User/privacy">Confidentialité</a>
		</li>
		<li>
			<a href="User/secure">Sécurité</a>
		</li>
		<li>
			<a href="User/Avatars">Avatars</a>
		</li>
		<li>
			<a href="User/Social">Social</a>
		</li>
	</ul>
</nav>
<div class="content">
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-6 col-6">
			<div class="card">
				<a href="">
					<img id="user_img" src="<?=$user->avatar;?>">
				</a>
			</div>
		</div>
		<div class="col-lg-8 col-md-6 col-sm-6 col-6">
			<h2 id="user_h2">Mon Profile</h2>
			<div id="user_detail">
				<table id="belcms_user_table" class="table">
					<tr>
						<td>Pseudo</td>
						<td><?=$user->username;?></td>
					</tr>
					<tr>
						<td>Inscription</td>
						<td><?=$user->date_registration;?></td>
					</tr>
					<tr>
						<td>Activité</td>
						<td><?=$user->last_visit;?></td>
					</tr>
					<tr>
						<td>Anniversaire</td>
						<td><?=$user->birthday;?></td>
					</tr>
					<tr>
						<td>Mon IP</td>
						<td><?=$user->ip;?></td>
					</tr>	
				</table>
			</div>
		</div>
	</div>
</div>
<?php
endif;