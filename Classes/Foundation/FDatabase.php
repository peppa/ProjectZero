<?php 

//require_once "./Configuration files/DBConfiguration.php";

class FDatabase extends mysqli{

	public function __construct(){
		global $config;
		parent::__construct($config['mysql']['host'],$config['mysql']['user'],$config['mysql']['password'],$config['mysql']['database']);
		//mysql_connect();

	}

	public function insertUser($field1,$field2,$field3,$field4,$field5,$field6){
		$query1="INSERT INTO `clinica`.`utenti` (`Nome`, `Cognome`, `Codice Fiscale`, `Email`, `Username`, `Password`)";
		$query2="VALUES ('".$field1."','".$field2."','".$field3."','".$field4."','".$field5."','".$field6."')";
		$query=$query1." ".$query2;
		//var_dump($query);
		//mysql_query($query);
		$this->query($query);

	}

	public function queryDb($passedQuery){
		$this->query($passedQuery);
	}

	public function queryDbSelect($passedQuery){
		$result=$this->query($passedQuery);
		return $result;
	}

	public function checkUser($user,$pass){
		$query="SELECT * FROM `utenti` WHERE `Username`='".$user."'";// and `Password`='".$pass."'";
		$res=$this->query($query);

		while($row=$res->fetch_assoc()){
			$value=$row['Password'];
		}

		if ($pass==$value) return true;
		else return false;
/*


		if(count($res)!=0) $result=true;
		else $result=false;
		/*$key=$this->getByUsername($user);
		if($key!=false && $password==$key->getPassword()) {$result=true;}
		else {$result=false;}*/
//		return $result;

	}



}