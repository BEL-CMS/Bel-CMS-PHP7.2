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
<div id="bel_cms_inbox_show" class="card">
	<div class="card-header"><?=INBOX?></div>
	<div class="card-body">
		<header>
			<ul>
				<li>De : <?=$inbox[0]->origin->username?></li>
				<li>A : <?=$inbox[0]->to?></li>
				<li>Date : <?=$inbox[0]->date_msg?></li>
			</ul>
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
