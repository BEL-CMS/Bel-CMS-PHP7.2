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

class Articles extends Pages
{
	var $models = array('ModelsArticles');

	function index ()
	{
		$config = BelCMSConfig::GetConfigPage('articles');
		$set['pagination'] = $this->pagination($config->config['MAX_ARTICLES'], 'articles', TABLE_PAGES_ARTICLES);
		$set['articles'] = $this->ModelsArticles->getArticles();
		$this->set($set);
		$this->render('index');
	}

	function readmore ($name = false, $id = false)
	{
		$set = array();
		$set['articles'] = $this->ModelsArticles->getArticles($id);

		if (!is_object($set['articles']) && $set['articles'] == 0) {
			$this->error(get_class($this), NAME_OF_THE_UNKNOW, 'error');
			return;
		} else {
			$this->ModelsArticles->NewView($id);
		}
		$this->set($set);
		$this->render('readmore');
	}

	function json ($api_key)
	{
		if (defined('API_KEY')) {
			if (!empty($api_key) && $api_key == constant('API_KEY')) {
				$data = $this->ModelsArticles->getLastArticles();
				echo json_encode($data);
			}
		} else {
			echo json_encode(null);
		}
	}
}
