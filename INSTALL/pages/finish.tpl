<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */
$insert = insertUserBDD();
?>
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-body">
				<?php if ($insert === true): ?>
				<p>Votre installation s'est, à priori, bien déroulée</p>
				<p>Merci de nous signaler sur <a href="http://bel-cms.be" title="BEL-CMS">bel-cms.be</a> si vous avez rencontre le moindre souci lors de l'installation</p>
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
