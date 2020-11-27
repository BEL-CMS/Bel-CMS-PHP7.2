<?php
if (!empty($data)) {
?>
<section id="bel_cms_widgets_survey">
	<div id="bel_cms_widgets_survey_name"><?=$data->name?></div>
	<form action="Survey/send" method="post">
	<?php
	if ($count == true):
	foreach ($vote as $k => $v):
		?>
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<?php if(Users::isLogged()): ?>
					<input type="radio" aria-label="Radio button for following text input" name="vote" id="<?=$v->id?>" value="<?=$v->number?>">
					<?php endif; ?>
				</div>
			</div>
			<input type="text" class="form-control" disabled="disabled" aria-label="Text input with radio button" value="<?=$v->content?>">
		</div>

		<?php
	endforeach
	?>
	<br>
	<?php if(Users::isLogged()): ?>
	<input type="hidden" name="id" value="<?=$data->id?>">
	<button class="btn btn-primary">Envoyer</button>
	<?php endif; ?>
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
<?php
} else {
	Notification::infos('Aucun sondage en cours...', 'Sondage');
	?>
	<a style="display: block;text-align: center;" href="Survey">voir la liste des sondages</a>
	<?php
}
?>