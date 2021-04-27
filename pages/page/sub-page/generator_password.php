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
if (isset($_POST) && empty($_POST)):
?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		console.log( "generator_password jQuery loaded" );
		$('#ajaxgenerator').submit(function(event) {
			event.preventDefault();
			boxGenerator($(this), 'POST');
		});
		function boxGenerator (objet, type) {
			/* Get Url */
			if (objet.attr('href')) {
				var url = objet.attr('href');
			} else if (objet.attr('action')) {
				var url = objet.attr('action');
			} else if (objet.data('url')) {
				var url = objet.data('url');
			} else {
				alert('No link sets');
			}
			/* serialize data */
			if ($(objet).is('form')) {
				var dataValue  = $(objet).serialize();
			} else if (objet.data('data') == 'undefined'){
				var dataValue  = objet.data('data');
			}
			/* start ajax */
			$.ajax({
				type: type,
				url: url,
				data: dataValue,
				success: function(data) {
					//var data = $.parseJSON(data);
					/* add text */
					$('input[name=generator]').val(data.text);
				},
			});
		}
	});
</script>
<form id="ajaxgenerator" action="page/intern/generator_password&json" method="post" style="width: 100%;">
<div class="card text-center">
	<div class="card-header">Générateur de mot de passe sûr !</div>
	<div class="card-body">
  <div class="form-group row">
	<label for="Longueur" class="col-sm-2 col-form-label">Longueur</label>
	<div class="col-sm-10">
	  <input id="Longueur" name="lg" type="number" min="6" max="32" class="form-control" value="6">
	</div>
  </div>
  <div class="form-group row">
	<div class="col-sm-6">
	  <input type="checkbox" checked="checked" name="lmin" class="form-control" id="inputPassword">Lettre Minuscule
	</div>
	<div class="col-sm-6">
	  <input type="checkbox" checked="checked" name="lmaj" class="form-control" id="inputPassword">Lettre Majuscule
	</div>
  </div>
  <div class="form-group row">
	<div class="col-sm-6">
	  <input type="checkbox" checked="checked" name="sp" class="form-control" id="inputPassword">Lettre Special (%&@]*, etc...)
	</div>
	<div class="col-sm-6">
	  <input type="checkbox" checked="checked" name="chiffre" class="form-control" id="inputPassword">Chiffres (0-9) 
	</div>
  </div>
	<div class="col-sm-12">
	  <input type="text" id="generator" name="generator" class="form-control" value="">
	</div>
	</div>
	<div class="card-footer text-muted">
		<button type="submit" class="btn btn-primary">Générer</a>
	</div>
</div>
</form>
<?php
else:
$longeur   = (int) $_POST['lg'];
$minuscule = isset($_POST['lmin'])? true : false;
$majuscule = isset($_POST['lmaj'])? true : false;
$speciaux  = isset($_POST['sp']) ? true : false;
$chiffres   = isset($_POST['chiffre']) ? true : false;

$choix = null;

if ($minuscule === true) {
	$choix .= 'lettresmin,';
}
if ($majuscule === true) {
	$choix .= 'majuscule,';
}
if ($speciaux === true) {
	$choix .= 'speciaux,';
}
if ($chiffres === true) {
	$choix .= 'chiffres,';
}

if ($choix[strlen($choix)-1] == ',') {
	substr($choix, 0, -1);
}
$data['text']  = aleatoire ($longeur, $choix);
echo json_encode($data);
endif;
?>
<?php
function aleatoire($longueur = 6,$choix = "speciaux,chiffres,lettresmin,lettresmaj,tous"){
	$choix = explode(",",$choix);
	$ChaineAutiliser = "";
	$CaracteresSpeciaux ="~#{[|`$^@]*)\"^'}@^!:/.?,+-(";
	foreach($choix as $lechoix){
		switch($lechoix){
		case "speciaux":
			$ChaineAutiliser.=$CaracteresSpeciaux;
			break;
		case "chiffres":
			$ChaineAutiliser.="0123456789";
			break;
		case "lettresmin":
			$ChaineAutiliser.="abcdefghijklmnopqrstuvwxyz";
			break;
		case "lettresmaj":
			$ChaineAutiliser.="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			break;
		case "tous":
			$ChaineAutiliser="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ".$CaracteresSpeciaux;
			break;
		default:
			$ChaineAutiliser.="ABCDEFGHIJKLMNOPQRSTUVWXYZ";//si le choix n'est pas bon, on met une chaine par défaut
		}
	}
	$ChaineDeRetour = "";
	for ($i=1; $i <= $longueur; $i++) {//notre chaine de retour contiendra le nombre de caractères demandés
		$ChaineDeRetour .= substr($ChaineAutiliser,rand(0,strlen($ChaineAutiliser)-1),1);//rand(1,le nombre de caractère total utilisables) + 1 nous permet de prendre un seul caractère aléatoirement, dans les types de chaines demandées, pour l'ajouter au fur et à mesure grâce à .= qui dit "ajouter à la suite"
	}
	return $ChaineDeRetour;
}
?>