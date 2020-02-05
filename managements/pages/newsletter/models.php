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
###  TABLE_NEWSLETTER
#-> id, name, email, sendmail
#	TABLE_NEWSLETTER_TPL
#-> id, name, template, author, date
#	TABLE_NEWSLETTE_SEND
#->	id, template, author, date 
class ModelsNewsletter
{
	public function addnewtpl ($data)
	{
		if ($data !== false) {
			// SECURE DATA
			$send['name']     = Common::VarSecure($data['name'], ''); // autorise que du texte
			$send['template'] = Common::VarSecure($data['template'], 'html'); // autorise que les balises HTML
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_NEWSLETTER_TPL');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_TEMPLATE_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_TEMPLATE_ERROR
				);
			}
		} else {
			$return = array(
				'type' => 'warning',
				'text' => ERROR_NO_DATA
			);
		}

		return $return;
	}

	public function getAllTpl ()
	{
		$return = array();

		$sql = New BDD;
		$sql->table('TABLE_NEWSLETTER_TPL');
		$sql->queryAll();

		if ($sql->data) {
			$return = $sql->data;
		}

		return $return;
	}

}