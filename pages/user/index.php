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
<section id="belcms_main_user">

	<div id="belcms_main_user_left">
		<div id="belcms_main_user_left_avatar">
			<img src="<?=$user->avatar?>" alt="Avatar_<?=$user->username?>">
			<div id="belcms_main_user_left_username"><?=$user->username?></div>
		</div>
		<nav id="belcms_main_user_left_menu">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="true">Compte
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-sefety-tab" data-toggle="pill" href="#v-pills-sefety" role="tab" aria-controls="v-pills-sefety" aria-selected="false">Confidentialité
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-security-tab" data-toggle="pill" href="#v-pills-security" role="tab" aria-controls="v-pills-security" aria-selected="false">Sécurité
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-avatars-tab" data-toggle="pill" href="#v-pills-avatars" role="tab" aria-controls="v-pills-avatars" aria-selected="false">Avatars
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false">Social
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-mobile-tab" data-toggle="pill" href="#v-pills-mobile" role="tab" aria-controls="v-pills-mobile" aria-selected="false">Mobile
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" id="v-pills-connexion-tab" data-toggle="pill" href="#v-pills-connexion" role="tab" aria-controls="v-pills-connexion" aria-selected="false">Connexion
					<i class="fas fa-angle-right"></i>
				</a>
				<a class="nav-link" href="User/Logout">Déconnexion
					<i class="fas fa-angle-right"></i>
				</a>
			</div>
		</nav>
	</div>

	<div id="belcms_main_user_right">
		<div class="tab-content" id="v-pills-tabContent">
		<?php
		account($user);
		sefety($user);
		security();
		avatars($user);
		social($user);
		mobile();
		connexion();
		?>	
		</div>
	</div>

</section>
<?php
endif;

function account ($user)
{
	$user->gender = mb_strtoupper($user->gender);
	$genderM = strtoupper($user->gender) == strtoupper(constant('MALE')) ? 'checked="checked"' : '';
	$genderF = strtoupper($user->gender) == strtoupper(constant('FEMALE')) ? 'checked="checked"' : '';
	$genderU = strtoupper($user->gender) == strtoupper(constant('UNISEXUAL')) ? 'checked="checked"' : '';
	$user->birthday = Common::DatetimeSQL($user->birthday, false, 'Y-m-d');
?>
<div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
	<h2>Votre Compte</h2>
	<form action="user/sendaccount" method="post">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
				<input class="form-control" name="username" type="text" placeholder="<?=constant('ENTER_NAME_PSEUDO')?>" required="required" value="<?=$user->username?>" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
				<input type="email" name="mail" class="form-control" placeholder="Enter email" value="<?=$user->email?>">
				<small id="emailHelp" class="form-text text-muted">L'adresse email ne sera pas affichée publiquement.</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="birthday" class="col-sm-2 col-form-label">Anniversaire</label>
			<div class="col-sm-10">
				<input id="birthday" class="form-control" type="date" name="birthday" value="<?=$user->birthday?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label">SiteWeb</label>
			<div class="col-sm-10">
				<input class="form-control" name="websites" type="text" placeholder="Votre Site Web" value="<?=$user->websites?>" pattern="https?://.+">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Pays</label>
			<div class="col-sm-10">
				<select name="country" class="form-control">
					<?php
					foreach (Common::contryList() as $k => $v):
						$selected = $user->country == $v ? 'selected="selected"' : '';
						echo '<option '.$selected.' value="'.$v.'">'.$v.'</option>';
					endforeach;
					?>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Genre</label>
			<div class="col-sm-10">
				<div class="form-check">
					<input <?=$genderM?> class="form-check-input" type="radio" name="gender" id="male" value="male">
					<label class="form-check-label" for="male"><?=MALE?></label>
				</div>
				<div class="form-check">
					<input <?=$genderF?> class="form-check-input" type="radio" name="gender" id="female" value="female">
					<label class="form-check-label" for="female"><?=FEMALE?></label>
				</div>
				<div class="form-check">
					<input <?=$genderU?> class="form-check-input" type="radio" name="gender" id="nospec" value="unisexual">
					<label class="form-check-label" for="nospec"><?=NO_SPEC?></label>
				</div>
			</div>
		</div>

		<hr>

		<button type="submit" class="btn btn-primary">Enregistrer</button>

	</form>
</div>
<?php
}

function sefety ($user)
{
?>
<div class="tab-pane fade" id="v-pills-sefety" role="tabpanel" aria-labelledby="v-pills-sefety-tab">
	<h2>Confidentialité</h2>
	<form>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
				<input disabled type="email" class="form-control" value="<?=$user->email?>">
				<small id="emailHelp" class="form-text text-muted">L'adresse email priver ne sera pas affichée publiquement.</small>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Date D'enregistrement</label>
			<div class="col-sm-10">
				<input disabled type="datetime" class="form-control" value="<?=$user->date_registration?>">
				<small id="emailHelp" class="form-text text-muted">la date d'inscription au site, il est possible qu'il soit utiliser publiquement.</small>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Dernère visite</label>
			<div class="col-sm-10">
				<input disabled type="datetime" class="form-control" value="<?=$user->last_visit?>">
				<small id="emailHelp" class="form-text text-muted">la date de la dernière visite au site, il est possible qu'il soit utiliser publiquement.</small>
			</div>
		</div>
		<hr>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Groupe principal</label>
			<div class="col-sm-10">
				<select disabled class="form-control">
					<option value="<?=$user->main_groups?>"><?=$user->main_groups?></option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Groupe Secondaire</label>
			<div class="col-sm-10">
				<select class="form-control">
					<?php
					sort($user->groups);
					foreach ($user->groups as $k => $v):
						?>
						<option value="<?=$v?>"><?=$v?></option>
						<?php
					endforeach;
					?>
				</select>
			</div>
		</div>
	</form>
</div>
<?php
}

