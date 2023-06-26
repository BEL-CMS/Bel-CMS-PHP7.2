<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.2
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}
?>
<script type="text/javascript">
var ipv4_address = $('#ipv4');
ipv4_address.inputmask({
    alias: "ip",
    greedy: true
});
</script>
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Bannissement</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="form-group">
			<form action="bannir/sendadd?management&users" method="post" class="form-horizontal form-bordered">
				<div class="form-group">
				<label class="col-sm-12 control-label" for="ban_author"><?=NAME?></label>
					<div class="col-sm-12">
						<select class="control-label" name="author" id="ban_author">
							<option value="0">--> Choisir un utilisateur <--</option>
							<?php
							foreach ($author as $k => $v):
								if ($_SESSION['USER']['HASH_KEY'] !== $v->hash_key):
							?>
							<option class="form-control" value="<?=$v->hash_key;?>"><?=$v->username;?></option>
							<?php
								endif;
							endforeach;
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label" for="checkbox">Raison</label>
					<div class="col-sm-12">
						<textarea name="reason"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label" for="checkbox">IP</label>
					<div class="col-sm-12">
						<input type="text" class="form-input" id="ipv4" name="ip_ban" placeholder="xxx.xxx.xxx.xxx">
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-sm-12 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>