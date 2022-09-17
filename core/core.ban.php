<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.1.0
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
}

final class _Ban
{
	public 	$author,
			$ip,
			$date,
			$reason;
	#####################################
	# Infos tables
	#####################################
	# TABLE_BAN
	#####################################
	function __construct()
	{
		$this->author = isset($_SESSION['USER']['HASH_KEY']) ? $_SESSION['USER']['HASH_KEY'] : '';
		$this->ip     = Common::GetIp();
		$this->date   = time();
		$this->reason = null;
	}

	public function effective ()
	{
		$get = self::getBan();
		if (!empty($get)) {
			if (strtotime($get->date) - $this->date <= 1) {
				self::delete();
				return true;
			} else {
				self::update();
				return false;
			}			
		} else {
			return true;
		}
	}

	private function getBan ()
	{
		$sql = New BDD;
		$sql->table('TABLE_BAN');
		$where = "WHERE `author` = '".$this->author."' OR `ip`= '".$this->ip."'";
		$sql->where($where);
		$sql->queryOne();
		return $sql->data;
	}

	private function update ()
	{
		$upd['author'] = $this->author;
		$upd['ip']     = $this->ip;
		$sql = New BDD();
		$sql->table('TABLE_BAN');
		$where = "WHERE `author` = '".$this->author."' OR `ip`= '".$this->ip."'";
		$sql->where($where);
		$sql->sqlData($upd);
		$sql->update();
	}

	private function delete ()
	{
		$sql = New BDD();
		$sql->table('TABLE_BAN');
		$where = "WHERE `author` = '".$this->author."' OR `ip`= '".$this->ip."'";
		$sql->where($where);
		$sql->delete();
	}
}