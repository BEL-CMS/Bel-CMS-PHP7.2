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

$checkpdo = checkPDOConnect($_POST);
if ($checkpdo === true):
	BelCMS::TABLES();
?>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Installation BDD</h4></div>
			<div class="panel-body">
				<table class="table" id="install">
					<?php
					foreach (BelCMS::TABLES() as $k => $v):
						?>
						<tr>
							<td><?=$v?></td>
							<td id="<?=$v?>"><span class="glyphicon glyphicon-remove"></span></td>
						</tr>
						<?php
					endforeach;
					?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-6" id="error_bdd">
		<a id="submit_bdd" class="btn btn-primary" href="#">Installer</a>
	</div>
</div>
<?php
else:
?>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Erreur Configuration BDD</h4></div>
			<div class="panel-body">
				<?=$checkpdo;?>
			</div>
		</div>
	</div>
</div>
<?php
endif;
