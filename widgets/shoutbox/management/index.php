<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.3
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

if (isset($_SESSION['LOGIN_MANAGEMENT']) && $_SESSION['LOGIN_MANAGEMENT'] === true):
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-table action-table">
						<div class="widget-header">
							<i class="icon-user"></i>
							<h3><?=SHOUTBOX?></h3>
						</div>
						<div class="widget-content">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<td style="text-align: center;">#</td>
										<td><?=NAME?></td>
										<td><?=DATE?></td>
										<td class="td-actions"><?=OPTIONS?></td>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($this->data)):
									foreach ($this->data as $k => $v):
										$username = AutoUser::getNameAvatar($v->hash_key);
										?>
										<tr>
											<td style="text-align: center;"><?=$v->id?></td>
											<td><?=$username->username?></td>
											<td><?=$v->date_msg?></td>
											<td style="text-align: center;">
												<a href="shoutbox/edit/<?=$v->id?>?management" class="btn btn-small btn-info"><i class="icon-large icon-edit"></i></a>
												<a href="#modal_<?=$v->id?>" role="button" data-toggle="modal" class="btn btn-danger btn-small">
													<i class="btn-icon-only icon-remove"> </i>
												</a>
												<div id="modal_<?=$v->id?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h3 id="myModalLabel">Suppression du message</h3>
													</div>
													<div class="modal-body">
														<p>Etes vous certain de supprimer le message</p>
													</div>
													<div class="modal-footer">
														<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
														<a href="shoutbox/del/<?=$v->id?>?management" class="btn btn-primary">Supprimer</a>
													</div>
												</div>
											</td>
										</tr>
										<?php
									endforeach;
									endif;
									?>
								</tbody>
							</table>
						</div>
	      			</div>
		    	</div>
			</div>
		</div>
	</div>
</div>
<?php
endif;
