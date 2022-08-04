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
###  TABLE_NEWSLETTER
#->  id, name, email, sendmail
class ModelsNewsletter
{
	public function getuUersList ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_NEWSLETTER');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();
		$return = $sql->data;
		unset($sql);

		return $return;		
	}

	public function sendNew ($data)
	{
		$return = array();

		$send['name']     = $_SESSION['USER']['HASH_KEY'];
		$send['email']    = Secure::isMail($data['email']);
		$send['sendmail'] = 0;

		$get = New BDD;
		$get->table('TABLE_NEWSLETTER');
		$where = array(
			'name'  => 'email',
			'value' => $send['email']
		);
		$get->where($where);
		$get->queryAll();
		$get = $get->data;

		if (empty($get)){
			$sql = New BDD;
			$sql->table('TABLE_NEWSLETTER');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_NEWSLETTER_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_NEWSLETTER_ERROR
				);
			}			
		} else {
			$return = array(
				'type' => 'warning',
				'text' => SEND_EXIST_USER_ERROR
			);
		}

		return $return;
	}
}