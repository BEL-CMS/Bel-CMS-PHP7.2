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
	<div class="row">
		<div class="col-md-12">
			<div class="block">
				<div class="block-title">
					<h2>Activities</h2>
				</div>
					<div class="table-responsive">
						<table class="DataTableBelCMS table table-vcenter table-condensed table-bordered">
						<tbody>
							<th>Auteur</th>
							<th>Type</th>
							<th>Date</th>
							<th>Avec</th>
						</tbody>
						<?php
						foreach ($data as $k => $v):
							?>
							<tr>
								<td><span style="color: <?=Users::colorUsername($v->author)?>"><?=Users::hashkeyToUsernameAvatar($v->author);?></span></td>
								<td><?=$v->text;?></td>
								<td><?=$v->date;?></td>
								<td>avec <?=$v->type;?></td>
							</tr>
							<?php
						endforeach;
						?>
						<thead>
							<th>Auteur</th>
							<th>Type</th>
							<th>Date</th>
							<th>Avec</th>
						</thead>
					</table>
				</div>
			</div>
		</div>

	</div>