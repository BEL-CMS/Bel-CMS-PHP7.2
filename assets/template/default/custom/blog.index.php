<?php
foreach ($blog as $k => $v):
	$countComment = Comment::countComments('blog', $v->id);
	if ($countComments == 0) {
		$comment = NO_COMMENT;
	} else if($countComments == 1) {
		$comment = '1 '.COMMENT;
	} else {
		$comment = $countComments.' '.COMMENTS
	}
?>
<article>
	<h2><?=$v->name?></h2>
	<div class="article_infos">→ <?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></div>
	<div class="article_content"><?=$v->content?></div>
	<div class="article_meta">
		<i class="fas fa-user"></i>  Posted By: <a href="#">Stive</a>
		<div class="article_comment"><a href="<?php echo $v->link; ?>"><i class="fas fa-comments"></i> <?=$comment?></a></div>
	</div>
</article>
<?php
endforeach;
echo $pagination;
?>