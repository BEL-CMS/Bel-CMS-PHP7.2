<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<h5>Liste des utilisateurs de la newsletter</h5>
<ul class="list-group">
	<?php
	foreach ($data as $b):
		?>
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<?=Users::hashkeyToUsernameAvatar($b->name)?>
			<span class="badge badge-primary badge-pill"><?=$b->sendmail?></span>
		</li>
		<?php
	endforeach;
	?>
</ul>