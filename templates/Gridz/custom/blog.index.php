<ul class="content-list">
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
?>
<li>
    <div class="blog-details">
        <h2><a href="<?=$v->link;?>"><?=$v->name;?></a></h2>
        <?=$v->content?>
        <div class="bottom-active">
            <nav class="blog-meta">
                <span class="status">Date</span><a href="#"><span class="blog-meta-details"><?=Common::transformDate($v->date_create, 'FULL', 'NONE')?></span></a>
                <span class="status">By</span><a href="Members/View/<?=$v->username?>"><span class="blog-meta-details"><?=$v->username?></span></a>
            </nav>
            <a href="<?=$v->link;?>">
                <div class="readmore-button">
                    <span>Commentaire</span>
                </div>
            </a>
        </div>
    </div>
</li>
<?php
endforeach;
?>
</ul>
<?php
echo $pagination;
?>