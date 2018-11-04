<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
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
<section id="bel_cms_blog_main">
<?php
foreach ($blog as $k => $v):
$count_comment = new Comment('count', 'blog','readmore', $v->id);
$count_comment = $count_comment->count;
?>
<article class="bel_cms_blog">
	<div class="card">
		<div class="card-header"><h1><a href="<?php echo $v->link; ?>"><?=$v->name?></a></h1></div>
		<div class="card-body">
			<ul class="bel_cms_blog_userdate">
				<li><?=BY?> : <a href="Members/View/<?=$v->author->username?>" title="<?=POST_BY?> <?=$v->author->username?>"><?=$v->author->username?></a></li>
				<li><?=DATE?> : <?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></li>
			</ul>
			<div class="bel_cms_blog_content">
				<?=$v->content?>
			</div>
		</div>
		<div class="card-footer">
			<ul class="bel_cms_blog_infos">
				<li><i class="ion-chatbox-working"></i> <?=$count_comment?> <?=COMMENTS?></li>
				<li><i class="ion-ios-eye"></i> <?=$v->view?> <?=SEEN?></li>
				<li class="bel_cms_blog_infos_last">
					<a class="btn btn-primary" href="<?=$v->link?>"><i class="ion-link"></i> <?=READ_MORE?></a>
				</li>
			</ul>
		</div>
	</div>
</article>
<?php
endforeach;
?>
<?=$pagination?>
</section>
