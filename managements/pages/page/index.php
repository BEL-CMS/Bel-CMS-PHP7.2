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
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="block full">
		    <div class="block-title">
		        <h2><strong>Menu page</strong></h2>
		    </div>
			<?php
			foreach ($data as $key => $value):
			?>
			<tr>
				<a href="/page/getpage/<?=$value->id?>?management&page=true" class="btn btn-app">
					<span class="badge bg-red"><?=$value->count?></span>
					<i class="fa far fa-file-alt"></i> <?=$value->name?>
				</a>
			<?php
			endforeach;
			?>
		</div>
	</div>
</div>