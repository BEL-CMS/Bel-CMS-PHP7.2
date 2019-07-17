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

class Inbox extends Pages
{
	#####################################
	# Declaration variables
	#####################################
	var $models = array('ModelsInbox');
	#####################################
	# Get Index page for inbox
	#####################################
	public function index ()
	{
		if (Users::isLogged() === true) {
			$set['inbox'] = $this->ModelsInbox->getMessages();
			$this->set($set);
			$this->render('index');
		}
	}
	#####################################
	# Get message for inbox
	#####################################
	public function showMessage($id)
	{
		if (!is_numeric($id)) {
			$this->error(INBOX, ERROR_NO_ID, 'danger');
		} else {
			$set = $this->ModelsInbox->showMessage($id);
			if (array_key_exists('type', $set) && array_key_exists('text', $set)) {
				$this->error(INBOX, $set['text'], $set['type']);
			} else {
				if (count($set) == 0) {
					$this->error(INBOX, ERROR_NO_MESSAGE_EXIST, 'danger');
				} else {
					$set['inbox'] = $this->ModelsInbox->showMessage($id);
					$this->set($set);
					$this->render('show');
				}
			}
		}
	}
	#####################################
	# Get Users for new message
	#####################################
	public function getUsers ()
	{
		$search = $_GET['term'];
		echo json_encode(array('username' => $this->ModelsInbox->getUsers($search)));
	}
	#####################################
	# Send
	#####################################
	public function send ()
	{
		if (Users::isLogged() === true) {
			if ($this->data['send'] == 'new') {
				self::sendNewMessage();
			} else if ($this->data['send'] == 'reponse') {
				self::sendReponse();
			}
		}
	}
	#####################################
	# Send new message
	#####################################
	private function sendNewMessage ()
	{
		$return = $this->ModelsInbox->sendNewMessage($this->data['username'], $this->data['message']);
		$this->error(INBOX, $return['text'], $return['type']);
		$this->redirect('Inbox', 2);
	}
	#####################################
	# Send reponse message
	#####################################
	private function sendReponse ()
	{
		$return = $this->ModelsInbox->sendReponse($this->data['id'], $this->data['message']);
		$this->error(INBOX, $return['text'], $return['type']);
		$redirect = 'Inbox/ShowMessage/'.$return['id'];
		$this->redirect($redirect, 2);
	}
	#####################################
	# Get count message
	#####################################
	public function countUnreadMessage()
	{
		if (Users::isLogged() === true) {
			echo json_encode($this->ModelsInbox->countUnreadMessage());
		}
	}
}
