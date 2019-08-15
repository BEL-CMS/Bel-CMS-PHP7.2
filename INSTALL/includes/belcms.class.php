<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

class BelCMS
{
	var $page;

	function __construct()
	{
		if (!session_id()) {
			session_start();
		}
		$this->page = (!isset($_REQUEST['page'])) ? 'home' : $_REQUEST['page'];
		require_once ROOT.'INSTALL'.DS.'includes'.DS.'checkCompatibility.php';
	}

	public function VIEW()
	{
		ob_start();
		require ROOT.'INSTALL'.DS.'pages'.DS.$this->page.'.tpl';
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	public function HTML()
	{
		if ($this->page == 'create_sql') {
			$table = $_REQUEST['table'];
			require_once ROOT.'INSTALL'.DS.'includes'.DS.'tables.php';
			if ($error === true) {
				echo $class;
			} else {
				echo false;
			}
		} else {
			ob_start("ob_gzhandler");
			?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<meta charset="utf-8">
			<title>BEL-CMS # Install</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
			<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
			<link href="css/styles.css" rel="stylesheet">
			</head>
			<body>
				<div class="page-container">

					<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="position: relative;">
						<div class="navbar-header">
							<a class="navbar-brand" href="#">BEL-CMS Installation</a>
						</div>
					</nav>

					<div id="container" class="container">
						<?=self::VIEW()?>
					</div>
				</div>

				<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
				<script src="js/scripts.js"></script>
			</body>
			</html>
			<?php
			$buffer = ob_get_contents();
			ob_end_clean();
			return $buffer;
		}
	}

	public static function TABLES () {

		$tables = array(
			'comments',
			'config',
			'config_pages',
			'groups',
			'inbox',
			'inbox_msg',
			'mails_blacklist',
			'page_blog',
			'page_forum',
			'page_forum_post',
			'page_forum_posts',
			'page_forum_threads',
			'page_shoutbox',
			'page_users',
			'page_users_profils',
			'page_users_social',
			'visitors',
			'widgets'
		);

		return $tables;
	}
}
#########################################
# Debug
#########################################
function debug ($data = null, $exitAfter = false)
{
	echo '<pre>';
		print_r($data);
	echo '</pre>';
	if ($exitAfter === true) {
		exit();
	}
}
function redirect ($url = null, $time = null)
{
	$scriptName = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

	$fullUrl = ($_SERVER['HTTP_HOST'].$scriptName);

	if (!strpos($_SERVER['HTTP_HOST'], $scriptName)) {
		$fullUrl = $_SERVER['HTTP_HOST'].$scriptName.$url;
	}

	if (!strpos($fullUrl, 'http://')) {
		if ($_SERVER['SERVER_PORT'] == 80) {
			$url = 'http://'.$fullUrl;
		} else if ($_SERVER['SERVER_PORT'] == 443) {
			$url = 'https://'.$fullUrl;
		} else {
			$url = 'http://'.$fullUrl;
		}
	}

	$time = (empty($time)) ? 0 : (int) $time * 1000;

	?>
	<script>
	window.setTimeout(function() {
		window.location = '<?php echo $url; ?>';
	}, <?php echo $time; ?>);
	</script>
	<?php
}
function insertUserBDD ()
{
	$sql = array();

	if (!function_exists('password_hash')) {
		require ROOT.'core.'.DS.'password.php';
	}

	$users['username']	= $_POST['username'];
	$users['password']	= password_hash($_POST['password'], PASSWORD_DEFAULT);
	$users['email']		= $_POST['email'];
	$users['hash_key']	= md5(uniqid(rand(), true));
	$users['ip']		= getIp();

	$sql[0]  = "INSERT INTO `".$_SESSION['prefix']."page_users` (
				`id` ,
				`username` ,
				`password` ,
				`email` ,
				`avatar` ,
				`hash_key` ,
				`date_registration` ,
				`last_visit` ,
				`groups` ,
				`main_groups` ,
				`valid` ,
				`ip` ,
				`token`
			) VALUES (
				NULL , '".$users['username']."', '".$users['password']."', '".$users['email']."', '', '".$users['hash_key']."', NOW() , NOW() , '1', '1', '1', '".$users['ip']."', ''
			);";

	$sql[1]  = "INSERT INTO `".$_SESSION['prefix']."page_users_profils` (
				`id` ,
				`hash_key` ,
				`gender` ,
				`public_mail` ,
				`websites` ,
				`list_ip` ,
				`list_avatar` ,
				`config` ,
				`info_text` ,
				`birthday` ,
				`country` ,
				`hight_avatar` ,
				`friends`
				)
			VALUES (
				NULL , '".$users['hash_key']."', 'unisexual', '', '', '', '', '', '', '".date('Y-m-d')."' , '', '', ''
			);";

	$sql[2]  = "INSERT INTO `".$_SESSION['prefix']."page_users_social` (
				`id` ,
				`hash_key` ,
				`facebook` ,
				`linkedin` ,
				`twitter` ,
				`googleplus` ,
				`pinterest`
				)
			VALUES (
				NULL , '".$users['hash_key']."', '', '', '', '', ''
			);";

	$error = false;
	foreach ($sql as $insert) {
		if ($error === true) {
			break;
		}
		try {
			$cnx = new PDO('mysql:host='.$_SESSION['host'].';port='.$_SESSION['port'].';dbname='.$_SESSION['dbname'], $_SESSION['username'], $_SESSION['password']);
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$cnx->exec($insert);
			$return = true;
		} catch(PDOException $e) {
			$error  = true;
			$return = $e->getMessage();
		}
		unset($cnx);
	}
	return $return;
}

function rmAllDir($strDirectory){
	$dir_iterator = new RecursiveDirectoryIterator($strDirectory);
	$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
	foreach($iterator as $fichier){
		$fichier->isDir() ? @rmdir($fichier) : @unlink($fichier);
	}
	@rmdir($strDirectory);
}

function getIp () {
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$return = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$return = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$return = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
	if ($return == '::1') {
		$return = '127.0.0.1';
	}
	return $return;
}
?>
