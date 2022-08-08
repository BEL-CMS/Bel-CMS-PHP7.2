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
			// SECURE DATA
			$send['name']        = Common::VarSecure($data['name'], '');
			$send['color']       = Common::VarSecure($data['color']);
			$send['start_date']  = Common::DatetimeSQL($data['start_date']);
			$send['end_date']    = Common::DatetimeSQL($data['start_date']);
			$send['start_time']  =
			$send['end_time']    =
			$send['location']    = Common::VarSecure($data['location'], '');
			$send['description'] = Common::VarSecure($data['name'], 'html');
			// SQL INSERT
			$sql = New BDD();
			$sql->table('TABLE_EVENTS');
			$sql->sqlData($send);
			$sql->insert();
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
				'type' => 'error',
				'text' => ERROR_INSERT_BDD
			);
		}
		return $return;
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

	public function getEvents ()
	{
		$sql = New BDD();
		$sql->table('TABLE_EVENTS');
		$sql->isObject(false);
		$sql->queryAll();
		$events = array();
		debug($sql->data);
		foreach ($sql->data as $db_event) {
			$event = new stdClass();
			$event->title = $db_event['name'];
			$event->image = $db_event['image'];
			
			$event->day   = date('j', strtotime($db_event['start_date']));
			$event->month = date('n', strtotime($db_event['start_date']));
			$event->year  = date('Y', strtotime($db_event['start_date']));
			if (!$db_event['end_date'] || ($db_event['end_date'] == '0000-00-00')) {
				$event->duration = 1; // If end_time is blank -> event's duration = 1 (day).	
			} else {
				if (date('Ymd', strtotime($db_event['start_date'])) == date('Ymd', strtotime($db_event['end_date']))) { // If start date and end date are same day -> event's duration = 1 (day).
					$event->duration = 1;
				} else {
					$start_day = date('Y-m-d', strtotime($db_event['start_date']));
					$end_day = date('Y-m-d', strtotime($db_event['end_date']));
					$event->duration = ceil(abs(strtotime($end_day) - strtotime($start_day)) / 86400) + 1; // Get event's duration = days between start date and end date.
				}
			}
			$event->time        = $db_event['end_time'] ? $db_event['start_time'] . ' - ' . $db_event['end_time'] : $db_event['start_time'];
			$event->color       = $db_event['color'];
			$event->location    = $db_event['location'];
			$event->description = nl2br($db_event['description']);
			
			array_push($events, $event);
		}
		return;
	}
}