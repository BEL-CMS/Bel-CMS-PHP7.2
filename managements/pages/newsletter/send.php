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
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/newsletter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="newsletter/parameter?management&page=true" class="btn btn-app">
			<i class="fa fas fa-cogs"></i> Configuration
		</a>
		<a href="/newsletter/tpl?management&page=true" class="btn btn-app">
			<i class="fa far fa-newspaper"></i> Templates
		</a>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-body">
			<div class="table-responsive">
				<table id="datatableDl" class="table table-striped jambo_table bulk_action">
					<thead>
						<tr>
							<th># ID</th>
							<th>Auteur</th>
							<th>Send Ok</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th># ID</th>
							<th>Auteur</th>
							<th>Send Ok</th>
						</tr>
					</tfoot>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>