<div id="belcms_main">
	<?php
	foreach ($forum as $value) {
		echo '<h4>'.$value->title.'</h4>';
		?>
		<table class="table">
			<tr><th></th>
				<th>forum</th>
				<th>Threads</th>
				<th>Posts</th>
				<th>Last Post</th>
			</tr>
			<?php
			foreach ($value->category as $cat) {
				if (empty($cat->last->title)):
					$last = '<td style="padding="6"">Aucun sujet</td>';
				else:
					$last = '<td><table style="border: none !important; background-color: transparent !important;"><tr><td style="border: none !important;">'.$cat->last->title.'</td></tr><tr><td style="border: none !important;">Par : <span style="color: '.Users::colorUsername($cat->last->author).'">'.Users::hashkeyToUsernameAvatar($cat->last->author).'</span></td></tr><tr><td style="border: none !important;">'.$cat->last->date_post.'</td></tr></table>';
				endif;
				?>
				<tr>
					<td class="forum_table_ico"><i class="<?=$cat->icon;?>"></td>
					<td><div><a href="Forum/Threads/<?=Common::MakeConstant($cat->title)?>/<?=$cat->id?>"><?=$cat->title?></a></div>
						<div><?=$value->subtitle;?></div>
					</td>
					<td><?=$cat->countPosts;?></td>
					<td><?=$cat->count;?></td>
					<?=$last;?>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
?>
</div>