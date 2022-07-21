<section id="belcms_main_forum">
	<?php
	foreach ($forum as $k => $v):			
	?>
	<div id="belcms_main_cadre">
		<div class="container">
			<div class="row">
			<?php
			$count = (count($v->category));
			foreach ($v->category as $cat_k => $cat_v):
				debug($cat_v);
			?>
				<div class="col-4 belcms_cadre_content">
					<div class="row">
						<div class="belcms_cadre_title">
							<img src="https://img.freepik.com/photos-gratuite/perspective-exterieure-personne-boite-vide_1258-260.jpg?t=st=1658067322~exp=1658067922~hmac=26" alt="..." class="rounded-circle belcms_circle">

							<span class="belcms_main_forum_description">
								<h3><a href="Forum/Threads/<?=$cat_v->title?>/<?=$cat_v->id?>"><?=$v->title?></a></h3>
								<p><?=Common::truncate('This forum demonstrates different topic types (Stickies, attachments, polls, long posts etc...', 50);?></p>
							</span>
						</div>
					</div>
					<div class="row">
						<span class="spanHr"></span>
						<div class="col-4 align-center">
							<p class="belcms_main_content_p"><?=$cat_v->last->id;?></p>
							<p class="belcms_main_content_p">Topics</p>
						</div>
						<div class="col-4 align-center">
							<p class="belcms_main_content_p"><?=$cat_v->count?></p>
							<p class="belcms_main_content_p">Posts</p>
						</div>
						<div class="col-4 align-center">
							<p class="belcms_main_content_p">
								<?php if(empty($cat_v->last->date_post))
								{
									echo 'Aucun';
								} else {
									echo Common::TransformDate($cat_v->last->date_post, 'SHORT', 'NONE');
								}
								?>
								<p class="belcms_main_content_p">174</p>
							</p>
						</div>
					</div>
				</div>
			<?php
			endforeach;
			?>		
			</div>
		</div>
	</div>
	<?php
	endforeach;
	?>
</section>