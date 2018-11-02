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

final class Common
{
	#########################################
	# define constant array or simple name
	#########################################
	public static function Constant ($data = false, $value = false)
	{
		if ($data) {
			if (is_array($data)) {
				foreach ($data as $constant => $tableName) {
					if (!defined(strtoupper($constant))) {
						$constant = trim($constant);
						define(strtoupper($constant), $tableName);
					}
				}
			} else {
				if ($value || $data) {
					if (!defined(strtoupper($data))) {
						$data = trim($data);
						define(strtoupper($data), $value);
					}
				}
			}
		}
	}
	#########################################
	# return translate if exist
	#########################################
	public static function translate ($data, $ucfirst = true) {
		$str  = $data;
		$data = self::makeConstant($data);
		$data = strtoupper($data);
		if (defined($data)) {
			$return = $ucfirst === true ? ucfirst(constant($data)) : $str;
		} else {
			$return = $ucfirst === true ? ucfirst($str) : $str;
		}
		return $return;
	}
	#########################################
	# clear url and constant name
	#########################################
	public static function MakeConstant ($d, $c = false) {
		$chr = array(
			'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', '@' => 'a',
			'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
			'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
			'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
			'Œ' => 'oe', 'œ' => 'oe',
			'$' => 's', '&' => '_AND_', '?' => '%3F');
		$return = strtr($d, $chr);
		$return = preg_replace('#[^A-Za-z0-9]+#', '_', $return);
		$return = trim($return, '-');
		if ($c == 'upper') {
			$return = strtoupper($return);
		} else if ($c == 'lower'){
			$return = strtolower($return);
		}
		return $return;
	}
}

