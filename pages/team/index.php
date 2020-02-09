<section id="bel_cms_team">
	<?php
	foreach ($data as $k => $v):
	?>
	<div class="card mb-4">
		<?php
		if (!empty($v->img)):
		?>
			<img src="<?=$v->img?>" class="card-img-top" alt="<?=$v->name?>">
		<?php
		endif;
		?>
		<div class="card-body">
			<h5 class="card-title"><?=$v->name?></h5>
			<p class="card-text"><?=$v->description?></p>
		</div>
		<div class="card-footer">
			<ul>
				<?php
				foreach ($v->user as $key => $value):
				?>
				<li>
					<a class="simple-tooltip" title="<?=Users::hashkeyToUsernameAvatar($value->author)?>" href="Members/View/<?=Users::hashkeyToUsernameAvatar($value->author)?>">
						<img src="<?=Users::hashkeyToUsernameAvatar($value->author,'avatar')?>">
					</a>
				</li>
				<?php
				endforeach;
				?>
			</ul>
		</div>
	</div>
	<?php
	endforeach;
	?>
</section>