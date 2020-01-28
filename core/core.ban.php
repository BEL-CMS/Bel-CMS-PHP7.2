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

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class Ban
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
			if ($get->date - $this->date <= 1) {
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