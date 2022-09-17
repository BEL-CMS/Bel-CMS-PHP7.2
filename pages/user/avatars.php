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
	$list = array();
	$path = "uploads/users/".$user->hash_key."/";
	if ($dossier = opendir($path)):
	    while (($fichier = readdir($dossier)))
	    {
	        if ($fichier != '.' && $fichier != '..' && $fichier != 'index.php'):
	            $pattern = '/(gif|jpg|png)$/i';
	            $matche = preg_match($pattern, $fichier);
	            if ($matche):
	                $list[] = $fichier;
	           	endif;
	        endif;
	    }
	endif;
?>
<nav id="belcms_user_nav">
	<ul>
		<li>
			<a href="User">Mon Compte</a>
		</li>
		<li>
			<a href="User/modifications">Confidentialité</a>
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
		<div class="col-lg-12">
			<h2 id="user_h2">Mon Avatar</h2>
		</div>
		<form method="post" action="user/avatarsubmit">
			<table id="belcms_user_table" class="table">
			<?php
			foreach ($list as $avatar):
				?>
				<tr>
					<td><img style="width: 30px;height: 30px;" src="<?=$path.$avatar;?>"></td>
					<td><?=$path.$avatar;?></td>
					<td><input type="radio" name="avatar" value="<?=$path.$avatar;?>"></td>
				</tr>
				<?php
				endforeach;
				?>
				<tr><td colspan="3" align="center"><button type="submit" class="btn color-bg">Enregistrer avatar</button></td></tr>
				<input id="selectavatar" type="hidden" name="select" value="select">
			</table>
		</form>
		<hr>
		<form action="user/newavatar" method="post" enctype="multipart/form-data">
			<div class="input-group mb-3">
				<label class="input-group-text" for="avatar">Upload</label>
				<input type="file" name="avatar" class="form-control" id="avatar">
			</div>
			<button type="submit" class="btn color-bg">Enregistrer</button>
		</form>
	</div>
</div>

<?php
endif;