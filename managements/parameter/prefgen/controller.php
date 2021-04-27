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

class prefgen extends AdminPages
{
	var $active = true;
	var $models = array('ModelsPrefGen');

	public function index ()
	{
		$menu[] = array('Accueil'=> array('href'=>'prefgen?management&parameter=true','icon'=>'fa fa-home'));
		$data['form'] = $this->ModelsPrefGen->getData();
		$this->set($data);
		$this->render('index', $menu);
	}

	public function send ()
	{
		$return = $this->ModelsPrefGen->send($_POST);
		$this->error('Parametres', $return['text'], $return['type']);
		$this->redirect('prefgen?management&parameter=true', 3);
	}

	private function form ()
	{
		$formText     = array('CMS_WEBSITE_NAME', 'CMS_WEBSITE_DESCRIPTION', 'CMS_MAIL_WEBSITE', 'CMS_WEBSITE_KEYWORDS');
		$formRadio    = array(
			'CMS_JQUERY'      => array('on', 'off'),
			'CMS_JQUERY_UI'   => array('on', 'off'),
			'CMS_BOOTSTRAP'   => array('on', 'off'),
			'CMS_TPL_WEBSITE' => self::getTpl()
		);
		$cms_tpl_full   = Common::ScanDirectory(DIR_PAGES);
		$cms_tpl_full[] = 'readmore';
		$formCheckbox = array(
			'CMS_TPL_FULL'    => $cms_tpl_full
		);

		$sql = New BDD();
		$sql->table('TABLE_CONFIG');
		$sql->orderby(array(array('name' => 'name', 'type' => 'DESC')));
		$sql->queryAll();
		$return = $sql->data;

		$form  = '';

		foreach ($return as $d) {
			$input = '';
			$name  = (defined('ADMIN_'.$d->name)) ? constant('ADMIN_'.$d->name) : $d->name;
			$help  = (defined('ADMIN_'.$d->name.'_HELP')) ? constant('ADMIN_'.$d->name.'_HELP') : null;
			if (in_array($d->name, $formText)) {
				$input = '<div class="form-group"><input name="'.$d->id.'" type="text" class="form-control" id="label_'.$d->id.'" value="'.$d->value.'"></div>';
			} else if (array_key_exists($d->name, $formRadio)) {
				foreach ($formRadio[$d->name] as $a) {
					$checked = $a == $d->value ? 'checked="checked"' : '';
					$input .= '<div class="form-group">';
					$input .= '<div class="input-group">';
					$input .= '<div class="input-group-addon">';
					$input .= '<div class="checker">';
					$input .= '<input type="radio" name="'.$d->id.'" id="label_'.$d->id.'" value="'.$a.'" '.$checked.'>';
					$input .= '</div>';
					$input .= '</div>';
					$input .= '<input class="form-control" type="text" value="'.$a.'" readonly>';
					$input .= '</div>';
					$input .= '</div>';
				}
			} else if (array_key_exists($d->name, $formCheckbox)) {
				$value = explode(',', $d->value);
				foreach ($formCheckbox[$d->name] as $a) {
					$checked = in_array($a, preg_replace('/\s+/', '', $value)) ? 'checked="checked"' : '';
					$input .= '<div class="form-group">';
					$input .= '<div class="input-group">';
					$input .= '<div class="input-group-addon">';
					$input .= '<div class="checker">';
					$input .= '<input type="checkbox" name="'.$d->id.'[]" id="label_'.$d->id.'" value="'.$a.'" '.$checked.'>';
					$input .= '</div>';
					$input .= '</div>';
					$input .= '<input class="form-control" type="text" value="'.$a.'" readonly>';
					$input .= '</div>';
					$input .= '</div>';
				}
			} else {
				$input = '<div class="form-group"><input name="'.$d->id.'" type="text" class="form-control" id="label_'.$d->id.'" value="'.$d->value.'"></div>';
			}
			$form .= '<div class="form-group">';
			$form .= '<div class="card-alert alert alert-primary mb-0">'.$name.'</div>';
			$form .= '<div class="col-sm-10">';
			$form .= $input;
			$form .= $help;
			$form .= '</div>';
			$form .= '</div>';

			unset($name,$help, $input);
		}
		return $form;
	}
	private function getTpl ()
	{
		$return = Common::ScanDirectory(DIR_TPL);

		if (count($return) !== 0) {
			foreach ($return as $k => $n) {
				if (!is_file(DIR_TPL.$n.DS.'template.php')) {
					unset($return[$k]);
				}
			}
		}

		return $return;
	}
}