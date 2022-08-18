<?php
$microTime = microtime(true);
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */
/* Usage disk */
$df = disk_free_space(ROOT);
$ds = disk_total_space(ROOT);
$resultat_space = (100 - ($df *100/$ds));
$pourcent_space = round($resultat_space); // Arrondi la valeur
$false = true;
//echo Common::ConvertSize($df);
//echo Common::ConvertSize($ds);

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
function getNbVisitors()
{
	$result = 0;

	$sql = New BDD();
	$sql->table('TABLE_USERS');
	$sql->count();
	return $sql->data;
}
function getNbNews()
{
	$result = 0;

	$sql = New BDD();
	$sql->table('TABLE_PAGES_ARTICLES');
	$sql->count();
	return $sql->data;
}
function getNbComments()
{
	$result = 0;

	$sql = New BDD();
	$sql->table('TABLE_COMMENTS');
	$sql->count();
	return $sql->data;
}
function getNbDl()
{
	$result = 0;

	$sql = New BDD();
	$sql->table('TABLE_DOWNLOADS');
	$sql->count();
	return $sql->data;
}

?>
<div class="row">
  <div class="col-md-4" style="margin: 25px;">
	<div class="card card-widget widget-user-2">
	  <div class="widget-user-header bg-warning">
		<div class="widget-user-image">
			<?php
			if (Users::getUserName(false)) {
				$avatar = Users::getUserName(false);
			} else {
				$avatar = '/assets/images/default_avatar.jpg';
			}
			?>
		  <img class="img-circle elevation-2" src="/<?=$avatar?>">
		</div>
	  </div>
	  <div class="card-footer p-0">
		<ul class="nav flex-column">
		  <li class="nav-item">
			<a href="#" class="nav-link">
			  Pseudo <span class="float-right badge"><?=Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY'])?></span>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="#" class="nav-link">
			  Votre IP <span class="float-right badge"><?=Common::GetIp();?></span>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="#" class="nav-link">
			  Port <span class="float-right badge"><?=$_SERVER['SERVER_PORT'];?></span>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="#" class="nav-link">
			  Chargement de la page
			  <span class="float-right badge">
				<?php
				$time = (microtime(true) - $microTime);
				echo round($time, 3);?> Secondes</span>
			</a>
		  </li>
		</ul>
	  </div>
	</div>
  </div>

 </div>
<div class="row">
  <div class="col-lg-3 col-6">
	<!-- small card -->
	<div class="small-box bg-info">
	  <div class="inner">
		<h3><?=getNbVisitors();?></h3>
		<p>Membres</p>
	  </div>
	  <div class="icon">
		<i class="fas fa-user-plus"></i>
	  </div>
	  <a href="/registration?management&users" class="small-box-footer">
		Voir tout les utilisateurs <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
	<!-- small card -->
	<div class="small-box bg-success">
	  <div class="inner">
		<h3><?=getNbNews();?></h3>
		<p>News</p>
	  </div>
	  <div class="icon">
		<i class="fa-solid fa-file-circle-plus"></i>
	  </div>
	  <a href="/articles?management&pages" class="small-box-footer">
		Ajouté une news <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
	<!-- small card -->
	<div class="small-box bg-warning">
	  <div class="inner">
		<h3><?=getNbComments();?></h3>
		<p>Commentaires</p>
	  </div>
	  <div class="icon">
		<i class="fa-solid fa-comment-dots"></i>
	  </div>
	  <a href="/comments?management&pages" class="small-box-footer">
		Voir les commentaires <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
	<!-- small card -->
	<div class="small-box bg-danger">
	  <div class="inner">
		<h3><?=getNbDl();?></h3>
		<p>Téléchargements</p>
	  </div>
	  <div class="icon">
		<i class="fa-solid fa-download"></i>
	  </div>
	  <a href="/downloads?management&pages" class="small-box-footer">
		Ajouter <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>
  <!-- ./col -->
</div>