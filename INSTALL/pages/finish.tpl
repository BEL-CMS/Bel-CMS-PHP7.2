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

$insert = insertUserBDD();
?>
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-body">
				<?php if ($insert === true): ?>
				<p>Votre installation s'est, à priori, bien déroulée</p>
				<p>Merci de nous en faire part sur <a href="http://bel-cms.dev" title="BEL-CMS">bel-cms.dev</a> si vous avez rencontre le moindre souci lors de l'installation</p>
				<?php else: ?>
				<p><?=$insert?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php if ($insert === true): ?>
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-danger" role="alert">Veuillez supprimer le dossier INSTALL de votre FTP</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-success" role="alert">Redirection automatique dans 5s</div>
			</div>
		</div>
	</div>
</div>
<?php

rmAllDir(ROOT.DS.'INSTALL');

if (!isset($_SESSION)) {
	session_start();
} else {
	$_SESSION = array();
}
$_SESSION = array();
$_SESSION['INSTALL'] = true;
redirect(GetHost::getBaseUrl(), 5);
endif;
