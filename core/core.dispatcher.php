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

class Dispatcher
{
	var $params;
	var $GetNamePage;
	var $GetNameView;

	function __construct()
	{
		$this->params      = isset($_GET['params']) && !empty($_GET['params']) ? explode('/', strtolower(rtrim($_GET['params'], '/'))) : array();
		$this->GetNamePage = self::GetNamePage();
		$this->GetNameView = self::GetNameView();
	}
	#########################################
	# Get link
	#########################################
	private static function GetLinkParams ()
	{
		return isset($_GET['params']) && !empty($_GET['params']) ? explode('/', strtolower(rtrim($_GET['params'], '/'))) : array();
	}
	#########################################
	# Get Name Page 
	#########################################
	public static function GetNamePage ()
	{
		$return = 'blog';
		$linkAction = self::GetLinkParams([0]);

		if (isset($linkAction) && !empty($linkAction)) {
			$return = $linkAction;
		}

		return $return; // return le nom de la page  (blog par défaut) => pages/$return
	}
	#########################################
	# Get Name View 
	#########################################
	public static function GetNameView ()
	{
		$return = 'index';
		$linkAction = self::GetLinkParams([1]);

		if (isset($linkAction) && !empty($linkAction)) {
			$return = $linkAction;
		}

		return $return; // return l'action de la page => pages/page/$return/
	}
	#########################################
	# Get ID
	#########################################
	public static function GetId ()
	{
		$return = null;
		$linkAction = self::GetLinkParams([2]);
	
		if (isset($linkAction) && !empty($linkAction)) {
			if (is_numeric($linkAction)) {
				$return = intval($linkAction); // autorise que du numérique 
			}
		}

		return $return; // return ID
	}
	#########################################
	# Set page
	#########################################
	public static function RequestPages ()
	{
		if (isset($_GET['page']) AND is_numeric($_GET['page'])) {
			$return = intval($_GET['page']);
		} else {
			$return = 1;
		}
		return $return; // Return la nombre de la page
	}
	#########################################
	# Get custom name 
	#########################################
	public static function GetName ()
	{
		$return = null;
		$linkAction = self::GetLinkParams([3]);
	
		if (isset($linkAction) && !empty($linkAction)) {
			$return = strip_tags($linkAction); // interdit tout html/php
		}

		return $return; // return le nom réel (Référencement uniquement, jamais utilisé, uniquement l'ID pour plus de sécurité)
	}
	#########################################
	# Test return data in json
	#########################################
	public static function IsJson ()
	{
		$return = false;
		if (isset($_GET['json'])) {
			$return = true;
		}
		return $return; // return true, si les données doivent être traitée comme du json
	}
	#########################################
	# Test return data in json
	#########################################
	public static function IsEcho ()
	{
		$return = false;
		if (isset($_GET['echo'])) {
			$return = true;
		}
		return $return; // return true, si les données doivent être traitée comme un echo simple affichage
	}
}