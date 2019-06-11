<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
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
?>
<section id="bel_cms_forum_newthreads">
	<div class="card text-center">
		<div class="card-header">Nouveau sujet</div>
		<form action="Forum/SendNewPost/<?=$id?>" method="post" enctype="multipart/form-data">
			<div class="card-body">
				<input type="text" name="title" class="form-control" placeholder="Ajouter un titre">
				<hr>
				<textarea class="bel_cms_textarea_simple" name="content"></textarea>
			</div>
			<div class="card-footer">
				<input type="submit" class="btn btn-primary btn-lg btn-rounded btn-shadow" value="Poster">
			</div>
		</form>
	</div>
</section>