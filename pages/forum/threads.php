<div id="belcms_threads">
	<?php
	if (Users::getInfosUser($_SESSION['USER']['HASH_KEY']) !== false):
		?>
		<div class="headline">
			<div class="pull-right">
				<a data-toggle="tooltip" title="<?=NEW_THREAD?>" href="Forum/NewThread/<?=$id?>" class="btn btn-info btn-icon-left"><i class="fas fa-plus"></i> <?=NEW_THREAD?></a>
			</div>
		</div>
	<?php	
	endif;
	if (empty($threads)):
		Notification::infos('Aucun sujet disponible dans la base de données', 'Forum');
	else:
	?>
		<table  class="table">
			<tr>
				<th></th>
				<th>Thread</th>
				<th>Réponse</th>
				<th>Vu</th>
				<th>Dernier post</th>
			</tr>
			<?php
			foreach ($threads as $value) {
				?>
			<tr>
				<td></td>
				<td>
					<div>
						<a href="Forum/Post/<?=Common::MakeConstant($value->title)?>/<?=$value->id?>"><?=$value->title?></a>
					</div>
					<div><?=Users::hashkeyToUsernameAvatar($value->author)?></div>
				</td>
				<td>
					<?php
					echo $value->options['post'];
					?>
				</td>
				<td>
					<?php
					echo $value->options['view'];
					?>
				</td>
				<td>
					<div><span style="color: <?=Users::colorUsername($value->last->author)?>"><?=Users::hashkeyToUsernameAvatar($value->last->author)?></span></div>
					<div><?=Common::TransformDate($value->last->date_post, 'MEDIUM', 'SHORT')?></div>
				</td>
			</tr>
				<?php
			}
			?>
		</table>
<?php
	endif; ?>