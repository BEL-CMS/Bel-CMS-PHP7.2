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
<section id="bel_cms_blog_main">
<?php
foreach ($blog as $k => $v):
$countComment = Comment::countComments('blog', $v->id);
?>
<article class="bel_cms_blog">
	<div class="card">
		<div class="card-header"><h1><a href="<?php echo $v->link; ?>"><?=$v->name?></a></h1></div>
		<div class="card-body">
			<ul class="bel_cms_blog_userdate">
				<li><?=BY?> : <a href="Members/View/<?=$v->username?>" title="<?=POST_BY?> <?=$v->username?>"><?=$v->username?></a></li>
				<li><?=DATE?> : <?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></li>
			</ul>
			<div class="bel_cms_blog_content">
				<?=$v->content?>
			</div>
		</div>
		<div class="card-footer">
			<ul class="bel_cms_blog_infos">
				<li><i class="ion-chatbox-working"><?=$countComment?></i> <?=COMMENTS?></li>
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
echo $pagination;
?>
</section>
