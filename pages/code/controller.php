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

class Code extends Pages
{
	var $models = array('ModelsCode');

	public function index ()
	{
		if (!empty($_POST)) {
			$data['data'] = $this->ModelsCode->getSearch($_POST);
			$this->set($data);
		}
		$this->render('search');
	}

	public function php ()
	{
		$data['pagination'] = $this->pagination(25, 'code/php', TABLE_CODE);
		$data['data'] = $this->ModelsCode->getPhp();
		$this->set($data);
		$this->render('php');
	}

	public function html ()
	{
		$data['pagination'] = $this->pagination(25, 'code/html', TABLE_CODE);
		$data['data'] = $this->ModelsCode->getHtml();
		$this->set($data);
		$this->render('html');
	}

	public function css ()
	{
		$data['pagination'] = $this->pagination(25, 'code/css', TABLE_CODE);
		$data['data'] = $this->ModelsCode->getCss();
		$this->set($data);
		$this->render('css');
	}

	public function js ()
	{
		$data['pagination'] = $this->pagination(25, 'code/js', TABLE_CODE);
		$data['data'] = $this->ModelsCode->getJs();
		$this->set($data);
		$this->render('js');
	}

	public function page ($id = null, $name = null, $type = null)
	{
		if (!is_numeric($id)) {
			$this->error('Code', 'Tentative accès non autorisé, un administrateur à été prévenue.', 'error');
		} else {
			$type = Common::VarSecure($type, '');
			$id = (int) $id;
			$data['data'] = $this->ModelsCode->getPage($id);
			$this->set($data);
			$this->render('page');
		}
	}
}