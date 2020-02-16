<section id="bel_cms_widgets_survey">
	<div id="bel_cms_widgets_survey_name"><?=$data->name?></div>
	<form action="Survey/send" method="post">
	<?php
	if ($count == true):
	foreach ($vote as $k => $v):
		?>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="vote" id="<?=$v->id?>" value="<?=$v->number?>">
			<label class="form-check-label" for="<?=$v->id?>">
				<?=$v->content?>
			</label>
		</div>
		<?php
	endforeach
	?>
	<br>
	<input type="hidden" name="id" value="<?=$data->id?>">
	<button class="btn btn-primary">Envoyer</button>
	</form>
	<?php
	else:
	?>
	<ul>
	<?php
	foreach ($vote as $k => $v):
		?>
		<li><?=$v->content?><span><?=$v->vote?></span></li>
		<?php
	endforeach;
	?>
	</ul>
	<?php
	endif;
	?>
	<a href="Survey">voir la liste des sondages</a>
</section>