<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link https://bel-cms.be
 * @link https://stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2019 Bel-CMS
 * @author Stive - determe@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class Notification
{
	public static function alert($text = NO_TEXT_DEFINED, $title = INFO)
	{
		echo self::render(null, $text, $title);
	}
	public static function error ($text = NO_TEXT_DEFINED, $title = ERROR)
	{
		echo self::render ('error', $text, $title);
	}
	public static function warning ($text = NO_TEXT_DEFINED, $title = WARNING)
	{
		echo self::render ('warning', $text, $title);
	}
	public static function success ($text = NO_TEXT_DEFINED, $title = SUCCESS)
	{
		echo self::render ('success', $text, $title);
	}
	private static function render ($type = null, $text = 'BEL-CMS : Alert neutral', $title = 'Alert !')
	{
		$render  = '<div class="belcms_box_notification '.$type.' ">';
		$render .= '<strong>'.$title.'</strong>';
		$render .= $text;
		$render .= '</div>';

		return $render;
	}
}
