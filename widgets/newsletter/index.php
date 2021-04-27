<div class="card-body">
		<div class="widget-newsletter">
			<div><span class="m-text">Abonnez-vous à la newsletter.</span></div>
			<form action="Newsletter/send" method="post">
				<input type="text" class="fullwidth" name="email" placeholder="Votre email...">
				<button style="width: 100%;" class="mt-1">Envoyer votre email</button>
				<div class="hint"><strong><?=$count?></strong> abonnés déjà</div>
			</form>
		</div>
	</div>
</div>