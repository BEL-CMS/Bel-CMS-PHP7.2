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
if (empty($data)):
	Notification::warning('Erreur dans la page, imposssible de l\'afficher');
else:
?>
<div id="belcms_subpage" class="card">
	<div class="card-header"><?=$data->name?></div>
	<div class="card-body">
		<?=$data->content?>
	</div>
	<div class="card-footer text-muted">
		<?=$data->publish?>
	</div>
</div>
<?php
endif;
