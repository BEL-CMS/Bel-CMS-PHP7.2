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

final class Visitors extends Dispatcher
{
	private $visitorHour,
			$visitorMinute,
			$visitorDay,
			$visitorMonth,
			$visitorYear,
			$visitorBrowser,
			$visitorRefferer,
			$visitedPage,
			$visitedUser;

	function __construct ($json = false)
	{
		parent::__construct();
		# json {Android}
		if (!empty($json)) {
			$this->visitorBrowser  = $json->getBrowserType;
		} else {
			$this->visitorBrowser  = self::getBrowserType()->name;
		}
		# Var
		$this->visitorHour     = date('G');
		$this->visitorMinute   = date('i');
		$this->visitorDay      = date('d');
		$this->visitorMonth    = date('m');
		$this->visitorYear     = date('Y');
		$this->visitorRefferer = gethostbyname(Common::GetIp());
		$this->visitedPage     = $this->controller;
		if (!empty($json)) {
			$this->visitedUser = $json->hash_key;
		} else {
			if (Users::isLogged() === true) {
				$this->visitedUser = $_SESSION['USER']['HASH_KEY'];
			} else {
				if (preg_match('/([bB]ot|[sS]pider|[yY]ahoo|[gG]oggle)/i', $_SERVER["HTTP_USER_AGENT"] )) {
					$this->visitedUser = $_SERVER["HTTP_USER_AGENT"];
				} else {
					$this->visitedUser = Users::isLogged() === true ? $_SESSION['USER']['HASH_KEY'] : VISITOR;
				}
			}
		}
		# data insert
		$this->insertBdd();
	}

	private function insertBdd () {
		# Where datetime - 5min
		$where[] = array(
			'name' => 'visitor_ip',
			'value'=> Common::GetIp()
		);
		$where[] = array(
			'name' => 'visitor_day',
			'value'=> $this->visitorDay
		);
		$where[] = array(
			'name' => 'visitor_month',
			'value'=> $this->visitorMonth
		);
		$where[] = array(
			'name' => 'visitor_year',
			'value'=> $this->visitorYear
		);
		# table count <1
		$sql = New BDD;
		$sql->table('TABLE_VISITORS');
		$sql->where($where);
		$sql->queryAll();
		$return = count($sql->data);
		unset($sql); unset($where);
		# Mise à jour
		$this->return = $return;
		if ($return == 0) {
			# data insert
			$insert['visitor_ip']       = Common::GetIp();
			$insert['visitor_user']     = $this->visitedUser;
			$insert['visitor_browser']  = $this->visitorBrowser;
			$insert['visitor_hour']     = $this->visitorHour;
			$insert['visitor_minute']   = $this->visitorMinute;
			$insert['visitor_date']     = date("Y-m-d H:i:s");
			$insert['visitor_day']      = $this->visitorDay;
			$insert['visitor_month']    = $this->visitorMonth;
			$insert['visitor_year']     = $this->visitorYear;
			$insert['visitor_refferer'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
			$insert['visitor_page']     = $this->visitedPage;
			# SQL Insert
			$sql = New BDD;
			$sql->table('TABLE_VISITORS');
			$sql->sqlData($insert);
			$sql->insert();
		} else {
			$where[] = array(
				'name'  => 'visitor_ip',
				'value' => Common::GetIp()
			);
			$where[] = array(
				'name' => 'visitor_day',
				'value'=> date('d')
			);
			$where[] = array(
				'name' => 'visitor_month',
				'value'=> date('m')
			);
			$where[] = array(
				'name' => 'visitor_year',
				'value'=> date('Y')
			);
			$update['visitor_user']   = $this->visitedUser;
			$update['visitor_hour']   = $this->visitorHour;
			$update['visitor_hour']   = $this->visitorHour;
			$update['visitor_minute'] = $this->visitorMinute;
			$update['visitor_page']   = $this->visitedPage;
			$update['visitor_date']   = date("Y-m-d H:i:s");
			# SQL Update
			$sql = New BDD;
			$sql->table('TABLE_VISITORS');
			$sql->where($where);
			$sql->sqlData($update);
			$sql->update();
		}
	}

	public static function getVisitorDay () {
		$sql = New BDD;
		$sql->table('TABLE_VISITORS');
		$sql->where(array(
			'name'  => 'visitor_day',
			'value' => date('d'),
			'op'    => ' = '
		));
		$sql->queryAll();
		$data   = $sql->data;
		$count  = count($sql->data);

		$return = (object) array(
			'data'  => $data,
			'count' => $count
		);

		return $return;
	}

	public static function getVisitorConnected () {
		# connected current time < -5min
		$sql = New BDD;
		$sql->table('TABLE_VISITORS');
		$sql->where(array(
			'name'  => 'visitor_date',
			'value' => date('Y-m-d H:i:s', strtotime('-5 min')),
			'op'    => ' >= '
		));
		$sql->queryAll();
		$data   = $sql->data;
		$count  = count($sql->data);

		$return = (object) array(
			'data'  => $data,
			'count' => $count
		);

		return $return;
	}

	public static function getVisitorYesterday () {
		# connected current time < - 1 day
		$visitor_last = date('d', strtotime('-1 days'));

		$sql = New BDD;
		$sql->table('TABLE_VISITORS');
		$sql->where(array(
			'name'  => 'visitor_day',
			'value' => $visitor_last
		));
		$sql->queryAll();
		$data   = $sql->data;
		$count  = count($sql->data);

		$return = (object) array(
			'data'  => $data,
			'count' => $count
		);

		return $return;
	}

	private function selfURL () {
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = self::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}

	private function strleft ($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
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
		} else {
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
