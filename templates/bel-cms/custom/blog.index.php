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
debug($_SESSION);

?>
<div class="blog-post-preview v2">
<?php
foreach ($blog as $k => $v):
$countComment = Comment::countComments('blog', $v->id);
?>
	<div class="blog-post-preview-item">
		<div class="blog-post-preview-item-info">
			<p class="text-header big">
				<a href="<?=$v->link?>"><?=$v->name?></a>
			</p>
			<div class="meta-line">
				<a href="open-post.html">
					<p class="category primary">Infos</p>
				</a>
				<div class="metadata">
					<div class="meta-item">
						<span class="icon-bubble"></span>
						<p><?=$countComment?></p>
					</div>
					<div class="meta-item">
						<span class="icon-eye"></span>
						<p><?=$v->view?></p>
					</div>
				</div>
				<p><?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></p>
			</div>
			<p class="description-preview"><?=$v->content?></p>
			<a href="<?=$v->link?>" class="button dark-light more-button">Read More...</a>
		</div>
	</div>
<?php
endforeach;
echo $pagination;
?>
</div>