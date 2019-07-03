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

class Forum extends AdminPages
{
	var $active = true;
	var $models = array('ModelsForum');

	public function index ()
	{
		$data['data'] = $this->ModelsForum->GetThreads();
		$this->set($data);
		$this->render('index');
	}

	public function addforum ()
	{
		$data['data'] = $this->ModelsForum->GetForum();
		$this->set($data);
		$this->render('addforum');
	}
	# Send
	public function send ()
	{
		if ($_POST['send'] == 'addforum') {
			$return = $this->ModelsForum->SendAddForum($_POST);
		} else if ($_POST['send'] == 'editforum') {
			$return = $this->ModelsForum->SendEditForum($_POST);
		} else if ($_POST['send'] == 'addcat') {
			if ($this->ModelsForum->isCat()) {
				$return = $this->ModelsForum->SendAddCat($_POST);
			} else {
				$this->error(get_class($this), ERROR_NO_CAT, 'infos');
			}
		} elseif ($_POST['send'] == 'editcat') {
			$return = $this->ModelsForum->SendEditCat($_POST);
		}

		$this->error(get_class($this), $return['text'], $return['type']);

		Common::Redirect('Forum?management&page=true', 2);
	}
}