<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
?>
<section class="section_bg" id="belcms_forum">
	<?php
	if (Users::getInfosUser($_SESSION['USER']['HASH_KEY']) !== false):
		?>
		<div class="headline">
			<div class="pull-right">
				<a data-toggle="tooltip" title="<?=NEW_THREAD?>" href="Forum/NewThread/<?=$id?>" class="btn btn-info btn-icon-left"><i class="fas fa-plus"></i> <?=NEW_THREAD?></a>
			</div>
		</div>
	<?php	
	endif;
	if (empty($threads)):
		Notification::infos('Aucun sujet disponible dans la base de données', 'Forum');
	else:
	?>
	<div class="forum">
		<h1 class="belcms_forum_h1"><?=$name->title?></h1>
		<table class="belcms_forum_table table table-bordered">
			<thead>
				<th>Titres</th>
				<th style="text-align: center;">infos</th>
				<th>Dernier post</th>
			</thead>
			<tr class="espace"></tr>
			<tbody>
			<?php
			foreach ($threads as $key => $value):
			?>
			<tr>
				<td>
					<a style="display: block;line-height: 15px;" href="Forum/Post/<?=$value->title?>/<?=$value->id?>"><?=$value->title?></a>
					 <span style="color: <?=Users::colorUsername($value->author)?>"><i class="fa fa-user-circle"></i> <?=Users::hashkeyToUsernameAvatar($value->author)?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?=Common::TransformDate($value->date_post, 'MEDIUM', 'SHORT')?></span>
				</td>
				<td>
					<span style="display: block;line-height: 15px; text-align: center;"><i class="fa fa-eye"></i> <?=$value->options['view']?></span>
					<span style="display: block;line-height: 35px; text-align: center;"><i class="fas fa-exchange-alt"></i> <?=$value->options['post']?></span>
				</td>
				<td>
					<span style="display: block;line-height: 15px;color: <?=Users::colorUsername($value->last->author)?>">Dernier message par <?=Users::hashkeyToUsernameAvatar($value->last->author)?></span>
					14 avr. 2021 à 00:33
				</td>
			</tr>
			<tr class="espace"></tr>
			<?php
			endforeach;
			?>
			</tbody>
		</table>
	</div>
</section>
<?php
	endif; ?>

