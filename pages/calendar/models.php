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
	public function get()
	{
		$sql = New BDD();
		$sql->table('TABLE_EVENTS');
		$sql->isObject(false);
		$sql->queryAll();
		$events = array();
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
					$end_day   = date('Y-m-d', strtotime($db_event['end_date']));
					$event->duration = ceil(abs(strtotime($end_day) - strtotime($start_day)) / 86400) + 1; // Get event's duration = days between start date and end date.
				}
			}
			$event->time = $db_event['end_time'] ? $db_event['start_time'] . ' - ' . $db_event['end_time'] : $db_event['start_time'];
			$event->color = $db_event['color'];
			$event->location = $db_event['location'];
			$event->description = nl2br($db_event['description']);
			
			array_push($events, $event);
		}

		return $events;
	}
}