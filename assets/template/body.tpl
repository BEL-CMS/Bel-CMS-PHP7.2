		<!-- Page Content -->
		<div class="container" style="padding: 25px">

			<div class="row">
				<?php
				if ($fullpage === true):
				?>
				<div class="col-md-12">
				<?php
				echo $page;
				?>
				</div>
				<?php
				else:
				?>
				<div class="col-md-8">
					<?php
					echo $page;
					?>
				</div>
				<div class="col-md-4">
					<?php
					Widgets::GetAllWidgets('right');
					?>
				</div>
				<?php
				endif;
				?>
			</div>