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

require_once ROOT.'INSTALL'.DS.'includes'.DS.'checkCompatibility.php';

function checkPhp ()
{
	$return = false;
	if (version_compare(PHP_VERSION, '7.0.3') >= 0) {
		$return = true;
	}
	return $return;
}
function checkMysqli ()
{
	$return = false;
	if (function_exists('mysqli_connect')) {
		$return = true;
	}
	return $return;
}
function checkRewrite ()
{
	if (function_exists("apache_get_modules")) {
		$modules = apache_get_modules();
		$mod_rewrite = in_array("mod_rewrite",$modules);
	}
	if (!isset($mod_rewrite) && isset($_SERVER["HTTP_MOD_REWRITE"])) {
		return $_SERVER["HTTP_MOD_REWRITE"] == 'on' ? true : false;
	}
}
function checkPDO ()
{
	$return = false;
	if (class_exists('PDO')) {
		$return = true;
	}
	return $return;
}
function checkIntl ()
{
	$return = false;
	if (class_exists('IntlDateFormatter')) {
		$return = true;
	}
	return $return;
}
function checkWriteConfig ()
{
	$write = substr(sprintf('%o', fileperms(ROOT.'config')), -4);
	if ($write == 0777) {
		return true;
	} else {
		if (is_writable(ROOT.'config') === true) {
			return true;
		} else {
			return false;
		}
	}
}
function checkPDOConnect ($d)
{
	try {
		$cnx = new PDO('mysql:host='.$d["serversql"].';port='.$d["port"].';dbname='.trim($d["name"]), $d["user"], $d["password"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

		$_SESSION['host']       = $d["serversql"];
		$_SESSION['username']   = $d["user"];
		$_SESSION['password']   = $d["password"];
		$_SESSION['dbname']     = $d["name"];
		$_SESSION['port']       = $d["port"];
		$_SESSION['prefix']     = $d['prefix'];

		createConfig();

		return true;
	}
	catch(PDOException $e) {
		redirect('?page=sql', 3);
		return $e->getMessage();
	}
}

function createConfig ()
{
	if (is_writable(ROOT.'config') === false) {
		trigger_error("No Writable dir : ".ROOT."config", E_USER_ERROR);
	}
	$dirFile = ROOT.'config'.DS.'config.inc.php';
	if (is_file($dirFile)) {
		@chmod($dirFile, 0700);
		@copy($dirFile, $dirFile.'_'.date('d-m-Y-H-i'));
		unlink($dirFile);
	}
	$fp = fopen ($dirFile, "w+");
	fwrite($fp,configIncPhp());
	fclose($fp);
	@chmod($dirFile, 0644);
}
function configIncPhp ()
{
	$content  = "<?php".PHP_EOL;
	$content .= "/**".PHP_EOL;
	$content .= "* Bel-CMS [Content management system]".PHP_EOL;
	$content .= "* @version 0.0.1".PHP_EOL;
	$content .= "* @link http://www.bel-cms.be".PHP_EOL;
	$content .= "* @link http://www.stive.eu".PHP_EOL;
	$content .= "* @license http://opensource.org/licenses/GPL-3.0 copyleft".PHP_EOL;
	$content .= "* @copyright 2014 Bel-CMS".PHP_EOL;
	$content .= "* @author Stive - mail@stive.eu".PHP_EOL;
	$content .= "*/".PHP_EOL;
	$content .= "\$BDD = 'server';".PHP_EOL;
	$content .= '$databases["server"] = array('.PHP_EOL;
	$content .= "#####################################".PHP_EOL;
	$content .= "# Réglages MySQL - SERVEUR".PHP_EOL;
	$content .= "#####################################".PHP_EOL;
	$content .= "'DB_DRIVER'   => 'mysql',".PHP_EOL;
	$content .= "'DB_NAME'     => '".$_SESSION['dbname']."',".PHP_EOL;
	$content .= "'DB_USER'     => '".$_SESSION['username']."',".PHP_EOL;
	$content .= "'DB_PASSWORD' => '".$_SESSION['password']."',".PHP_EOL;
	$content .= "'DB_HOST'     => '".$_SESSION['host']."',".PHP_EOL;
	$content .= "'DB_PREFIX'   => '".$_SESSION['prefix']."',".PHP_EOL;
	$content .= "'DB_PORT'     => '".$_SESSION['port']."'".PHP_EOL;
	$content .= ");".PHP_EOL;
	$content .= "Common::constant(\$databases[\$BDD]); unset(\$databases, \$BDD);".PHP_EOL;

	return $content;
}

function isWritable($path) {
	if ($path{strlen($path)-1}=='/')
		return isWritable($path.uniqid(mt_rand()).'.tmp');
	else if (is_dir($path))
		return isWritable($path.'/'.uniqid(mt_rand()).'.tmp');
	$rm = file_exists($path);
	$f = @fopen($path, 'a');
	if ($f===false)
		return false;
	fclose($f);
	if (!$rm)
		unlink($path);
	return true;
}
final class GetHost {

	public static function isHttps() {
		return (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ||
			$_SERVER['SERVER_PORT'] == 443;
	}

	public static function getBaseUrl() {
		$protocol = self::isHttps() ? 'https' : 'http';
		if (isset($_SERVER["SERVER_PORT"])) {
			$port = ':' . $_SERVER["SERVER_PORT"];
		} else {
			$port = '';
		}
		if ($port == ':80' || $port == ':443') {
			$port = '';
		}
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$cutoff = strpos($uri, 'index.php');
		$uri = substr($uri, 0, $cutoff);
		$serverName = getenv('HOSTNAME')!==false ? getenv('HOSTNAME') : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '');
		$serverName = str_replace('INSTALL/','',$serverName);
		return "$protocol://{$serverName}$port";
	}
}
