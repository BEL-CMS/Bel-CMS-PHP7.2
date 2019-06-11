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

if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
	$username = AutoUser::getNameAvatar($this->data->hash_key);
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-table action-table">
						<div class="widget-header">
							<i class="icon-user"></i>
							<h3><?=SHOUTBOX?></h3>
						</div>
						<div class="widget-content">
							<div class="tab-pane active" id="formcontrols">
								<br>
								<form action="/shoutbox/send/<?=$this->data->id?>?management" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>

										<div class="control-group">
											<label class="control-label" for="username"><?=USERNAME?></label>
											<div class="controls">
												<input class="span6 disabled" id="username" value="<?=$username->username?>" disabled="disabled" type="text">
												<p class="help-block">the username can not be changed.</p>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="date"><?=DATE?></label>
											<div class="controls">
												<input class="span6 disabled" id="date" value="<?=$this->data->date_msg?>" disabled="disabled" type="date">
												<p class="help-block">the date can not be changed.</p>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="date"><?=MESSAGE?></label>
											<div class="controls">
												<textarea style="overflow: none;resize: vertical;word-wrap:normal;" class="span6" wrap="hard" cols="30" rows="5" name="msg"><?=$this->data->msg?></textarea>
											</div>
										</div>

									</fieldset>

									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="<?=SAVE?>">
										<a href="shoutbox?Management" class="btn"><?=CANCEL?></a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
endif;
