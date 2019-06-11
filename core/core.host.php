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

final class GetHost {
	public static function getBaseUrl() {
		$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
		$tmpURL   = dirname(__FILE__);
		$tmpURL   = str_replace(chr(92),'/',$tmpURL);
		$tmpURL   = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
		$tmpURL   = ltrim($tmpURL,'/');
		$tmpURL   = rtrim($tmpURL, '/');

		if (strpos($tmpURL,'/')) {
			$tmpURL = explode('/',$tmpURL);
			$tmpURL = $tmpURL[0];
		}

		$tmpURL = str_replace('core', '', $tmpURL);

		if ($tmpURL !== $_SERVER['HTTP_HOST']) {
			$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
		} else {
			$base_url .= $tmpURL;
		}

		return $base_url;
	}
}
