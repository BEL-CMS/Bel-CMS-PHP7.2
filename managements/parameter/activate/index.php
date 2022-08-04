<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<div class="row">
	<div class="col-md-6">
		<form action="activate/sendAddPages?management&parameter" method="post">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Activation Pages</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					  		<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<table class="DataTableBelCMS table table-bordered table-hover">
						<thead>
							<th>Nom</th>
							<th>Activation</th>
						</thead>
						<tbody>
							<?php
							foreach ($pages as $key => $value):
								$name = defined(strtoupper($value->name)) ? constant(strtoupper($value->name)) : $value->name;
								$name = $value->name == 'managements' ? 'Managements' : $name;
								if ($value->name == 'managements') {
									$checked = 'checked readonly';
								} else {
									if ($value->active == 0) {
										$checked = null;
									} else { 
										$checked = 'checked';
									}
								}
								?>
								<tr>
									<td><?=$name;?></td>
									<td>
										<div class="form-group">
											<div class="icheck-primary d-inline"></div>
											<input data-bootstrap-switch value="1" type="checkbox" name="<?=$value->name;?>" <?=$checked?>>
										</div>
									</td>
								</tr>
								<?php	
							endforeach;
							?>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><?=SAVE?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<form action="/activate/sendAddWidgets?management&parameter=true" method="post">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Activation Widgets</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					  		<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<table class="DataTableBelCMS table table-bordered table-hover">
						<thead>
							<th>Nom</th>
							<th>Activation</th>
						</thead>
						<tbody>
							<?php
							foreach ($widgets as $key => $value):
								$name = defined(strtoupper($value->name)) ? constant(strtoupper($value->name)) : $value->name;
									if ($value->active == 0) {
										$checked = null;
									} else { 
										$checked = 'checked';
									}
								?>
								<tr>
									<td><?=$name;?></td>
									<td>
										<div class="form-group">
											<div class="icheck-primary d-inline"></div>
											<input data-bootstrap-switch value="1" type="checkbox" name="<?=$value->name;?>" <?=$checked?>>
										</div>
									</td>
								</tr>
								<?php	
							endforeach;
							?>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><?=SAVE?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>