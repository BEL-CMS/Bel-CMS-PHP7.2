<section id="belcms_main_forum">
	<?php
	foreach ($forum as $k => $v):
	?>
	<div class="belcms_main_body">
		<div class="belcms_main_forum_title">
			<h3><?=$v->title;?></h3>
		</div>
		<?php
		$count = (count($v->category));
		foreach ($v->category as $cat_k => $cat_v):
		?>
		<ul>
			<li>
				<table class="belcms_main_table">
					<tr>
						<td class="col-1 belcms_main_table_ico">
							<i class="<?=$cat_v->icon;?>"></i>
						</td>
						<td class="col-5">
							<span><a href="Forum/Threads/<?=$cat_v->title?>/<?=$cat_v->id?>"><?=$cat_v->title?></a></span><br>
							<span><?=$cat_v->subtitle;?></span>
						</td>
						<td class="col-2 belcms_main_table_posts">
							<span><strong><?=$cat_v->countPosts;?></strong></span><br>
							<span>Postes</span>
						</td>
						<?php
						if ($cat_v->countPosts === 0):
						?>
						<td class="col-4 belcms_main_table_last belcms_center">
							<span><?=NO_POST?></span>
						</td>
						<?php
						else:
						?>
						<td class="col-4 belcms_main_table_last">
							<span>Re: <a href="#"><?=$cat_v->last->title;?></a></span><br>
							<span>
								<a href="<?=$cat_v->last->author;?>">
									<?=Users::hashkeyToUsernameAvatar($cat_v->last->author)?>
								</a>
							</span><br>
							<span><?=Common::transformDate($cat_v->last->date_post, 'MEDIUM', 'MEDIUM')?></span>
						</td>
						<?php
						endif;
						?>
					</tr>
				</table>
			</li>
		</ul>
		<?php
		endforeach;
		?>
	<?php
	endforeach;
	?>
	</div>
</section>