<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}
if (Users::isLogged() === true):
?>
<section id="belcms_main_managements">
	<div id="belcms_main_user_left_avatar">
		<img src="<?=$user->avatar?>" alt="Avatar_<?=$user->username?>">
		<div id="belcms_main_user_left_username"><?=$user->username?></div>
	</div>
	<div id="belcms_main_managements_left">
		<nav id="belcms_main_user_left_menu">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<?php
				if (Users::isSuperAdmin()):
				?>
				<a class="nav-link active" id="v-pills-prefGeneral-tab" data-toggle="pill" href="#v-pills-prefGeneral" role="tab" aria-controls="v-pills-prefGeneral" aria-selected="true">Gestion Générales
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-prefMembers-tab" data-toggle="pill" href="#v-pills-prefMembers" role="tab" aria-controls="v-pills-prefMembers" aria-selected="false">Gestion des membres
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-page-tab" data-toggle="pill" href="#v-pills-page" role="tab" aria-controls="v-pills-page" aria-selected="false">Gestions des pages
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-tpl-tab" data-toggle="pill" href="#v-pills-tpl" role="tab" aria-controls="v-pills-tpl" aria-selected="false">Gestions des Thèmes
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-close-tab" data-toggle="pill" href="#v-pills-close" role="tab" aria-controls="v-pills-close" aria-selected="false">Maintenance
					<i class="fas fa-angle-right"></i>
				</a>
				<?php
				endif;
				?>
				<a class="nav-link" id="v-pills-page-tab" data-toggle="pill" href="#v-pills-page" role="tab" aria-controls="v-pills-page" aria-selected="false">Pages
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" href="managements/logout">Déconnexion
					<i class="fas fa-angle-right"></i>
				</a>
			</div>
		</nav>
	</div>

	<div id="belcms_main_managements_right">
		<div class="tab-content" id="v-pills-tabContent">
		<?php
		if (Users::isSuperAdmin()):
		prefGeneral ($config);
		close ($update);
		prefMembers ($members);
		prefTpl ();
		endif;
		page($pages);
		?>	
		</div>
	</div>

</section>
<?php
endif;

function prefGeneral ($d)
{
?>
	<div class="tab-pane show active" id="v-pills-prefGeneral" role="tabpanel" aria-labelledby="v-pills-prefGeneral-tab">
		<form action="managements/registerGeneral " method="post" class="form-horizontal">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-namewebsite">Nom de votre site</span>
				</div>
				<input type="text" class="form-control" name="CMS_WEBSITE_NAME" aria-describedby="basic-namewebsite" value="<?=$d['CMS_WEBSITE_NAME']?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-desc">Mot clés</span>
				</div>
				<input type="text" class="form-control" name="CMS_WEBSITE_KEYWORDS" aria-describedby="basic-desc" value="<?=$d['CMS_WEBSITE_KEYWORDS']?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-desc">Description du site</span>
				</div>
				<input type="text" class="form-control" name="CMS_WEBSITE_NAME" aria-describedby="basic-desc" value="<?=$d['CMS_WEBSITE_NAME']?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-mail">E-mail Web</span>
				</div>
				<input type="email" class="form-control" name="CMS_MAIL_WEBSITE" aria-describedby="basic-mail" value="<?=$d['CMS_MAIL_WEBSITE']?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-api">API KEY jSon</span>
				</div>
				<input maxlength="32" type="text" class="form-control" name="API_KEY" aria-describedby="basic-api" value="<?=$d['API_KEY']?>">
			</div>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Charte</span>
				</div>
				<textarea class="form-control" name="CMS_REGISTER_CHARTER" aria-label="With textarea"><?=$d['CMS_REGISTER_CHARTER']?></textarea>
			</div>
			<div class="input-group" style="margin-top: 15px;">
				<button type="submit" class="btn btn-sm btn-primary form-control"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
			</div>
		</form>
	</div>
<?php
}

function prefMembers ($d)
{
?>
	<div class="tab-pane fade" id="v-pills-prefMembers" role="tabpanel" aria-labelledby="v-pills-prefMembers-tab">
		<table cellpadding="0" cellspacing="0" border="0" class="DataTableBelCMS display"> 
			<thead>
				<tr>
					<th>Utilisateurs</th>
					<th>e-mail</th>
					<th>Derniere visite</th>
					<th>Date enregistrement</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($d as $k => $v):
				?>
				<tr>
					<th><a href="managements/detail/<?=$v->hash_key?>"><?=$v->username?></a></th>
					<th><?=$v->email?></th>
					<th><?=$v->last_visit?></th>
					<th><?=$v->date_registration?></th>
				</tr>
				<?php
				endforeach;
				?>
			<tfoot> 
				<tr> 
					<th>Utilisateurs</th>
					<th>e-mail</th>
					<th>Derniere visite</th>
					<th>Date enregistrement</th>
				</tr>  
			</tfoot> 
		</table>
	</div>
<?php
}

function page ($d)
{
?>
		<div class="tab-pane fade" id="v-pills-page" role="tabpanel" aria-labelledby="v-pills-page-tab">
			<table cellpadding="0" cellspacing="0" border="0" class="DataTableBelCMS display"> 
				<thead>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Actif</th>
						<th>Accès</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($d as $k => $v):
					?>
					<tr>
						<td><?=$v->id?></td>
						<td><a href="managements/pages/<?=$v->name?>/index"><?=$v->name?></td>
						<td><?=$v->active?></td>
						<td>
						<?php
						if (Secures::getAccessPageAdmin($v->name) == true):
							echo ALLOW;
						else:
							echo REFUSE;
						endif;
						?>
						</td>
					</tr>
					<?php
					endforeach;
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Actif</th>
						<th>Accès</th>
					</tr>
				</tfoot> 
			</table>
		</div>
<?php
}

function prefTpl ()
{
?>
	<div class="tab-pane fade" id="v-pills-tpl" role="tabpanel" aria-labelledby="v-pills-tpl-tab">
		tpl
	</div>
<?php
}

function close ($d)
{
	if ($d['status'] == 'open') {
		$ckd = 'checked="checked"';
	} else {
		$ckd = '';
	}
?>
	<div class="tab-pane fade" id="v-pills-close" role="tabpanel" aria-labelledby="v-pills-close-tab">
		<form action="managements/registerMtn" method="post" class="form-horizontal">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<input value="open" type="checkbox" name="close" class="custom-switch-input" <?=$ckd?>>
					</div>
				</div>
				<input type="text" class="form-control" value="<?=OPEN?>" disabled>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text"><?=TITLE?></span>
				</div>
				<input type="text" name="title" class="form-control" value="<?=$d['title']?>">
			</div>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Description</span>
				</div>
				<textarea name="description" class="form-control" rows="3" placeholder=''><?=$d['description']?></textarea>
			</div>
			<div class="input-group" style="margin-top: 15px;">
				<button type="submit" class="btn btn-sm btn-primary form-control"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
			</div>
		</form>
	</div>
<?php
}