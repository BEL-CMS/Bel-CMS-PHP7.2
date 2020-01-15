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
/* Usage disk */
$df = disk_free_space(ROOT);
$ds = disk_total_space(ROOT);
$resultat_space = (100 - ($df *100/$ds));
$pourcent_space = round($resultat_space); // Arrondi la valeur
$false = true;
/* end usage disk */
/* usage ram */
	function getServerMemoryUsage($getPercentage=true)
	{
		$memoryTotal = null;
		$memoryFree = null;
		if (stristr(PHP_OS, "win")) {
			$cmd = "wmic ComputerSystem get TotalPhysicalMemory";
			@exec($cmd, $outputTotalPhysicalMemory);
			$cmd = "wmic OS get FreePhysicalMemory";
			@exec($cmd, $outputFreePhysicalMemory);
			if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
				foreach ($outputTotalPhysicalMemory as $line) {
					if ($line && preg_match("/^[0-9]+\$/", $line)) {
						$memoryTotal = $line;
						break;
					}
				}
				foreach ($outputFreePhysicalMemory as $line) {
					if ($line && preg_match("/^[0-9]+\$/", $line)) {
						$memoryFree = $line;
						$memoryFree *= 1024;  // convert from kibibytes to bytes
						break;
					}
				}
			}
			$false = true;
		}
		else {
			/*
			if (@is_readable("/proc/meminfo")) {
				$false = true;
				$stats = @file_get_contents("/proc/meminfo");
				if ($stats !== false) {
					$stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
					$stats = explode("\n", $stats);
					foreach ($stats as $statLine) {
						$statLineData = explode(":", trim($statLine));
						if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
							$memoryTotal = trim($statLineData[1]);
							$memoryTotal = explode(" ", $memoryTotal);
							$memoryTotal = $memoryTotal[0];
							$memoryTotal *= 1024;  // convert from kibibytes to bytes
						}
						if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
							$memoryFree = trim($statLineData[1]);
							$memoryFree = explode(" ", $memoryFree);
							$memoryFree = $memoryFree[0];
							$memoryFree *= 1024;  // convert from kibibytes to bytes
						}
					}
				}
			}
			*/
				$false = false;
			
		}
		if (is_null($memoryTotal) || is_null($memoryFree)) {
			return null;
		} else {
			if ($getPercentage) {
				return round(100 - ($memoryFree * 100 / $memoryTotal));
			} else {
				return array(
					"total" => $memoryTotal,
					"free" => $memoryFree,
				);
			}
		}
	}
	function getNiceFileSize($bytes, $binaryPrefix=true) {
		if ($binaryPrefix) {
			$unit=array('B','KiB','MiB','GiB','TiB','PiB');
			if ($bytes==0) return '0 ' . $unit[0];
			return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
		} else {
			$unit=array('B','KB','MB','GB','TB','PB');
			if ($bytes==0) return '0 ' . $unit[0];
			return @round($bytes/pow(1000,($i=floor(log($bytes,1000)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
		}
	}
	$memUsage = getServerMemoryUsage(false);
/* end usage ram */
function lastConnected ()
{
		$return = null;

		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->orderby(array(array('name' => 'last_visit', 'type' => 'DESC')));
		$sql->fields(array('username', 'avatar', 'last_visit'));
		$sql->limit(5);
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
			foreach ($return as $k => $v) {
				$return[$k]->avatar = is_file($v->avatar) ? $v->avatar : 'assets/images/default_avatar.jpg';
			}
		}
		return $return;
}
function lastInteraction ()
{
		$return = null;

		$sql = New BDD();
		$sql->table('TABLE_INTERACTION');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));
		$sql->limit(5);
		$sql->queryAll();
		return $sql->data;
}
?>
		  <div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
			  <div class="x_panel">
				<div class="x_title">
				  <h2>Recent Activities <small>Sessions</small></h2>
				  <div class="clearfix"></div>
				</div>
				<div class="x_content">
				  <div class="dashboard-widget-content">

					<ul class="list-unstyled timeline widget">
						<?php
						foreach (lastInteraction() as $k => $v):
						?>
					  <li>
						<div class="block">
						  <div class="block_content">
							<h2 class="title"><?=$v->title?></h2>
							<div class="byline">
							  <span><?=Common::TransformDate($v->date, 'MEDIUM', 'NONE')?></span> by <a><?=Users::hashkeyToUsernameAvatar($v->author)?></a>
							</div>
							<p class="excerpt"><?=$v->text?></p>
						  </div>
						</div>
					  </li>
						<?php
						endforeach;
						?>
					</ul>
				  </div>
				</div>
			  </div>
			</div>


			<div class="col-md-8 col-sm-8 col-xs-12">
			  <div class="row">
				<!-- Start to do list -->
				<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="x_panel tile fixed_height_320">
				<div class="x_title">
				  <h2>Resource de la machine</h2>
				  <div class="clearfix"></div>
				</div>
				<div class="x_content">

				  <div class="widget_summary">
					<div class="w_left w_25">
					  <span><?=Common::ConvertSize($df)?> restant (<?=$pourcent_space?>%)</span>
					</div>
					<div class="w_center w_55">
					  <div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?=$pourcent_space?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pourcent_space?>%;">
						  <span class="sr-only"><?=$pourcent_space?> Complete</span>
						</div>
					  </div>
					</div>
					<div class="w_right w_20">
					  <span><?=Common::ConvertSize($ds)?></span>
					</div>
					<div class="clearfix"></div>
				  </div>
					<?php
					echo sprintf("Mémoire utiliser: %s / %s (%s%%)",
					getNiceFileSize($memUsage["total"] - $memUsage["free"]),
					getNiceFileSize($memUsage["total"]),
					getServerMemoryUsage(true));
					if (PHP_OS == 'Linux') {
						exec("free -mtl", $output);
						debug($output);
					}
					?>
				</div>
			  </div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div class="x_panel">
						<div class="x_title">
						  <h2>Dernier connecté</h2>
						  <div class="clearfix"></div>
						</div>
						<ul class="list-unstyled top_profiles scroll-view">
							<?php
							foreach (lastConnected() as $k => $v):
								?>
								<li class="media event">
								<a class="pull-left border-aero profile_thumb">
								<i class="fa fa-user aero"></i>
								</a>
								<div class="media-body">
								<a class="title" href="#"><?=$v->username?></a>
								<p><?=Common::TransformDate($v->last_visit, 'FULL', 'MEDIUM')?></p>
								</p>
								</div>
								</li>
								<?php
							endforeach;
							?>
						</ul>
				  </div>

				</div>
			  </div>
			</div>
		  </div>