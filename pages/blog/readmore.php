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
$comment = new Comment('view', 'blog','readmore', $blog->id);
$count_comment = new Comment('count', 'blog','readmore', $blog->id);
$count_comment = $count_comment->count;
?>
<article class="bel_cms_blog_readmore">
	<div class="card">
		<div class="card-header"><h1><?=$blog->name?></h1></div>
		<div class="card-body">
			<ul class="bel_cms_blog_userdate">
				<li><?=BY?> : <a href="Members/View/<?=$blog->author->username?>" title="<?=POST_BY?> <?=$blog->author->username?>"><?=$blog->author->username?></a></li>
				<li><?=DATE?> : <?=Common::transformDate($blog->date_create, 'FULL', 'NONE')?></li>
			</ul>
			<div class="bel_cms_blog_content">
				<?=$blog->content?>
			</div>
		</div>
		<div class="card-footer">
			<ul class="bel_cms_blog_infos">
				<li><i class="ion-chatbox-working"></i> <?=$count_comment?> <?=COMMENTS?></li>
				<li><i class="ion-ios-eye"></i> <?=$blog->view?> <?=SEEN?></li>
			</ul>
		</div>
	</div>
</article>
<?=$comment->html?>
