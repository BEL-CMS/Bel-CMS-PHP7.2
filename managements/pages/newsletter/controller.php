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

class Newsletter extends AdminPages
{
	var $admin  = true; // Admin suprême uniquement (Groupe 1);
	var $active = true; // activation manuel;
	var $models = array('ModelsNewsletter');

	public function index ()
	{
		$this->render('index');
	}

	public function send ()
	{
		$id = (int) $_POST['id'];
		$_SESSION['NEWSLETTER']['USER'] = $this->ModelsNewsletter->getAllNewser();
		$_SESSION['NEWSLETTER']['TPL']  = $this->ModelsNewsletter->getTpl($id);
		$this->error(get_class($this), 'Démarrage des e-mails dans 3 secondes', 'warning');
		$this->redirect('newsletter/start?management&pages', 3);
	}

	public function start ()
	{
		foreach ($_SESSION['NEWSLETTER']['USER'] as $key => $value) {
			$tpl = str_replace('{user}',Users::hashkeyToUsernameAvatar($value->name),$_SESSION['NEWSLETTER']['TPL']->template);
			$mail = array(
				'name'     => CMS_WEBSITE_NAME,
				'mail'     => CMS_MAIL_WEBSITE,
				'subject'  => 'NewsLetter - '.$_SESSION['NEWSLETTER']['TPL']->name,
				'content'  => $tpl,
				'sendMail' => $value->email
			);
			if (Common::SendMail($mail) != false) {
				$this->error(get_class($this), 'Newslleter envoyer avec succès à : '.$value->email, 'success');
				$this->redirect('newsletter/start?management&pages', 0);
				unset($_SESSION['NEWSLETTER']['USER'][$key]);
				return true;
			} else {
				$this->error(get_class($this), 'impossible d\'envoyer la Newslleter : '.$value->email, 'error');
				$this->redirect('newsletter?management&pages', 3);
				return false;
			}
		}
		if (empty($_SESSION['NEWSLETTER']['USER'])) {
			$this->error(get_class($this), 'Tout les emails ont été envoyer avec succès', 'success');
			$this->redirect('newsletter?management&pages', 3);
		}
	}

	public function prepa ()
	{
		$set['data'] = $this->ModelsNewsletter->getAllTpl();
		$this->set($set);
		$this->render('prepa');
	}

	public function tpl ()
	{
		$set['data'] = $this->ModelsNewsletter->getAllTpl();
		$this->set($set);
		$this->render('templates');
	}

	public function addtpl ()
	{
		$this->render('addtemplate');
	}

	public function sendnewtpl ()
	{
		$return = $this->ModelsNewsletter->addnewtpl($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('newsletter/tpl?management&pages', 2);
	}

	public function edittpl ($id)
	{
		$set['data'] = $this->ModelsNewsletter->getTpl($id);
		$this->set($set);
		$this->render('edittpl');
	}

	public function sendedittpl ()
	{
		$return = $this->ModelsNewsletter->sendEdit($_POST);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('newsletter/tpl?management&pages', 2);
	}

	public function deltpl ($id)
	{
		$return = $this->ModelsNewsletter->deletetpl($id);
		$this->error(get_class($this), $return['text'], $return['type']);
		$this->redirect('newsletter/tpl?management&pages', 2);
	}
}