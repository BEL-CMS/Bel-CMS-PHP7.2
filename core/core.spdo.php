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

class SqlConnection
{
	#########################################
	# Variable declaration
	#########################################
	protected static  $instance;
	public			  $cnx,
					  $isConnected = false;
	#########################################
	# Start Class
	#########################################
	public function __construct ()
	{
		$GLOBALS['REQUEST_SQL'] = null;

		$pdo_options = array();
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';

		try {
			$this->cnx = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $pdo_options);
			$this->isConnected = true;
		}
		catch (PDOException $e) {
			throw new pdoDbException($e);
		}
	}
	#########################################
	# Get instance
	#########################################
	public static function getInstance ()
	{
		if (!self::$instance)
		{
			self::$instance = new SqlConnection();
		}
		return self::$instance;
	}
}
class BDD
{
	#########################################
	# Variable declaration
	#########################################
	public		$data,
				$fields,
				$table,
				$where,
				$orderby,
				$limit,
				$type,
				$rowCount,
				$sqlData,
				$lastId;
	private		$requete,
				$connect,
				$isObject = true;
	protected	$cnx;
	#########################################
	# Start Class
	#########################################
	public function __construct ()
	{
		$SqlConnection = SqlConnection::getInstance();

		$this->cnx     = $SqlConnection->cnx;
		$this->connect = $this->cnx;

		if ($SqlConnection->isConnected) {
			self::fields(null);
			self::sqlData(null);
			self::limit(false);
			self::orderby(false);
			self::where(false);
			self::whereLike(false);
		}
	}
	#########################################
	# function table
	#########################################
	public function table ($data = null)
	{
		if (!is_null($data) && defined($data)) {
			$this->table = constant($data);
		} else if (Common::tableExists($data)) {
			$this->table = $data;
		} else {
			throw new Exception('Table : '.$data.' does not exist');
		}
	}
	#########################################
	# function fields
	#########################################
	public function fields ($data)
	{
		if (!is_null($data)) {
			if (is_array($data)) {
				$this->fields = implode(',', $data);
			} else {
				$this->fields = trim($data);
			}
		} else {
			$this->fields = '*';
		}
	}
	#########################################
	# function limit
	#########################################
	public function limit ($data, $custom = false)
	{
		if ($custom === true) {
			$this->limit = ' LIMIT ' . intval($data[0]) . ',' . intval($data[1]);
		} else {
			if ($data !== false or $data != 0) {
				$this->limit = ' LIMIT ' . intval($data);
			} else {
				$this->limit = '';
			}
		}

	}
	#########################################
	# function order
	#########################################
	public function orderby ($data = false)
	{
		if ($data) {
			if (is_array($data) AND !is_object($data)) {
				$tmp = array();
				foreach ($data as $k => $v) {
					if (is_array($v)) {
						$tmp[] = $v['name'].' '.strtoupper($v['type']);
					}
				}
				if (!empty($tmp)) {
					$this->orderby = ' ORDER BY '.implode(',', $tmp);
				}
			} else {
				if (!is_object($data)) {
					$this->orderby = ' ORDER BY id '.$data;
				} else {
					$this->orderby = ' ORDER BY '.$data->name.' '.$data->type;
				}
			}
		} else {
			$this->orderby = '';
		}
	}
	#########################################
	# function where
	#########################################
	public function where ($data = array())
	{
		$return = " WHERE 1 ";

		if (isset($data) AND is_array($data)) {

			$count = count($data);

			if ($count == 1) {
				$data = current($data);
			}

			if (!isset($data['name']) AND !isset($data['value'])) {
				foreach ($data as $k => $v)
				{
					$prevKey = $k - 1;
					if ($prevKey == '-1') {
						$condition = 'AND ';
					} else {
						$condition = ($v['name'] == $data[$prevKey]['name']) ? ' OR ' : ' AND ';
					}

					$operateur = (isset($v['op']) AND !empty($v['op'])) ? $v['op'] : ' = ';
					$value = "'".$v['value']."'";
					$return .= $condition.$v['name'] . ' '.$operateur.' ' . $value;
					if ($count == $k) {
						break;
					}
				}
			} else {
				$condition = 'AND ';
				$operateur = (isset($data['op']) AND !empty($data['op'])) ? $data['op'] : ' = ';
				$value = "'".$data['value']."'";
				$return .= $condition.$data['name'] . ' '.$operateur.' ' . $value;
			}

		} else {
			$return = ' '.$data;
		}

		$this->where = $return;
	}
	public function whereLike($data = array())
	{
		$return = " WHERE 1 ";

		if (isset($data) AND is_array($data)) {
			if (isset($data['name']) AND isset($data['value'])) {
				$return .= 'AND ';
				$return .= $data['name']. ' ';
				$return .= 'LIKE "%';
				$return .= $data['value'];
				$return .= '%"';
			}
		}

		$this->where = $return;

	}
	#########################################
	# data for update, delete
	#########################################
	public function sqlData ($data = null)
	{
		if (is_array($data) && !empty($data)) {
			foreach ($data as $k => $v) {
				$return[$k] = $v;
			}
		} else {
			$return = ' ';
		}
		$this->sqlData = $return;
	}
	#########################################
	# function execute and manage error
	#########################################
	private function sqlExecute ($data = array()) {

		$data = (count($data) == 0) ? null : $data;

		try {
			$this->cnx->execute($data);
			self::rowCount();
			$GLOBALS['REQUEST_SQL']++;
			$this->lastId = self::lastId();
			$return = true;
		} catch (Exception $e) {
			$r  = '<pre>'.PHP_EOL;
			$r .= str_pad('', 100, '-',STR_PAD_RIGHT).PHP_EOL;
			$r .= str_pad('Date Time', 20, ' ',STR_PAD_RIGHT) .date("H:i:s").PHP_EOL;
			$r .= str_pad('Error Type', 20, ' ',STR_PAD_RIGHT) .$e->getCode().PHP_EOL;
			$r .= str_pad('Error Message', 20, ' ',STR_PAD_RIGHT) .$e->getMessage().PHP_EOL;
			$r .= str_pad('Error Ligne', 20, ' ',STR_PAD_RIGHT) .$e->getLine().PHP_EOL;
			$r .= str_pad('Error File', 20, ' ',STR_PAD_RIGHT) .$e->getFile().PHP_EOL;
			$r .= str_pad('Error Previous', 20, ' ',STR_PAD_RIGHT) .$e->getPrevious().PHP_EOL;
			$r .= str_pad('Error Trace', 20, ' ',STR_PAD_RIGHT) .PHP_EOL.$e->getTraceAsString().PHP_EOL;
			$r .= str_pad('', 100, '-',STR_PAD_RIGHT).PHP_EOL;
			$r .= '</pre>'.PHP_EOL;
			die($r);
		}
		return $return;
	}
	#########################################
	# return or array
	#########################################
	public function isObject ($data = true)
	{
		if ($data === true) {
			$this->isObject = true;
		} else {
			$this->isObject = false;
		}
	}
	#########################################
	# Select SQL one line
	#########################################
	public function queryOne ()
	{
		$return = '';

		if ($this->cnx) {
			$prepare = '
				SELECT '.$this->fields.'
				FROM   '.$this->table.
						 $this->where.
						 $this->orderby.
						 $this->limit.' ';
			$this->cnx = $this->cnx->prepare($prepare);

			if ($this->cnx == self::sqlExecute()) {
				if ($this->isObject) {
					$this->cnx->setFetchMode(PDO::FETCH_OBJ);
				} else {
					$this->cnx->setFetchMode(PDO::FETCH_ASSOC);
				}
				$this->data = $this->cnx->fetch();
				$this->cnx->closeCursor();
			}

		}
	}
	#########################################
	# Select SQL multiple line
	#########################################
	public function queryAll ()
	{
		$return = '';

		if ($this->cnx) {
			$prepare = '
				SELECT '.$this->fields.'
				FROM   '.$this->table.
						 $this->where.
						 $this->orderby.
						 $this->limit.' ';
			$this->cnx = $this->cnx->prepare($prepare);

			if ($this->cnx == self::sqlExecute()) {
				if ($this->isObject) {
					$this->cnx->setFetchMode(PDO::FETCH_OBJ);
				} else {
					$this->cnx->setFetchMode(PDO::FETCH_ASSOC);
				}
				$this->data = $this->cnx->fetchAll();
				$this->cnx->closeCursor();
			}

		}
	}
	#########################################
	# Returns the number of line
	#########################################
	public function count ()
	{
		if ($this->cnx) {
			$prepare = '
				SELECT count(id)
				FROM   '.$this->table.
						 $this->where.' ';
			$this->cnx = $this->cnx->prepare($prepare);

			if ($this->cnx == self::sqlExecute()) {
				$this->data = intval($this->cnx->fetchColumn());
				$this->cnx->closeCursor();
			}
		}
	}
	#########################################
	# Insert data into database
	#########################################
	public function insert ()
	{
		if (is_array($this->sqlData) && !empty($this->sqlData)) {

			$keys   = array_keys($this->sqlData);
			$value  = implode(', ', array_map(array($this, 'secureField'), $keys));
			$insert = implode(', ', $keys);

			$prepare = '
				INSERT INTO '.$this->table.' ('.$insert.')
				VALUES ('.$value.')';
			$this->cnx = $this->cnx->prepare($prepare);

			foreach ($this->sqlData as $k => $v) {
				$exc[':'.$k] = $v;
			}

			if ($this->cnx == self::sqlExecute($this->sqlData)) {
				$this->data = $this->cnx;
				$this->cnx->closeCursor();
			} else {
				$this->data = false;
			}
		} else {
			$this->data = false;
		}
	}
	#########################################
	# laist id insert or update
	#########################################
	public function lastId ()
	{
		return $this->connect->lastInsertId();
	}
	#########################################
	# Update an online database
	#########################################
	public function update()
	{
		$update    = array();
		$keys      = array_keys($this->sqlData);

		foreach ($keys as $key)
		{
			$update[] = $key . ' = ' . $this->secureField($key);
		}

		if (is_array($this->sqlData) && !empty($this->sqlData)) {
			$prepare = ' UPDATE '.$this->table.' SET '.trim(implode(', ', $update)).$this->where;
			$this->cnx = $this->cnx->prepare($prepare);
			if ($this->cnx == self::sqlExecute($this->sqlData)) {
				$this->data = $this->cnx;
				$this->cnx->closeCursor();
			} else {
				$this->data = false;
			}
		} else {
			$this->data = false;
		}
	}
	#########################################
	# Deletes a row in the database
	#########################################
	public function delete ()
	{
		if ($this->cnx) {
			$prepare = '
				DELETE FROM '.$this->table.$this->where;
			$this->cnx = $this->cnx->prepare($prepare);

			if ($this->cnx == self::sqlExecute()) {
				$this->data = true;
				$this->cnx->closeCursor();
			} else {
				$this->data = false;
			}
		}
	}
	#########################################
	# Security
	#########################################
	private function secureField ($data)
	{
		return ':'.$data;
	}
	#########################################
	# Count line
	#########################################
	public function rowCount ()
	{
		$this->rowCount = $this->cnx->rowCount();
	}
	#########################################
	# Close Class
	#########################################
	public function __destruct ()
	{
		if (SHOW_ALL_REQUEST_SQL === true) {
			debug($this->cnx);
		}
		unset($this->cnx);
	}
}