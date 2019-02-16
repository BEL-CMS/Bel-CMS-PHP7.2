<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Visitors extends Dispatcher
{

	private $visitor_user,
			$visitor_ip,
			$visitor_browser,
			$visitor_hour,
			$visitor_minute,
			$visitor_date,
			$visitor_day,
			$visitor_month,
			$visitor_year,
			$visitor_refferer,
			$visitor_page;

	function __construct()
	{

	}

	private function user ()
	{
		$return = null;

		if ($_SESSION['USER']['HASH_KEY']) {
			$return = $_SESSION['USER']['HASH_KEY'];
		} else {
			$return = Common::GetIp();
		}
	}

	private function ip ()
	{
		return Common::GetIp();
	}

	private function visitorHour ()
	{
		return date('G');
	}

	private function visitorMinute ()
	{
		return date('i');
	}

	private function visitorDay ()
	{
		return date('d');
	}

	private function visitorMonth ()
	{
		return date('m');
	}

	private function visitorYear ()
	{
		return date('Y');
	}

	private function getBrowserType () {
		$u_agent  = $_SERVER['HTTP_USER_AGENT'];
		$bname    = 'Unknown';
		$platform = 'Unknown';
		$version  = '';
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		else if (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		else if (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		// Next get the name of the useragent yes seperately and for good reason
		if (preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		else if(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		else if(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		else if(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		else if(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		else if(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		else if(stripos($_SERVER['HTTP_USER_AGENT'],'iPod'))
		{
			$bname = 'iPod';
			$ub = "iPod";
		}
		else if (stripos($_SERVER['HTTP_USER_AGENT'],'iPhone'))
		{
			$bname = 'iPhone';
			$ub = "iPhone";
		}
		else if (stripos($_SERVER['HTTP_USER_AGENT'],'iPad'))
		{
			$bname = 'iPad';
			$ub = "iPad";
		}
		else if (stripos($_SERVER['HTTP_USER_AGENT'],'Android'))
		{
			$bname = 'Android';
			$ub = "Android";
		}
		else {
			$bname = 'Inconnu';
			$ub = "Inconnu";
		}

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) { }
	   	# fix ie
	   	if ($bname != 'Inconnu') {
	   	# fix ie
			$i = count($matches['browser']);
			if ($i != 1) {
				if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) {
					$version= $matches['version'][0];
				} else {
					$version= $matches['version'][1];
				}
			}
			else {
				$version= $matches['version'][0];
			}
		} else {
			$version = null;
		}
		if ($version==null || $version=="") {$version="?";}
		return (object) array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'   => $pattern
		);
	}
}