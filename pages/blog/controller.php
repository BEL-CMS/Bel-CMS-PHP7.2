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
				$data = $this->ModelsBlog->GetLastBlog();
				echo json_encode($data);
			}
		} else {
			echo json_encode(null);
		}
	}
}
