<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>

<div class="panel panel-white">
	<div class="panel-heading clearfix">
		<h4 class="panel-title"><?=MANAGEMENT_TITLE_NAME?></h4>
	</div>
	<div class="panel-body">
		<form action="parameter/send?management&page=true" method="post" class="form-horizontal">
			<?php echo $form; ?>
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
		</form>
	</div>
</div>
<?php
endif;
