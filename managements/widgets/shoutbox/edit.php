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
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="block">
            <div class="block-title">
                <h2><?=SHOUTBOX?></h2>
            </div>
			<form action="/shoutbox/sendedit?management&widgets=true" method="post" class="form-horizontal form-bordered">
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
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<input type="hidden" name="id" value="<?=$data->id?>">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=EDIT?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>