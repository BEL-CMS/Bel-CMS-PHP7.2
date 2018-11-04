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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="box-body">
	<a class="btn btn-app" href="Blog?management">
		<i class="fa fa-home"></i><?=BLOG?>
	</a>
	<a class="btn btn-app" href="Blog/NewBlog?management">
		<i class="fa fa-user-plus"></i><?=ADD?>
	</a>
	<a class="btn btn-app" href="Blog/Parameter?management">
		<i class="fa fa-cubes"></i><?=PARAMETER?>
	</a>
</div>

<div class="box">
	<div class="box-body">

		<table class="table table-bordered table-hover datatable">
			<thead>
				<tr>
					<th>#</th>
					<th><?=NAME?></th>
					<th><?=DATE?></th>
					<th><?=USERNAME?></th>
					<th class="td-actions"> </th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data as $k => $v):
					?>
					<tr>
						<td><?=$v->id?></td>
						<td><?=$v->name?></td>
						<td><?=$v->date_create?></td>
						<td><?=$v->author->username?></td>
						<td class="td-actions">
							<a href="Blog/Edit/<?=$v->id?>?management" class="btn btn-success btn-sm">
								<i class="icon-pencil"> </i>
							</a>
							<a href="Blog/Del/<?=$v->id?>?management" class="btn btn-danger btn-sm">
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
