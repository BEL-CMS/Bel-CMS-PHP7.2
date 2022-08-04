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
?>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Liste des full pages</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form action="/themes/sendpages?management&templates" method="post">
				<table class="table table-vcenter table-bordered">
					<thead>
						<tr>
							<th><?=PAGE_FULL_WIDE;?></th>
							<th><?=ACTIVATE?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($scan as $k => $n):
							if ($n == 'managements') {
								unset($scan[$k]);
								$name = null;
							}
							$chcked = in_array($n, $pages) ? 'checked="checked"': '';
							$name = defined(strtoupper($n)) ? constant(strtoupper($n)) : $n;
						?>
						<tr>
							<td><?=$name?></td>
							<td>
								<input <?=$chcked?> type="checkbox" name="full[]" data-bootstrap-switch data-off-color="danger" data-on-color="success" value="<?=$n?>">
							</td>
						</tr>
						<?php
						endforeach;
						?>
						<tr>
							<td>Articles Readmore</td>
							<td>
								<input checked="checked" type="checkbox" name="full[]" data-bootstrap-switch data-off-color="danger" data-on-color="success" value="readmore">
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;
?>




