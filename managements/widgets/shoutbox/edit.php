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

?>
<div class="col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><?=BLOG?></h4>
		</div>
		<div class="panel-body basic-form-panel">
			<form action="/shoutbox/sendedit?management&widgets=true" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label"><?=NAME?></label>
					<div class="col-sm-10">
						<input disabled="disabled" type="text" class="form-control" id="input-Default" value="<?=$data->username?>">
					</div>
				</div>
				<div class="form-group">
					<label for="input-Default" class="col-sm-2 control-label">Date du message</label>
					<div class="col-sm-10">
						<input disabled="disabled" type="datetime" class="form-control" id="input-Default" value="<?=$data->date_msg?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?=TEXT?></label>
					<div class="col-sm-10">
						<textarea class="bel_cms_textarea_simple" name="msg">
							<?=$data->msg?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$data->id?>">
					<button type="submit" class="btn btn-primary"><?=EDIT?></button>
				</div>
			</form>
		</div>
	</div>
</div>