<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.2.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2023 Bel-CMS
 * @author as Stive - stive@determe.be
 */
?>
<form action="?page=finish" method="post">
	<div class="row">
		<div class="col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><h4>Compte Administrateur</h4></div>
				<div class="panel-body">
					<label for="serversql">Nom d'utilisateur</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">Username</span>
						<input name="username" required="required" type="text" class="form-control" id="serversql" aria-describedby="basic-addon3">
					</div>
					<label for="email">Adresse E-Mail</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">E-mail</span>
						<input name="email" required="required" type="text" class="form-control" id="email" aria-describedby="basic-addon3">
					</div>
					<label for="password">Mot de passe</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">Password</span>
						<input name="password" required="required" type="password" class="form-control" id="password" aria-describedby="basic-addon3">
					</div>
					<div class="input-group">
						<input class="btn btn-primary" type="submit" value="Suivant">
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
