<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.0.1
 * @link http://www.bel-cms.be
 * @link http://www.stive.eu
 * @license http://opensource.org/licenses/GPL-3.0 copyleft
 * @copyright 2014-2016 Bel-CMS
 * @author Stive - mail@stive.eu
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class Blog extends Pages
{
	var $models = array('ModelsBlog');

	function index ()
	{

		$config = BelCMSConfig::GetConfigPage('blog');
		$set['pagination'] = $this->pagination($config->config['MAX_BLOG'], 'blog', TABLE_PAGES_BLOG);
		$set['blog'] = $this->ModelsBlog->GetBlog();
		$this->set($set);
		$this->render('index');
	}

	function readmore ($name = false, $id = false)
	{
		$set = array();
		$set['blog'] = $this->ModelsBlog->GetBlog($id);

		if (!is_object($set['blog']) && $set['blog'] == 0) {
			$this->error(BLOG, NAME_OF_THE_UNKNOW, 'error');
			return;
		} else {
			$this->ModelsBlog->NewView($id);
		}
		$this->set($set);
		$this->render('readmore');
	}

	function json ($api_key)
	{
		if (defined('API_KEY')) {
			if (!empty($api_key) && $api_key == constant('API_KEY')) {
				echo json_encode($this->ModelsBlog->GetLastBlog());
			}
		} else {
			echo json_encode(null);
		}
	}
}
