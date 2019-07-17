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
# TABLE_INTERACTION
final class Interaction
{
	function __construct()
	{
		$this->user = $_SESSION['USER']['HASH_KEY'];
	}

	public function user ($hash_key = null) {
		if ($user !== null && strlen($hash_key) == 32) {
			$this->user = $user;
		}
	}

	public function type ($type = 'infos')
	{
		if ($type == 'infos') {
			$this->type = 'infos';
		} else if ($type == 'error') {
			$this->type = 'error';
		} else if ($type == 'success') {
			$this->type = 'success';
		} else if ($type == 'warning') {
			$this->type = 'warning';
		} else {
			$this->type = 'error';
		}
	}

	public function text ($text = null)
	{
		$this->text = Common::VarSecure($text, 'html');
	}

	public function date ($date = null)
	{
		$this->date = date("Y-m-d H:i:s");
	}

	public function insert ()
	{
		/* Data */
		$insert['author'] = $this->user;
		$insert['type']   = $this->type;
		$insert['text']   = $this->text;
		$insert['date']   = $this->date;
		/* BDD */
		$sql = New BDD();
		$sql->table('TABLE_INTERACTION');
		$sql->sqlData($insert);
		$sql->insert();
	}

	public function get ()
	{
		$sql = New BDD();
		$sql->table('TABLE_INTERACTION');
		$sql->queryAll();

		return $sql->data;
	}
}