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
<div class="card text-center">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item">
				<a class="nav-link" href="Code">Recherche</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Code/PHP">PHP</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="Code/HTML">HTML</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Code/CSS">CSS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Code/JS">JS</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<h5 class="card-title">Rechercher</h5>
		<form method="post" action="Code" class="form-inline">
			<div class="form-group">
				<label for="bel_cms_inbox_get">Recherche</label>
				<input name="text" id="bel_cms_inbox_get" type="text" class="form-control mx-sm-5">
				<small class="text-muted">3 lettres min</small>
			</div>

			<div class="form-group" class="col-md-6">
				<select name="type" class="custom-select my-1 mr-sm-3 mx-sm-5" id="inlineFormCustomSelectPref">
					<option value="html">HTML</option>
				</select>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Rechercher</button>
			</div>
		</form>
	</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nom</th>
			<th scope="col">Min Description</th>
			<th scope="col">Type</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $k => $v):
		?>
		<tr>
			<td><?=$v->id?></td>
			<td><a href="Code/Page/<?=$v->id?>/<?=$v->name?>/<?=$v->cat?>" title="><?=$v->name?>"><?=$v->name?></a></td>
			<td><?=$v->court?></td>
			<td><?=$v->cat?></td>
		</tr>
		<?php
		endforeach;
		?>
	</tbody>
</table>
<?php
echo $pagination;
?>