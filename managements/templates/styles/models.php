<?php
/**
 * Bel-CMS [Content management system]
 * @version 2.0.0
 * @link http://bel-cms.dev
 * @link http://determe.be
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2022 Bel-CMS
 * @author Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

final class ModelsStyles
{
	#########################################
	# Recupere le styles.css de la page
	#########################################
	public function getStylesCss ($name = null)
	{
		$filename = DIR_PAGES.$name.DS.'css'.DS.'styles.css';
		$dirName  = DIR_PAGES.$name.DS.'css';
		if (is_file($filename)) {
			$fileContent = file_get_contents($filename, true);
		} else {
			if (!file_exists($dirName)) {
				mkdir($dirName, 0777, true);
			}
			fopen($filename, 'w');
			self::getStylesCss($name);
		}
		return $fileContent;
	}
	#########################################
	# Enregistre le styles.css de la page
	#########################################
	public function sendEditCss ($data = null, $page)
	{
		if ($data != null && $page) {
			$filename = DIR_PAGES.$page.DS.'css'.DS.'styles.css';
			$dirName  = DIR_PAGES.$page.DS.'css';
			if (!file_exists($dirName)) {
				mkdir($dirName, 0777, true);
			}
			if (is_writable($dirName) === false) {
				$return = array('type' => 'error', 'text' => "Erreur impossible d'enregistrement sur le fichier", 'title' => 'Templates');
			} else {
				if (is_file($filename)) {
					@chmod($filename, 0700);
					unlink($filename);
				}
				$data = Common::VarSecure($data, null);
				$fp = fopen ($filename, "w+");
				fwrite($fp,$data);
				fclose($fp);
				@chmod($filename, 0644);
				$return = array('type' => 'success', 'text' => "L'enregistrement a été effectué avec succès.", 'title' => 'Templates');	
			}
		} else {
			$return = array('type' => 'error', 'text' => 'Error no data', 'title' => 'Styles');
		}
		return $return;
	}
	#########################################
	# Recupere le styles.css du widgets
	#########################################
	public function getStylesCssWidgets ($name = null)
	{
		$filename = DIR_WIDGETS.$name.DS.'css'.DS.'styles.css';
		$dirName  = DIR_WIDGETS.$name.DS.'css';
		if (is_file($filename)) {
			$fileContent = file_get_contents($filename, true);
		} else {
			if (!file_exists($dirName)) {
				mkdir($dirName, 0777, true);
			}
			fopen($filename, 'w');
			self::getStylesCssWidgets($name);
		}
		return $fileContent;
	}
	#########################################
	# Enregistre le styles.css de la page
	#########################################
	public function sendEditCssWidget ($data = null, $page)
	{
		if ($data != null && $page) {
			$filename = DIR_WIDGETS.$page.DS.'css'.DS.'styles.css';
			$dirName  = DIR_WIDGETS.$page.DS.'css';
			if (!file_exists($dirName)) {
				mkdir($dirName, 0777, true);
			}
			if (!file_exists($filename)) {
				mkdir($filename, 0777, true);
			}
			if (is_writable($dirName) === false) {
				$return = array('type' => 'error', 'text' => "Erreur impossible d'enregistrement sur le fichier", 'title' => 'Templates');
			} else {
				if (is_file($filename)) {
					@chmod($filename, 0700);
					unlink($filename);
				}
				$data = Common::VarSecure($data, null);
				$fp = fopen ($filename, "w+");
				fwrite($fp,$data);
				fclose($fp);
				@chmod($filename, 0644);
				$return = array('type' => 'success', 'text' => "L'enregistrement a été effectué avec succès.", 'title' => 'Templates');	
			}
		} else {
			$return = array('type' => 'error', 'text' => 'Error no data', 'title' => 'Styles');
		}
		return $return;
	}
}