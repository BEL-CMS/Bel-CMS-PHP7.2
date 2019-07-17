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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="box-body">
	<a class="btn btn-app" href="User?management">
		<i class="fa fa-users"></i><?=USERS?>
	</a>
	<a class="btn btn-app" href="User/NewUser?management">
		<i class="fa fa-user-plus"></i><?=ADD?>
	</a>
	<a class="btn btn-app" href="User/Parameter?management">
		<i class="fa fa-cubes"></i><?=PARAMETER?>
	</a>
</div>

<div class="box">
	<div class="box-body">
		<table class="table table-bordered table-hover datatable">
			<thead>
				<tr>
					<th>ID</th>
					<th><?=NAME?></th>
					<th><?=MAIL?></th>
					<th><?=LAST_VISIT?></th>
					<th class="td-actions"> </th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data as $k => $v):
					?>
					<tr>
						<td><?=$v->id?></td>
						<td><?=$v->username?></td>
						<td><a href="mailto:<?=$v->email?>"><?=$v->email?></a></td>
						<td><?=$v->last_visit?></td>
						<td class="td-actions">
							<a href="User/Edit/<?=$v->hash_key?>?management" class="btn btn-success btntable">
								<i class="icon-pencil"> </i>
							</a>
							<a href="User/Del/<?=$v->hash_key?>?management" class="btn btn-danger btntable">
								<i class="icon-trash "> </i>
							</a>
						</td>
					</tr>
					<?php
				endforeach;
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
endif;
