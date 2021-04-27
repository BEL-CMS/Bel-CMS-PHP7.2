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
		$sql->limit(10);
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
		$sql->limit(10);
		$sql->queryAll();
		return $sql->data;
}
?>
<div id="page-content">
	<ul class="breadcrumb breadcrumb-top">
		<li>Index</li>
	</ul>
	<div class="row">
		<div class="col-md-6">
			<div class="block">
				<div class="block-title">
					<h2>Activities</h2>
				</div>
				<div class="table-responsive">
					<table  class="table table-vcenter table-striped">
						<thead>
							<tr>
								<th></th>
								<th>Date</th>
								<th>Utilisateurs</th>
								<th>Sujet</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach (lastInteraction() as $k => $v):
							$timeline = ($v->type == 'success') ? '<i class="fa fas fa-check-circle bg-success"></i>' : '<i class="fa fas fa-exclamation-circle bg-error"></i>';
						?>
						<tr>
							<td><?=$timeline?></td>
							<td><?=Common::TransformDate($v->date, 'MEDIUM', 'NONE')?></td>
							<td><a href="#"><?=Users::hashkeyToUsernameAvatar($v->author)?></a></td>
							<td><?=$v->text?></td>
						</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block">
				<div class="block-title">
					<h2>Login récents</h2>
				</div>
				<div class="table-responsive">
				<table  class="table table-vcenter table-striped">
					<thead>
						<tr>
							<th>Utilisateurs</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach (lastConnected() as $k => $v):
					?>
					<tr>
						<td><?=$v->username?></td>
						<td><?=$v->last_visit?></td>
					</tr>
					<?php
					endforeach;
					?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="row">
					<div class="col-6 border-right">
						<div class="card-body iconfont text-center">
							<h5 class="text-muted">Resource de la machine</h5>
							<h1 class="mt-4 text-dark mainvalue"><?=Common::ConvertSize($ds)?></h1>
							<p><span class="text-purple"><i class="fa fa-arrow-up text-success mr-1"> </i><?=Common::ConvertSize($df)?> (<?=100-$pourcent_space?>%) </span> restant</p>
						</div>
					</div>
					<div class="col-6">
						<div class="card-body iconfont text-center">
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
			</div>
		</div>
	</div>
