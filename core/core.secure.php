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

final class SecureAccess
{
	#########################################
	# access page by groups
	#########################################
	public static function AccessPage ($page = null)
	{
		# default return false
		$return = (bool) false;
		# secure var page
		$page = trim(strip_tags(strtolower($page)));
		# get all groups for user
		$userGroups = self::getUserGroup();
		# select all page
		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
			$sql->fields(
				array(
					'access_groups',
				)
			);
		$sql->where(
			array(
				'name'  => 'name',
				'value' => $page
			)
		);
		$sql->queryOne();
		# page if exists in the database
		if (!empty($sql->data)) {
			# if user == superadmin
			if (in_array(1, $userGroups)) {
				return (bool) true;
			}
			# test if groups in page
			$accessGroups = explode('|', $sql->data->access_groups);
			foreach ($accessGroups as $accessGroup) {
				# if page access = 0 (visitor) == access true
				if ($accessGroup == 0) {
					return (bool) true;
				}
				if (in_array($accessGroup, $userGroups)) {
					$return = true;
					break;
				}
			}
		}
		# return var
		return $return;
	}
	#########################################
	# access management by groups
	#########################################
	public static function AccessManagement ($page = null)
	{
		# default return false
		$return = (bool) false;
		# secure var page
		$page = trim(strip_tags(strtolower($page)));
		# get all groups for user
		$userGroups = self::getUserGroup();
		# if user == superadmin
		if (in_array(1, $userGroups)) {
			return (bool) true;
		}
		# select all page
		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
			$sql->fields(
				array(
					'access_admin',
				)
			);
		$sql->where(
			array(
				'name'  => 'name',
				'value' => $page
			)
		);
		$sql->queryOne();
		# page if exists in the database
		if (!empty($sql->data)) {
			# test if groups in page
			$accessGroups = explode('|', $sql->data->access_admin);
			foreach ($accessGroups as $accessGroup) {
				# if page access = 0 (visitor) == access false
				if ($accessGroup == 0) {
					return (bool) false;
				}
				if (in_array($accessGroup, $userGroups)) {
					$return = true;
					break;
				}
			}
		}
		# return var
		return $return;
	}
	#########################################
	# access page by groups
	#########################################
	public static function ActivePage ($page = null)
	{
		# default return false
		$return = (bool) false;
		# secure var page
		$page = trim(strip_tags(strtolower($page)));
		# select all page
		$sql = New BDD;
		$sql->table('TABLE_PAGES_CONFIG');
			$sql->fields(
				array(
					'active',
				)
			);
		$where[] = array(
			'name'  => 'name',
			'value' => $page
		);
		$where[] = array(
			'name'  => 'active',
			'value' => (int) 1
		);
		$sql->where($where);
		$sql->count();
		# page if exists in the database
		if ($sql->data == 1) {
			$return = (bool) true;
		}
		# return var
		return $return;
	}
	#########################################
	# get groups for user
	#########################################
	private static function getUserGroup ()
	{
		# default return array
		$return = array();
		# test if user session and hash_key = 32 str
		if (isset($_SESSION['user']) &&
			isset($_SESSION['user']->hash_key) &&
			strlen($_SESSION['user']->hash_key) == 32)
		{
			# get all groups in the database
			$sql = New BDD;
			$sql->table('TABLE_USERS');
			$sql->fields(
				array(
					'groups',
					'main_groups'
				)
			);
			$sql->where(
				array(
					'name' => 'hash_key',
					'value' => $_SESSION['user']->hash_key
				)
			);
			$sql->queryOne();
			# test if user exist
			if (!empty($sql->data)) {
				if (!in_array($sql->data->main_groups, $return)) {
					# add main group in var return
					array_push($return, $sql->data->main_groups);
				}
				foreach (explode('|', $sql->data->groups) as $v) {
					# add group if not exist in var return
					if (!in_array($v, $return)) {
						array_push($return, $v);
					}
				}
			}
		}
		# return var
		return $return;
	}
}
