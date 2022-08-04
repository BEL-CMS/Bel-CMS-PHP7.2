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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if ($last !== null):
?>
<div id="bel_cms_widgets_lastconnected" class="widget">
	<ul>
	<?php
	foreach ($last as $k => $v):
		?>
		<li>
			<img data-toggle="tooltip" title="<?=$v->username?>" src="<?=$v->avatar?>" alt="avatar_<?=$v->username?>" style="max-width: 50px; max-height: 50px;">
			<span>
				<p style="color: <?=Users::colorUsername(null,$v->username)?>"><?=$v->username;?></p>
				<p><?=Common::transformDate($v->last_visit, 'MEDIUM', 'SHORT') ?></p>
			</span>
		</li>
	<?php
	endforeach;
	?>
	</ul>
</div>
<?php
endif;
