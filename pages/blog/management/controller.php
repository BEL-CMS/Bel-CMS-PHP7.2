<?php
/**
 * Bel-CMS [Content management system]
 * @version 0.3.0
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

	public 	$data,
			$view,
			$pagination,
			$error = null;

	function __construct($id = null)
	{
		parent::__construct();

		if (isset($_SESSION['pages']->blog->config['MAX_BLOG_ADMIN'])) {
			$this->nbpp = (int) $_SESSION['pages']->blog->config['MAX_BLOG_ADMIN'];
		} else {
			$this->nbpp = (int) 25;
		}
	}

	public function index ()
	{
		//$set['pagination'] = $this->pagination($this->nbpp, GET_PAGE, TABLE_PAGES_BLOG);
		$set['data'] = $this->ModelsBlog->GetBlog();
		$this->set($set);
		$this->render('index');
	}

	public function send ()
	{
		if ($_POST['send'] == 'blog') {
			$return = $this->ModelsBlog->SendNew($_POST);
		} else if ($_POST['send'] == 'edit') {
			$return = $this->ModelsBlog->SendEdit($_POST);
		} else if ($_POST['send'] == 'parameter') {
			$return = $this->ModelsBlog->UpdateParameter($_POST);
		}
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Blog?management', 2);
	}

	public function newblog ()
	{
		$this->render('new');
	}

	public function parameter ()
	{
		$this->render('parameter');
	}

	public function del ($id)
	{
		$return = $this->ModelsBlog->DelNew($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('Blog?management', 2);
	}

	public function edit ($id)
	{
		$set['data'] = $this->ModelsBlog->GetBlog($id);
		$this->set($set);
		$this->render('edit');
	}
}
