<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2015-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class _Ban
{
	public 	$author,
			$ip,
			$number,
			$reason;
	#####################################
	# Infos tables
	#####################################
	# TABLE_BAN
	#####################################
	function __construct()
	{
		$this->author   = isset($_SESSION['USER']['HASH_KEY']) ? $_SESSION['USER']['HASH_KEY'] : '';
		$this->ip       = Common::GetIp();
		$this->number   = time();
		$this->reason   = null;
	}

	public function effective ()
	{
		$get = self::getBan();
		if (empty($get)) {
			return true;
		} else {
			self::update();
			return false;			
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
}