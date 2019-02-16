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
#########################################
# Notification Alert (red, blue, green, orange)
#########################################
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
	public static function infos ($text = NO_TEXT_DEFINED, $title = INFO)
	{
		echo self::render ('infos', $text, $title);
	}
	private static function render ($type = null, $text = 'BEL-CMS : Alert neutral', $title = 'Alert !')
	{

		$render  = '<section class="belcms_notification">';
		$render .= '<header class="belcms_notification_header '.$type.'">';
		$render .= '<i class="fas fa-exclamation-triangle"></i>';
		$render .= '<span>'.$title.'</span>';
		$render .= '</header>';
		$render .= '<div class="belcms_notification_msg">';
		$render .= $text;
		$render .= '</div> ';
		$render .= '</section>';
		return $render;
	}
}
