<?php
/**
 * Bel-CMS [Content management system]
 * @version 1.0.0
 * @link https://bel-cms.be
 * @link https://determe.be
 * @license http://opensource.org/licenses/GPL-3.-copyleft
 * @copyright 2014-2021 Bel-CMS
 * @author as Stive - stive@determe.be
 */

if (!defined('CHECK_INDEX')) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
	exit(ERROR_INDEX);
}

class ModelsDonates
{
	#####################################
	# Infos tables
	#####################################
	# TABLE_USERS
	# TABLE_PAYPAL_ACCEPTE
	#####################################
	public function GetUsers ()
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_USERS');
		$sql->orderby(array(array('name' => 'username', 'type' => 'ASC')));
		$sql->fields(array('username', 'hash_key'));
		$sql->queryAll();
		$return = $sql->data;
		unset($sql);

		return $return;
	}

	public function getDons ()
	{
		$return = array();

		$sql = New BDD();
		$sql->table('TABLE_PAYPAL_ACCEPTE');
		$sql->orderby(array(array('name' => 'id', 'type' => 'ASC')));
		$sql->queryAll();
		$return = $sql->data;
		unset($sql);

		return $return;
	}

	public function senddon ($data)
	{
		$return = array(
			'type' => 'warning',
			'text' => 'Erreur durant l\'enregistrement'
		);

		$send['hash_key'] = Common::hash_key($data['hash_key']) ? $data['hash_key'] : '00000000000000000000000000000000';
		$send['date']     = $data['date'];
		$send['montant']  = Common::VarSecure($data['euros']);
		// SQL INSERT
		$sql = New BDD();
		$sql->table('TABLE_PAYPAL_ACCEPTE');
		$sql->sqlData($send);
		$sql->insert();
		// SQL RETURN NB UPDATE
		if ($sql->rowCount == 1) {
			$return = array(
				'type' => 'success',
				'text' => 'Don ajouter avec succès'
			);
		############ Interaction ############ 
		$Interaction = New Interaction;
		$Interaction->user($_SESSION['USER']['HASH_KEY']);
		$Interaction->title('Don ajouter avec succès');
		$Interaction->type('success');
		$Interaction->text('Don de '.$send['montant'].' € ajouter par '.Users::hashkeyToUsernameAvatar($_SESSION['USER']['HASH_KEY']).'');
		$Interaction->insert();
		############ Interaction ############ 
		} else {
			$return = array(
				'type' => 'warning',
				'text' => 'Erreur lors de l\'ajout du don'
			);
		}
		return $return;
	}

	public function sendparameter ($data)
	{
		$return = array();

		if (!empty($data) && is_array($data)) {
			if (!isset($data['JS'])) {
				$data['JS'] = 0;
			}
			if (!isset($data['CSS'])) {
				$data['CSS'] = 0;
			}
			$opt                  = array('JS' => $data['JS'], 'CSS' => $data['CSS']);
			$upd['config']        = Common::transformOpt($opt, true);
			$upd['title']         = Common::VarSecure($data['title'], '');
			$upd['groups_access'] = implode("|", $data['groups']);
			$upd['groups_admin']  = implode("|", $data['admin']);
			$upd['active']        = isset($data['active']) ? 1 : 0;
			if ($data['pos'] == 'top') {
				$upd['pos'] = 'top';
			} else if ($data['pos'] == 'bottom') {
				$upd['pos'] = 'bottom';
			} else if ($data['pos'] == 'left') {
				$upd['pos'] = 'left';
			} else if ($data['pos'] == 'right') {
				$upd['pos'] = 'right';
			} else {
				$upd['pos'] = 'right';
			}
			$upd['pages']  = implode("|", $data['pages']);
			// SQL UPDATE
			$sql = New BDD();
			$sql->table('TABLE_WIDGETS');
			$sql->where(array('name' => 'name', 'value' => 'donates'));
			$sql->sqlData($upd);
			$sql->update();
			if ($sql->rowCount == 1) {
				$return = array(
					'type' => 'success',
					'text' => 'Update des parametre avec succès'
				);
			} else {
				$return = array(
					'type' => 'warning',
					'text' => 'Erreur lors de l\'enregistrement des parametre'
				);
			}
		} else {
			$return = array(
				'type' => 'warning',
				'text' => ERROR_NO_DATA
			);
		}

		return $return;
	}
}