<?php
/**AO™ Library is a vanilla and evolving framework for developing websites, applications, and APIs using web technology.
 * Originator: Anthony O. Osawere - @iamodao - www.osawere.com  © 2020 | Apache License
 * ============================================================================================
 * oSQLi ~ MySQLi Utility • DEPENDENCY»
 */
class oSQLi {
	protected $dbo;
	private $host;
	private $user;
	private $password;
	private $name;
	private $persist;


	//CONSTRUCT •
	public function __construct($i=''){
		$this->config($i);
		$this->connect();
		$this->cleanup();
		return;
	}



	//oEXIT • Report Error & Terminate Program
	public function oExit($i='', $v=''){
		if(!empty($i)){
			oExit::Run('DB-MySQLi', $i, $v);
		}
		return false;
	}



	//CONFIG • Database Configuration
	public function config($i=''){
		if(!empty($i) && is_array($i)){
			foreach($i as $k => $v){$this->{$k} = $v;}
			return true;
		}
		return false;
	}



	//CLEANUP • Clean up Database Configuration
	public function cleanup(){
		unset($this->host);
		unset($this->user);
		unset($this->password);
		unset($this->name);
		unset($this->persist);
		return;
	}



	//CONNECT • Initiate Database Connection
	public function connect(){
		@$dbc = new mysqli($this->host, $this->user, $this->password, $this->name);
		if($dbc->connect_error){$this->oExit('connection failed - '.$dbc->connect_errno, $dbc->connect_error);}
		$this->dbo = $dbc;
		return;
	}



	//DBO • Return Database Object [Connection]
	public function dbo(){
		if(!empty($this->dbo)){return $this->dbo;}
		return false;
	}



	//ERROR • Return FALSE or MySQLi Error
	public function error($i='iMessage'){
		if(!empty($i)){
			if($i == 'iCode'){return $this->dbo->errno;}
			elseif($i == 'iMessage'){return $this->dbo->error;}
		}
		return false;
	}



	//COMMIT • [auto commit & commit]
	public function commit($v='iAuto', $i=false){
		if(!empty($v)){
			if($v == 'iAuto'){return $this->dbo->autocommit($i);}
			return $this->dbo->commit();
		}
	}



	//TRANSACT • Returns $mysqli->begin_transaction()
	public function transact($flag=''){
		$flags = array(MYSQLI_TRANS_START_READ_ONLY, MYSQLI_TRANS_START_READ_WRITE, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
		if(!in_array($flag, $flags)){$this->oExit('invalid flag for transact', $flag);}
		return $this->dbo->begin_transaction($flag);
	}



	//ROLLBACK • Returns $mysqli->rollback()
	public function rollback(){
		return $this->dbo->rollback();
	}



	//QUERY • Returns $mysqli->query()
	public function query($sql=''){
		if(!empty($sql)){
			return $this->dbo->query($sql);
		}
		return false;
	}



	//QUERIES • Returns $mysqli->muli_query()
	public function queries($sql=''){
		if(!empty($sql)){
			return $this->dbo->multi_query($sql);
		}
		return false;
	}



	//DISCONNECT • @TODO ~ Close & Disconnect Database Connection
	public function disconnect(){
		$this->cleanup();
		$this->dbo->close();
		return;
	}


} // EndOfClass - oMySQLi