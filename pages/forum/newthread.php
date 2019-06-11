<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
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
<section id="bel_cms_forum_newthread">
	<form action="Forum/Send" method="post" enctype="multipart/form-data">
		<div class="card">
			<div class="card-header">
				<h3><?=NEW_THREAD?></h3>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<label for="thread" class="col-2 col-form-label"><?=TITLE_POST?></label>
					<div class="col-10">
						<input type="text" name="title" class="form-control" id="thread" placeholder="<?=ADD_A_TITLE?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="messagepost" class="col-2 col-form-label"><?=MESSAGE?></label>
					<div class="col-10">
						<textarea class="bel_cms_textarea_simple" name="content" id="messagepost"></textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<input type="hidden" name="send" value="NewThread">
				<input type="hidden" name="id" value="<?=$_SESSION['NEWTHREADS']?>">
				<input type="submit" class="btn btn-primary btn-lg btn-rounded btn-shadow" value="<?=SUBMIT_THREAD?>">
			</div>
		</div>
	</form>
</section>
