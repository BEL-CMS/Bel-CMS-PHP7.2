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