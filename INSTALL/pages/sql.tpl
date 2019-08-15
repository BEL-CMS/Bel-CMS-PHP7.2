<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */
?>
<form action="?page=checkslq_start" method="post">
	<div class="row">
		<div class="col-sm-6">

			<div class="panel panel-default">
				<div class="panel-heading"><h4>Configuration BDD</h4></div>
				<div class="panel-body">
					<label for="serversql">Serveur Mysql</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">localhost</span>
						<input name="serversql" required="required" type="text" class="form-control" id="serversql" aria-describedby="basic-addon3">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Il s'agit ici de l'adresse du serveur MySQL de votre hébergement.</div>
					<hr>
					<label for="prefix">Prefix</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">belcms_</span>
						<input name="prefix" type="text" class="form-control" id="prefix" aria-describedby="basic-addon3" value="belcms_">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Le prefix permet d'installer plusieurs fois BEL-CMS ou autres sur une seule base MySQL en utilisant un prefix différent à chaque fois, vous pouvez le laisser vide.</div>
					<hr>
					<label for="port">Port</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">3306</span>
						<input value="3306" name="port" required="required" type="text" class="form-control" id="port" aria-describedby="basic-addon3">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Il s'agit du port utiliser de votre base de donnée MySQL.</div>
					<hr>
				</div>
			</div>

		</div>
		<div class="col-sm-6">

			<div class="panel panel-default">
				<div class="panel-heading"><h4>Configuration BDD</h4></div>
				<div class="panel-body">
					<label for="name">Nom de la Base</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">BDD</span>
						<input name="name" required="required" type="text" class="form-control" id="name" aria-describedby="basic-addon3">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Il s'agit du nom de votre base de données MySQL, souvent vous devez vous rendre dans l'administration de votre hébergement pour créer une base de données, mais parfois celle-ci vous est déjà fournie dans le mail d'inscription de votre hébergement.</div>
					<hr>
					<label for="user">Utilisateur</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">root</span>
						<input name="user" required="required" type="text" class="form-control" id="user" aria-describedby="basic-addon3">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Il s'agit de votre identifiant qui vous permet de vous connecter à votre base MySQL.</div>
					<hr>
					<label for="password">Mot de passe</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">*****</span>
						<input name="password" type="password" class="form-control" id="password" aria-describedby="basic-addon3">
					</div>
					<div class="margin_top_2 alert alert-info alert-dismissable">Il s'agit du mot de passe de votre identifiant qui vous permet de vous connecter à votre base de donnée MySQL.</div>
					<hr>
					<div class="input-group">
						<input class="btn btn-primary" type="submit" value="Suivant">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
