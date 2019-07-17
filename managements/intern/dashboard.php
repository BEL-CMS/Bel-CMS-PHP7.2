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

$root = Common::ScanDirectory(ROOT);
$dir  = Common::ScanFiles(ROOT);
$file_root = null;
foreach ($dir as $k => $v) {
	if (!in_array($v, $root)) {
		$file_root[] = $v;
	}
}
?>
				<div class="page-inner">
					<div class="page-title">
						<h3 class="breadcrumb-header">
						</h3>
					</div>
					<div id="main-wrapper">
						<div class="row">
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Dossiers & fichiers CMS</h4>
								</div>
								<div class="panel-body">
									<div id="basicTree">
										<ul>
											<li data-jstree='{"opened":false}'>Root node
												<ul>
													<?php
													foreach ($root as $k => $v):
														?>
														<li data-jstree='{"opened":true}'>
															<?=$v?>
																<ul data-jstree='{"opened":false}'>
																	<?php
																	foreach (Common::ScanDirectory($v) as $k_a => $v_a):
																		?>
																		<li data-jstree='{"opened":false}'>
																			<?=$v_a?>
																			<ul data-jstree='{"opened":false}'>
																				<?php
																				foreach (Common::ScanDirectory($v_a) as $k_b => $v_b):
																					?>
																					<li data-jstree='{"opened":false}'><?=$v_b?></li>
																					<?php
																				endforeach;
																				?>
																			</ul>
																		</li>
																		<?php
																	endforeach;
																	?>
																</ul>
															</li>
														<?php
													endforeach;
													?>
												</ul>
											</li>
											<?php
											foreach ($file_root as $k => $v):
												?>
												<li data-jstree='{"type":"file"}'><?=$v?></li>
												<?php
											endforeach;
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
					<div class="page-footer">

					</div>
				</div>