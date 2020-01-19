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
	private $user,
			$type,
			$text,
			$title,
			$date;

	public function user ($hash_key = null) {
		if ($hash_key !== null && strlen($hash_key) == 32) {
			$this->user = $hash_key;
		} else {
			$this->user = false;
		}
	}

	public function type ($type = 'infos')
	{
		switch ($type) {
			case 'infos':
				$type = 'infos';
			break;
			case 'error':
				$type = 'error';
			break;
			case 'success':
				$type = 'success';
			break;
			case 'warning':
				$type = 'warning';
			break;
			default:
				$type = 'error';
			break;
		}
		$this->type = $type;
	}

	public function text ($text = null)
	{
		$this->text = Common::VarSecure($text, 'html');
	}

	private function date ()
	{
		$this->date = date("Y-m-d H:i:s");
	}

	public function title ($text)
	{
		$this->title = Common::VarSecure($text, '');
	}

	public function insert ()
	{
		/* Data */
		$insert['author'] = $this->user;
		$insert['type']   = $this->type;
		$insert['text']   = $this->text;
		$insert['date']   = $this->date;
		$insert['title']  = $this->title;
		/* BDD */
		$sql = New BDD();
		$sql->table('TABLE_INTERACTION');
		$sql->sqlData($insert);
		$sql->insert();
	}

	public static function get ()
	{
		$sql = New BDD();
		$sql->table('TABLE_INTERACTION');
		$sql->queryAll();

		return $sql->data;
	}
}