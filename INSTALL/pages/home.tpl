<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.1
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */
?>
<div class="row">
	<div class="col-sm-6">

		<div class="panel panel-default">
			<div class="panel-heading"><h4>Bienvenue</h4></div>
			<div class="panel-body">
				<p>Bienvenue sur l'installation de BEL-CMS 2.0.0</p>
				<p>Nous vous remercions d'avoir choisi notre CMS, en espérant qu'il vous plaira, n'hésitez pas à poster sur le forum pour demander des nouveautés.</p>
				<hr>
				<?php

				?>
				<hr>
			</div>
		</div>

	</div>

	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Compatibilité avec votre hébergement</h4></div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Composant</th>
							<th>Check</th>
						</tr>
					</thead>
					<tbody>
						<?php $php_class = checkPhp() === false ? 'class="danger"' : ''; ?>
						<?php $php_ico   = checkPhp() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$php_class?>>
							<td>PHP version ≥ 7.0.3</td>
							<td><span class="<?=$php_ico?>"></span></td>
						</tr>
						<?php $sqli_class = checkMysqli() === false ? 'class="danger"' : ''; ?>
						<?php $sqli_ico   = checkMysqli() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$sqli_class?>>
							<td>Extension MySQL</td>
							<td><span class="<?=$sqli_ico?>"></span></td>
						</tr>
						<?php $rewrite_class = checkRewrite() === false ? 'class="danger"' : ''; ?>
						<?php $rewrite_ico   = checkRewrite() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$rewrite_class?>>
							<td>Mod Rewrite</td>
							<td><span class="<?=$rewrite_ico?>"></span></td>
						</tr>

						<?php $intl_class = checkIntl() === false ? 'class="danger"' : ''; ?>
						<?php $intl_ico   = checkIntl() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$rewrite_class?>>
							<td>IntlDateFormatter (intl)</td>
							<td><span class="<?=$intl_ico?>"></span></td>
						</tr>

						<?php $pdo_class = checkPDO() === false ? 'class="danger"' : ''; ?>
						<?php $pdo_ico   = checkPDO() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$pdo_class?>>
							<td>PDO Driver</td>
							<td><span class="<?=$pdo_ico?>"></span></td>
						</tr>
						<?php $config = checkWriteConfig() === false ? 'class="danger"' : ''; ?>
						<?php $config_ico   = checkWriteConfig() === false ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok'; ?>
						<tr <?=$config?>>
							<td>Write /config</td>
							<td><span class="<?=$config_ico?>"></span></td>
						</tr>
						<?php
						if (checkWriteConfig() === false) {
						?>
						<tr>
							<td colspan="2">
								<div class="alert alert-danger" role="alert">Veuillez mettre le dossier /config && /uploads en chmod 777</div>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			<hr>
			</div>
		</div>
	</div>

<div class="row">
	<div class="col-sm-12">
		<?php
		if (checkPhp() && checkRewrite() !== false && checkPDO()) {
			echo '<p><a class="btn btn-primary btn-lg" href="?page=sql" role="button">Installer</a></p>';
		} else {
			echo '<div class="alert alert-danger" role="alert">Votre Hébérgeur n\'est pas compatible avec le C.M.S</div>';
			echo '<p><a class="btn btn-primary btn-lg" href="?page=sql" role="button">Forcer Installalation</a></p>';
		}
		?>
	</div>
</div>

	<div class="clearfix"></div>
</div>
