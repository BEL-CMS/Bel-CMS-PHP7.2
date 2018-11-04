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

final class Comment extends Dispatcher
{
	public 	$page,
			$view,
			$id,
			$count = 0,
			$html;

	function __construct($action = 'view', $page = null, $view = null, $id = null, $nb = 5)
	{
		parent::__construct();

		$this->page     = ($page == null) ? $this->controller : common::SecureRequest($page);
		$this->view     = ($view == null) ? $this->view : common::SecureRequest($view);
		$this->id       = ($id == null)   ? $this->id : common::SecureRequest($id);
		$this->nb       = (int) $nb;

		self::$action();
	}
	private function view ()
	{
		$comments = self::GetComments($this->page, $this->view, $this->id, $this->nb);
		$url      = $this->page.'/'.$this->view.'/'.$this->id;
		$user     = AutoUser::ReturnUser();
		if ($user !== false) {
			$form =  '<form class="alertAjaxForm" action="comments/send&ajax" method="post">';
			$form .= '<a href="Members/View/'.$user->username.'" class="bel_cms_comments_tabs_user">';
			$form .= '<img class="commentsAvatar" alt="avatar_'.$user->username.'" src="'.$user->avatar.'">';
			$form .= '</a>';
			$form .= '<div class="bel_cms_comments_tabs_post">';
			$form .= '<a href="Members/View/'.$user->username.'">'.$user->username.'</a>';
			$form .= '<textarea placeholder="'.YOUR_COMMENT.' ..." name="text"></textarea>';
			$form .= '<input type="hidden" name="url" value="'.$url.'">';
			$form .= '<button class="btn btn-default" type="submit"><i class="fa fa-share-square"></i> '.PUBLISH.'</button>';
			$form .= '</div>';
			$form .= '</form>';
		} else {
			$form = '<a href="User/Login" title="'.SIGN_IN.'">'.SIGN_IN.'</a>';
		}
		unset($user);
		if ($comments !== null) {
			$li = '';
			foreach ($comments as $k => $v) {
				$user = AutoUser::getNameAvatar($v->hash_key);
				$li .= '<li>';
				$li .= '<a href="Members/View/'.$user->username.'" class="bel_cms_comments_tabs_user">';
				$li .= '<img class="commentsAvatar" alt="avatar_'.$user->username.'" src="'.$user->avatar.'">';
				$li .= '</a>';
				$li .= '<div class="bel_cms_comments_tabs_post">';
				$li .= '<a href="Members/View/'.$user->username.'">'.$user->username.'</a>';
				$li .= '<span class="commentsDate">'.Common::TransformDate($v->date_com, 'FULL', 'LONG').'</span>';
				$li .= '<p>';
				$li .= $v->comment;
				$li .= '</p>';
				$li .= '</div>';
				$li .= '</li>';
			}
		} else {
			$li = '';
		}
		unset($user);


		$html   = '<div class="card">';
		$html  .= '<div class="card-header">'.COMMENTS.'</div>';
		$html  .= '<div class="card-body">';

		$html  .= '<nav style="margin-bottom: 15px">';
		$html  .= '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
		$html  .= '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-'.CMS_WEBSITE_NAME.'" role="tab" aria-controls="nav-'.CMS_WEBSITE_NAME.'" aria-selected="true">'.CMS_WEBSITE_NAME.'</a>';
		$html  .= '<a class="nav-item nav-link" id="nav-Facebook-tab" data-toggle="tab" href="#nav-Facebook" role="tab" aria-controls="nav-Facebook" aria-selected="false">Facebook</a>';
		$html  .= '</div>';
		$html  .= '</nav>';
		$html  .= '<div class="tab-content" id="nav-tabContent">';
		$html  .= '<div class="tab-pane fade show active" id="nav-'.CMS_WEBSITE_NAME.'" role="tabpanel" aria-labelledby="nav-'.CMS_WEBSITE_NAME.'-tab">
						'.$form.'
					<ul>
						'.$li.'
					</ul>
				  </div>';
		$html  .= '<div class="tab-pane fade" id="nav-Facebook" role="tabpanel" aria-labelledby="nav-Facebook-tab">
					<div class="fb-comments" data-href="'.GetHost::getBaseUrl().$url.'" data-numposts="'.$this->nb.'" data-colorscheme="light"></div>
				  </div>';
		$html  .= '</div>';

		$html  .= '</div>';
		$html  .= '</div>';

		$html .= '<div class="clear"></div>';
		$this->html = $html;
	}
	private function count ()
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_COMMENTS');
		$where[] = array('name' => 'page', 'value' => $this->page);
		$where[] = array('name' => 'page_sub', 'value' => $this->view);
		if ($this->id) {
			$where[] = array('name' => 'page_id', 'value' => $this->id);
		}
		$sql->where($where);
		$sql->count();
		$count = (int) $sql->data;
		$this->count = $count;
	}
	private function GetComments ($page = false, $view = false, $id = false, $limit = false)
	{
		$return = null;
		$sql = New BDD();
		$sql->table('TABLE_COMMENTS');
		$sql->orderby(array(array('name' => 'id', 'type' => 'DESC')));

		$where[] = array('name' => 'page', 'value' => $page);
		$where[] = array('name' => 'page_sub', 'value' => $view);
		if ($id) {
			$where[] = array('name' => 'page_id', 'value' => $id);
		}
		$sql->where($where);
		if ($limit !== false) {
			$sql->limit($limit);
		}
		$sql->queryAll();
		if (!empty($sql->data)) {
			$return = $sql->data;
		}
		return $return;
	}
}
