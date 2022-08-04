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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
$dirPages   = Common::ScanDirectory(DIR_PAGES);
$dirWidgets = Common::ScanDirectory(DIR_WIDGETS);
?>
<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Paramètres Styles : Pages </h3>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<th>Nom</th>
					<th>Options</th>
				</thead>
				<tbody>
					<?php
					foreach ($dirPages as $key => $value):
						if ($value == 'managements') {
							unset($dirPages[$key]);
							$name = null;
						} else {
							$name = Common::translate($value);
							?>
						<tr>
							<td><?=$name;?></td>
							<td>
								<a href="/styles/edit/<?=$value?>?management&templates" class="btn btn btn-primary btn-sm mb-1">Edition du style</a>
							</td>
						</tr>
							<?php
						}
					endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Paramètres Styles : Widgets </h3>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<th>Nom</th>
					<th>Options</th>
				</thead>
				<tbody>
					<?php
					foreach ($dirWidgets as $key => $value):
						$name = Common::translate($value);
						?>
						<tr>
							<td><?=$name;?></td>
							<td>
								<a href="/styles/editWidgets/<?=$value?>?management&templates" class="btn btn btn-primary btn-sm mb-1">Edition du style</a>
							</td>
						</tr>
						<?php
					endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
endif;