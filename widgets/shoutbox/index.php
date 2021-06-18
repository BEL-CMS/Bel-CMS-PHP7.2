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
	<div id="bel_cms_widgets_shoutbox" class="widget">
		<div class="widget-content">
			<ul id="bel_cms_widgets_shoutbox_msg">
				<?php
				$i = 1;
				if (count($shoutbox) != 0):
					foreach ($shoutbox as $k => $v):
						$i++;
						if ($i & 1) {
							$left_right =  'by_myself right';
						} else {
							$left_right =  'from_user left';
						}
						if (!empty($v->hash_key)) {
							$infosUser = Users::getInfosUser($v->hash_key);
							$username  = $infosUser[$v->hash_key]->username;
							$avatar    = empty($infosUser[$v->hash_key]->avatar) ? 'assets/images/default_avatar.jpg' : $infosUser[$v->hash_key]->avatar;
							$color     = Users::colorUsername($v->hash_key);
						} else {
							$username  = 'Inconnu';
							$avatar    = 'assets/images/default_avatar.jpg';
							$color     = '#000000';
						}

						$msg = ' ' . $v->msg;
						$msg = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3" onclick="window.open(this.href); return false;">\2.\3</a>', $msg);
						$msg = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $msg);
						$msg = preg_replace_callback('`((https?|ftp)://\S+)`', 'cesure_href',$msg);
						?>
						<li class="<?=$left_right?>" id="id_<?=$v->id?>">
							<a data-toggle="tooltip" title="<?=$username?>" href="Members/View/<?=$username?>" class="avatar">
								<img src="<?=$avatar?>">
							</a>
							<div class="message_wrap"> <span class="arrow"></span>
								<div class="info"> <a style="color: <?=$color?>" data-toggle="tooltip" title="<?=$username?>" href="Members/View/<?=$username?>" class="name"><?=$username?></a> <span class="time"><?=$v->date_msg?></span>
								</div>
								<div class="text"><?=Common::getSmiley($msg)?></div>
							</div>
						</li>
						<?php
					endforeach;
				endif;
				?>
			</ul>
		</div>
	<?php
	if (Users::isLogged()):
	?>
	<div class="card-footer text-muted">
		<form id="bel_cms_widgets_shoutbox_form" action="shoutbox/send&json" method="post">
			<div class="form-group" style="position: relative;">
				<input type="text" class="form-control" name="text" placeholder="Votre Message...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit"><?=SEND?></button>
			</div>
		</form>
	</div>
	<?php
	else:
	?>
	<div class="card-footer text-muted">
		<form id="Login" action="/user/sendLogin" method="post">
			<div class="form-group">
				<input name="username" required="required" autofocus="" type="text" class="form-control" id="inputEmail" placeholder="Email or username">
			</div>
			<div class="form-group">
				<input name="password" required="required" type="password" class="form-control" id="inputPassword" placeholder="Password">
			</div>
			<input type="hidden" name="send" value="login">
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
	<?php
	endif;
	?>
</div>
