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
<div id="bel_cms_inbox_index" class="card">
	<div class="card-header"><?=INBOX?></div>
	<div class="card-body">
		<div id="bel_cms_inbox_index_left" class="row">
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<button type="button" class="btn btn-primary"><?=TO_WRITE?></button>
					</div>
					<select class="custom-select" id="inputGroupSelect01">
						<option value="all" selected><?=ALL_MESSAGE?></option>
					</select>
				</div>
				<hr>
				<div class="list-group">
					<?php
					inboxLastMsg($inbox);
					?>
				</div>
			</div>
			<div id="bel_cms_inbox_index_right" class="col-8">
				<?php
				inboxFormNew ();
				?>
			</div>
		</div>
	</div>
</div>

<?php
function inboxLastMsg($inbox)
{
	foreach ($inbox as $v):
?>
		<a href="Inbox/ShowMessage/<?=$v->id?>" class="list-group-item list-group-item-action flex-column align-items-start bel_cms_inbox_show">
			<div class="d-flex w-100 justify-content-between">
				<h5 class="mb-1"><?=$v->lastmessage->username?></h5>
				<small><?=Common::TransformDate($v->lastmessage->date_msg, 'MEDIUM', 'SHORT')?></small>
			</div>
			<p class="mb-1" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">
				<?=$v->lastmessage->message?>
			</p>
		</a>
<?php
	endforeach;
}
function inboxFormNew ()
{
?>
	<form method="post" id="bel_cms_inbox_form_new" action="inbox/send">
		<header>
			<i class="fa fa-user-circle"></i>
			<span><?=NEW_MESSAGE?></span>
		</header>
		<div id="bel_cms_inbox_form_new_body">
			<div class="form-group">
				<input type="text" name="username" class="form-control" id="bel_cms_inbox_get_users" placeholder="<?=ENTER_USERNAME?>">
			</div>
			<div class="form-group">
				<textarea class="bel_cms_textarea_inbox" name="message" placeholder="<?=ENTER_MESSAGE?>"></textarea>
			</div>
			<div class="form-group">
				<input type="hidden" name="send" value="new">
				<button type="submit" class="btn btn-primary"><?=TO_SEND?></button>
				<button id="delete_inbox_message" type="button" class="btn btn-link"><?=DELETE_TO_MSG?></button>
			</div>
		</div>
	</form>
<?php
}
