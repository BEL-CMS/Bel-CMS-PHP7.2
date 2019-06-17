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
<div id="bel_cms_inbox_show" class="card">
	<div class="card-header"><?=INBOX?></div>
	<div class="card-body">
		<header>
			<img src="<?=$inbox[0]->origin->avatar?>" alt="avatar_user_<?=$inbox[0]->origin->username?>" class="rounded-circle">
			<span><?=$inbox[0]->origin->username?></span>
		</header>
		<?php
		foreach ($inbox as $k => $v):
			$class = $v->username == $_SESSION['USER']['HASH_KEY'] ? 'bel_cms_inbox_show_msg' : 'bel_cms_inbox_show_msg_other';
		?>
		<div class="<?=$class?>">
			<span class="bel_cms_inbox_show_msg_date"><?=$v->date_msg?></span>
			<div class="bel_cms_inbox_show_msg_current">
				<?=$v->message?>
			</div>
		</div>
		<?php
		endforeach;
		?>
	</div>
	<div class="card-footer">
		<form method="post" id="bel_cms_inbox_form_new" action="inbox/send">
			<div id="bel_cms_inbox_form_new_body">
				<div class="form-group">
					<textarea class="bel_cms_textarea_inbox" name="message" placeholder="<?=ENTER_MESSAGE?>"></textarea>
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="<?=$inbox[0]->id_msg?>">
					<input type="hidden" name="send" value="reponse">
					<button type="submit" class="btn btn-primary"><?=REPLY?></button>
				</div>
			</div>
		</form>
	</div>
</div>
