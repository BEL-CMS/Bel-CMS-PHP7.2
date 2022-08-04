<div id="article-text" class="zui-section zui-space-b-30 article-content">
<?php
foreach ($blog as $k => $v):
    $countComment = Comment::countComments('blog', $v->id);
    if ($countComment == 0) {
        $comment = NO_COMMENT;
    } else if($countComment == 1) {
        $comment = '1 '.COMMENT;
    } else {
        $comment = $countComment.' '.COMMENTS;
    }
    $imgRender = array('a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'a9', 'a10', 'a11', 'a12', 'a13', 'a14', 'a15');
    $imgRender = array_rand($imgRender);
?>
	<div class="zui-section zui-space-b-20">
		<div class="inner">
			<div class="article-granite">
				<div class="zui-grid">
					<div class="col-sm-5 col-md-12 col-lg-5">
						<div class="article-image">
							<a href="templates/pwr_blog/assets/ph/a<?=$imgRender;?>.jpg" class="photo ajax" style="background-image: url(templates/pwr_blog/assets/ph/a<?=$imgRender;?>.jpg);"></a>
							<div class="post-date"><?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></div>
						</div>
					</div>
					<div class="col-sm-7 col-md-12 col-lg-7">
						<div class="details">
							<h2><a href="<?=$v->link;?>" class="ajax"><?=$v->name;?></a></h2>
							<?=$v->content?>
							<div class="zui-grid grid-middle">
								<div class="col-auto">
								</div>
								<div class="col-auto read-more">
									<a class="zui-button subtle small ajax" href="<?=$v->link;?>"><?=$comment;?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
endforeach;
echo $pagination;
?>
</div>
