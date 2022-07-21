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

class ModelsCalendar
{
	#####################################
	# Infos tables
	#####################################
	#####################################
	# TABLE_EVENTS
	# TABLE_EVENTS_CAT
	#####################################
	public function sendadd ($data = null)
	{
		if ($data !== false) {
			
		} else {
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_NEWCAT_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_NEWCAT_ERROR
				);
			}
		}
	}

	public function sendnewcat ($data)
	{
		if ($data !== false) {
			// SECURE DATA
			$send['name']  = Common::VarSecure($data['name'], '');
			$send['color'] = Common::VarSecure($data['color']);
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_EVENTS_CAT');
			$sql->sqlData($send);
			$sql->insert();
			// SQL RETURN NB INSERT
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => SEND_NEWCAT_SUCCESS
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => SEND_NEWCAT_ERROR
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
}