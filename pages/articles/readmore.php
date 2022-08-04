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
$countComment = Comment::countComments('articles', $articles->id);
?>
<article class="section_bg bel_cms_blog_readmore">
	<div class="card">
		<div class="card-header"><h1><?=$articles->name?></h1></div>
		<div class="card-body">
			<ul class="bel_cms_blog_userdate">
				<li><?=BY?> : <a href="Members/View/<?=$articles->username?>" title="<?=POST_BY?> <?=$articles->username?>"><?=$articles->username?></a></li>
				<li><?=DATE?> : <?=Common::transformDate($articles->date_create, 'FULL', 'NONE')?></li>
			</ul>
			<div class="bel_cms_blog_content">
				<?=$articles->content?>
				<br><hr>
				<?=$articles->additionalcontent?>
			</div>
		</div>
		<div class="card-footer">
			<ul class="bel_cms_blog_infos">
				<li><i class="ion-chatbox-working"></i> <?=$countComment?> <?=COMMENTS?></li>
				<li><i class="ion-ios-eye"></i> <?=$articles->view?> <?=SEEN?></li>
			</ul>
		</div>
	</div>
</article>
<?php
$comments = new Comment;
$comments->html();