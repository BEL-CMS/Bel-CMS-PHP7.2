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
if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<form action="/Team/playeredit?management&gaming=true" method="post" class="form-horizontal">
<div class="x_panel">
	<div class="x_title">
		<h2>Menu Page Team</h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<a href="/team?management&gaming=true" class="btn btn-app">
			<i class="fa fas fa-home"></i> Accueil
		</a>
		<a href="/Team/addTeam?management&gaming=true" class="btn btn-app">
			<i class="fa fas fa-plus"></i> <?=ADD?>
		</a>
	</div>
</div>

<div class="x_panel">
	<div class="x_title">
		<h2>Team <small><?=$team->name?></small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<label>Selectionner le ou les joueurs qui feront partie de la team : <?=$team->name?></label>
		<?php
		foreach ($user as $k => $v):
			$checked = in_array($v->hash_key, $userTeam) ? 'checked="checked"' : '';
			?>
			<p><input <?=$checked?> type="checkbox" name="team[]" value="<?=$v->hash_key?>" class="flat"> <?=$v->username?></p>
			<?php
		endforeach;
		?>
		<div class="form-group">
			<input type="hidden" name="id" value="<?=$team->id?>">
			<button type="submit" class="btn btn-primary"><?=EDIT?></button>
		</div>
	</div>
</div>
<?php
endif;