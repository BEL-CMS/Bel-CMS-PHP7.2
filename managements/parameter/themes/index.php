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
<div class="row">
    <div class="col-md-6">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2><strong>Templates</strong></h2>
            </div>
			<form action="themes/send?management&parameter=true" method="post" class="form-horizontal form-bordered">
				<?php
				foreach ($tpl as $k => $v):
					$chcked = $active->value == $v ? 'checked="checked"': '';
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="<?=$k?>"><?=$v?></label>
						<div class="col-sm-9">
							<input value="<?=$v?>" type="radio" id="<?=$k?>" name="tpl" class="form-control input-sm" <?=$chcked?>>
						</div>
					</div>
					<?php
				endforeach;
				?>
				<div class="form-group form-actions">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> <?=SAVE?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
endif;