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
if (Users::isLogged() === true && Users::isSuperAdmin() === true):
?>
	<div class="card" style="margin-bottom: 20px;">
		<div class="card-header">
			<h3 class="card-title">Informations Confidentiel</h3>
		</div>
		<form action="managements/sendPrivate/<?=$user->id?>" method="post" class="form-horizontal">
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=NAME?></div>
			<div class="card-body">
				<input value="<?=$user->username?>" type="text" class="form-control has-feedback-left" placeholder="userName" readonly="readonly">
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">E-mail Privé</div>
			<div class="card-body">
				<input name="email" value="<?=$user->email?>" type="email" class="form-control" id="inputSuccess3" placeholder="email">
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">IP Utilisateur</div>
			<div class="card-body">
				<input value="<?=$user->ip?>" type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="IP" readonly="readonly">
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">HashKey</div>
			<div class="card-body">
				<input type="text" class="form-control" readonly="readonly" id="inputSuccess5" value="<?=$user->hash_key?>">
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
	<div class="card" style="margin-bottom: 20px;">
		<div class="card-header">
			<h3 class="card-title">Gestions du groupe <small>Principale</small></h3>
		</div>
		<form action="managements/sendMainGroup" method="post" class="form-horizontal">
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Principale</div>
			<div class="card-body">
				<select name="main" class="select2_single form-control" tabindex="-1">
				<?php
				foreach (Secures::getGroups() as $key => $value):
				$title = defined(strtoupper($value)) ? constant(strtoupper($value)) : $value;
				$main_groups = $key == $user->main_groups ? 'selected="selected"': '';
				?>
				<option <?=$main_groups?> value="<?=$key?>"><?=$title?></option>
				<?php
				endforeach;
				?>  
				</select>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
	<div class="card" style="margin-bottom: 20px;">
		<div class="card-header">
			<h3 class="card-title">Gestions du groupe <small>Secondaire</small></h3>
		</div>
		<form action="managements/sendMainGroup" method="post" class="form-horizontal">
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Secondaire</div>
			<div class="card-body">
				<?php
				foreach (Secures::getGroups() as $key => $value):
				$title  = defined(strtoupper($value)) ? constant(strtoupper($value)) : $value;
				$groups = explode('|', $user->groups);
				if (in_array($key, $groups)) {
					$groups = 'checked="checked"';
				} else {
					$groups = '';
				}
				$groupsuser = $key == 2 ? 'checked="checked" readonly=""': ''; 
				?>
				<div class="form-group">
					<label class="custom-switch">
						<input value="<?=$key?>" name="second[]" class="custom-switch-input" type="checkbox" <?=$groups?> <?=$groupsuser?>>
						<span class="custom-switch-indicator label-danger"></span>
						<span class="custom-switch-description"><?=$title?></span>
					</label>
				</div>
				<?php
				endforeach;
				?>  
				</select>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
	<div class="card" style="margin-bottom: 20px;">
		<div class="card-header">
			<h3 class="card-title">Information <small>public</small></h3>
		</div>
		<form action="managements/sendInfoPublic" method="post">
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Anniversaire</div>
			<div class="card-body">
				<?php
				$profil->birthday = Common::DatetimeSQL($profil->birthday, false, 'Y-m-d');
				?>
				<input id="birthday" class="form-control" type="date" name="birthday" value="<?=$profil->birthday?>">
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">e-amil publique</div>
			<div class="card-body">
				<input name="public_mail" value="<?=$profil->public_mail?>" type="email" class="form-control" id="inputSuccess3" placeholder="public email">
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Sexe</div>
			<div class="card-body">
				<select name="gender" class="form-control">
				  <?php
				  if ($profil->gender == 'male') {
					$male      = 'selected="selected"';
					$female    = null;
					$unisexual = null;
				  } elseif ($profil->gender == 'female') {
					$female    = 'selected="selected"';
					$male      =  null;
					$unisexual = null;
				  } elseif ($profil->gender == 'unisexual') {
					$unisexual =' selected="selected"';
					$male      = null;
					$female    = null;
				  }
				  ?>
				  <option <?=$unisexual?> value="unisexual">Non spécifié</option>
				  <option <?=$male?> value="male">Homme</option>
				  <option <?=$female?> value="female">Femme</option>
				</select>
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Pays</div>
			<div class="card-body">
				<select name="country" class="form-control">
				  <?php
				  foreach (Common::contryList() as $k => $v):
					$selected = $profil->country == $v ? 'selected="selected"' : '';
					echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
				  endforeach;
				  ?>
				</select>
			</div>
			<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0">Website</div>
			<div class="card-body">
				<input name="websites" value="<?=$profil->websites?>" type="url" class="form-control" placeholder="https://">
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>

	<div class="card" style="margin-bottom: 20px;">
		<div class="card-header">
			<h3 class="card-title">Gestion Social</h3>
		</div>
		<form action="managements/sendSocial" method="post">
			<?php
			foreach ($social as $key => $value):
			  if ($key != 'id' && $key != 'hash_key'):
			  ?>
				<div style="margin-bottom: 0 !important;" class="card-alert alert alert-primary mb-0"><?=$key?></div>
					<div class="card-body">
				<input type="text" id="<?=$key?>" class="form-control" name="<?=$key?>" value="<?=$value?>">
			  </div>
			  <?php
			  endif;
			endforeach;
			?>
			<div class="card-footer">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
<?php
endif;