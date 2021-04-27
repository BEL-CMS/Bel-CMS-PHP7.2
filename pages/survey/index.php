<section id="bel_cms_survey">
	<div class="card">
		<div class="card-header">Liste des sondages</div>
		<div class="card-body">
			<ul>
			<?php
			foreach ($data as $k => $v) {
			?>
				<li><?=$v->name?><span><img src="<?=$v->vote?>" alt="Color"></span></li>
			<?php
			}
			?>
			</ul>
		</div>
	</div>
	<div><img src="/pages/survey/img/green.png"> A voter <br><img src="/pages/survey/img/red.png"> Pas voter </div>
</section>

