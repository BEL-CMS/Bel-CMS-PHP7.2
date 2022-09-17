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

if (!defined('CHECK_INDEX')):
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
endif;
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
<form action="user/sendsecurity" method="post">
	<div class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom: 20px;">
				<h2 id="user_h2"><?=MODIFICATION;?></h2>
				<div id="user_detail">
					<table id="belcms_user_table" class="table">
						<tr>
							<td>Mot de passe</td>
							<td><input name="password_old" type="password" placeholder="Entrer votre ancien mot de passe." value=""></td>
						</tr>
						<tr>
							<td>Mot de passe</td>
							<td>
								<input placeholder="Nouveau mot de passe" name="password_new" type="text" class="form-control" value="" rel="gp" data-character-set="a-z,A-Z,0-9,#" data-size="6">
							</td>
						</tr>>
					</table>
				</div>
			</div>
		</div>
	</div>
	<button type="button" class="btn btn-primary getNewPass">Générateur</button>
	<button type="submit" class="btn btn-primary">Enregistrer</button>
</form>	