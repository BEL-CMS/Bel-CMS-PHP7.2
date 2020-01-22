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
<div class="card text-center">
	<div class="card-header">
		<h3><?=$data->name?></h3>
	</div>
	<div class="card-body">
		<?=$data->content?>
	</div>
	<div class="card-footer text-muted">
		<?=$data->publish?>
	</div>
</div>