function security ()
{
?>
<div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab">
	<h2>Sécurité</h2>
	<form action="user/sendsecurity" method="post">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mot de passe</label>
			<div class="col-sm-10">
				<input name="password_old" type="password" class="form-control" value="">
				<small id="passHelp" class="form-text text-muted">Entrer votre ancien mot de passe.</small>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mot de passe</label>
			<div class="col-sm-10">
				<input name="password_new" type="text" class="form-control" value="" rel="gp" data-character-set="a-z,A-Z,0-9,#" data-size="6">
				<small id="passHelp" class="form-text text-muted">Entrer votre nouveau mot de passe (6 caractère minimum).</small>
				<button type="button" class="btn btn-primary getNewPass">Générateur</button>
			</div>
		</div>
		<hr>

		<button type="submit" class="btn btn-primary">Enregistrer</button>

	</form>
</div>
<?php
}

function avatars  ($user)
{
	$list = array();
	$path = "uploads/users/".$user->hash_key."/";
	if($dossier = opendir($path))
	{
	    while(($fichier = readdir($dossier)))
	    {

	        if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
	        {
	            $pattern = '/(gif|jpg|png)$/i'; //extension d'image accepter

	            $matche = preg_match($pattern, $fichier);
	            if ($matche)
	            {
	                $list[] = $fichier;
	            }

	        }
	    }

	}
?>
<div class="tab-pane fade" id="v-pills-avatars" role="tabpanel" aria-labelledby="v-pills-avatars-tab">
	<h2>Avatars</h2>
	<form id="avatarSubmit" method="post" action="user/avatarsubmit">
		<ul id="bel_cms_user_ul_avatar">
			<?php
			foreach ($list as $k => $v):
				$alt = 'uploads/users/'.$user->hash_key.'/'.$v;
			?>
			<li>
				<label for="sel_avatar_<?=$k?>">
				<a href="#<?=$v?>" class="bel_cms_jquery_avatar_sel" data-id="<?=$k?>">
					<input class="select_avatar" id="sel_avatar_<?=$k?>" type="radio" name="avatar" value="<?=$alt?>">
					<img width="100" height="100" class="bel_cms_jquery_avatar_sel" src="<?=$alt?>" alt="<?=$alt?>">
					<span>Selectionner</span>
				</a>
				</label>
			</li>
			<?php
			endforeach;
			?>
		</ul>
		<hr>
		<input id="selectavatar" type="hidden" name="select" value="select">
		<button type="submit" class="btn btn-primary">Enregistrer</button>
		<button id="delavatar" type="submit" class="btn btn-danger">Supprimer</button>

	</form>
	<hr>
	<form action="user/newavatar" method="post" enctype="multipart/form-data">
		<div class="setting image_picker">
			<div class="settings_wrap">
				<label class="drop_target">
					<div class="image_preview"></div>
					<input name="avatar" id="inputFile" type="file">
				</label>
				<div class="settings_actions vertical">
					<a data-action="choose_from_uploaded">
						<i class="far fa-images"></i> Choisir l'upload
					</a>
					<a class="disabled" data-action="remove_current_image">
						<i class="fa fa-ban"></i> Effacer image choisi
					</a>
				</div>
				<div class="image_details">
					<label class="input_line image_title">
						<input type="text" placeholder="Title">
					</label>
				</div>
			</div>
		</div>
		<hr>
		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>
</div>
<?php
}

function social ($user)
{
?>
<div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
	<h2>Liens Social</h2>
	<form action="user/submitsocial" method="post">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"><i class="fab fa-facebook-square"></i> Facebook</label>
			<div class="col-sm-10">
				<input class="form-control" name="facebook" type="text" placeholder="<?=constant('ENTER_YOUR');?> facebook" value="<?=$user->facebook?>" pattern="^[a-z\d\.]{5,}$">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"><i class="fab fa-twitter-square"></i> Twitter</label>
			<div class="col-sm-10">
				<input class="form-control" name="twitter" type="text" placeholder="<?=constant('ENTER_YOUR');?> twitter" value="<?=$user->twitter?>" pattern="^[A-Za-z0-9_]{1,15}$">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"><i class="fab fa-google-plus-square"></i> Google+</label>
			<div class="col-sm-10">
				<input class="form-control" name="googleplus" type="text" placeholder="<?=constant('ENTER_YOUR');?> gplus" value="<?=$user->googleplus?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"><i class="fab fa-pinterest-square"></i> Pinterest</label>
			<div class="col-sm-10">
				<input class="form-control" name="pinterest" type="text" placeholder="<?=constant('ENTER_YOUR');?> pinterest" value="<?=$user->pinterest?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"><i class="fab fa-linkedin"></i> Linkedin</label>
			<div class="col-sm-10">
				<input class="form-control" name="linkedin" type="text" placeholder="<?=constant('ENTER_YOUR');?> linkedin" value="<?=$user->linkedin?>">
			</div>
		</div>
		<hr>

		<button type="submit" class="btn btn-primary">Enregistrer</button>

	</form>
</div>
<?php
}

function mobile ()
{
?>
<div class="tab-pane fade" id="v-pills-mobile" role="tabpanel" aria-labelledby="v-pills-mobile-tab">
	<h2>Compte Mobile</h2>
	<p>En cours de développement</p>
</div>
<?php
}

function connexion ()
{
?>
<div class="tab-pane fade" id="v-pills-connexion" role="tabpanel" aria-labelledby="v-pills-connexion-tab">
	<h2>Vos connexions</h2>
	<p>En cours de développement</p>
</div>
<?php
}