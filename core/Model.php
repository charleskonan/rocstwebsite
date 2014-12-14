<?php

class Model{

		
	static $connections = array();

	public $table = false;
	public $db = 'default';
	public $current_db;
	public $primaryKey='id'; //public $primaryKey='id';

	public $errors = array();

	 public function __construct(){

		//initialisations
		if($this->table === false){
			$this->table = strtolower(get_class($this)).'s';	
		}

		//connexion BDD

		$conf = Conf::$databases[$this->db];

		if(isset(Model::$connections[$this->db])){
			$this->current_db = Model::$connections[$this->db];
			return true;
		}

		try{
			$mysqli = mysqli_connect($conf['host'],$conf['login'],$conf['password'],$conf['dbname']) 
				/**or die ("could not connect to mysql")**/;
				$mysqli->set_charset("utf8");

			Model::$connections[$this->db] = $mysqli;
			$this->current_db = $mysqli;		

		}
		catch(MYSQLException $e){
				die($e->getMessage());
			}	
		}


	public function find($req){
		//echo 'find records';
		$sql = 'SELECT DISTINCT ';

		if(isset($req['fields'])){
			if (is_array($req['fields'])) {
				$sql .=implode(',', $req['fields']);			
			}else{
				$sql .= $req['fields'];
			}
		}else{
			$sql .=' *';
		}

		$sql .= ' FROM '.$this->table;


		//construction de la condition
		if(isset($req['conditions'])){
			$sql .= ' WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions'];
			}else{
				$cond = array();
				foreach ($req['conditions'] as $k => $v) {
					if(!is_numeric($v)){
						$v = "'".mysql_real_escape_string($v)."'";
					}					
					$cond[] = "$k = $v";
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
			
		}


		// debug($sql);
		
		// print_r(Model::$connections[$this->db]);
		$pre = mysqli_query($this->current_db,$sql) or die(mysqli_error($this->current_db));
			// debug($sql);
		///$r = mysqli_fetch_object($pre);

		$r = array();

		while($rf = mysqli_fetch_object($pre)){
			$r[] = $rf;
		}

		//debug($r);
			
		
		return $r;

		
	}

	public function findFirst($req){
		return current($this->find($req));
	}

	public function FindCount($conditions){
		$res = $this->FindFirst(array(
			'fields'=> ' count('.$this->primaryKey.') as count',
			'conditions'=> $conditions
			));
		return $res;
	}

	public function delete($req){

		$sql = ' DELETE FROM '.$this->table.' WHERE ';

		if(!is_array($req)){
			$sql .= $req;
		}else{
			$cond = array();
			foreach ($req['conditions'] as $k => $v) {
				if(!is_numeric($v)){
					$v = "'".mysql_real_escape_string($v)."'";
				}					
				$cond[] = "$k = $v";
			}
			$sql .= implode(' AND ', $cond);
		}

		// debug($sql);

		return $this->current_db->query($sql);
	
	}

	
	public function save($data, $modif=null){
		
		$key = $this->primaryKey;

		$fields = array();

		debug($data->$key);

		//$d = array();

		if(isset($data->$key)) {
			$theKey = $data->$key;
			unset($data->$key);
		}
		

		foreach($data as $k=>$v){
			if(!is_numeric($v) ){
				$v = "'".mysql_real_escape_string($v)."'";
			}else{
				$v = mysql_real_escape_string($v);
			}

			$fields[] .= " $k=$v";

			//$d[":$k"] = $v;
		}

		if(isset($theKey) && !empty($theKey)){
			$sql = ' UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'="'.$theKey.'"';
			$this->id = $theKey;
			
		} else{			
			$sql = ' INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			if($modif == true){
				
				$date = new DateTime(null, new DateTimeZone('Africa/Abidjan'));
				$sql .= ", modified=\"".$date->format("Y-m-d H:i:s")."\"";

			}
			//$this->id = $data->$key;
		}
		
		//debug($sql); die();
		 mysqli_query($this->current_db,$sql);

		$last_id = mysqli_insert_id($this->current_db);

		return $last_id ;	
	}
	


	/**
	///FORM VALIDATION 
	///CHECK VALIDATIONS ARRAY OF CURRENT MODEL
	*/
	function validate($data)
	{
		$errors = array();

		foreach ($this->validations as $k => $v) {
			
			if( isset($data->$k) ){

				if( $v['required'] == true ){

					if( empty($data->$k) && $v['rule'] == 'notEmpty' ) {
						echo 'vide';
						$errors[$k] = $v['message'];
					}
					else if( !preg_match( '/^'.$v['rule'].'$/', $data->$k )  && $v['rule'] != 'notEmpty')
					{
						$errors[$k] = $v['message'];
					}

				}else if( $v['required'] == false && !empty($data->$k) ) {
					if( !preg_match('/^'.$v['rule'].'$/', $data->$k ) ){
						$errors[$k] = $v['message'];
					}

				}

			}
		}

		$this->errors = $errors;

		if( !empty($errors) ){
			return false;
		}

		return true;
	}

	/** 
	///FUNCTION TO LIST SOMES FIELDS AS NOT REQUIRED
	*/
	function notRequired($fields)
	{
		//debug($this->validations[$fields]);
		if( !is_array($fields) ){
			$this->validations[$fields]['required'] = false;
		}else{
			foreach ($fields as $k) {
				$this->validations[$k]['required'] = false;
			}
		}

		//debug($this->validations[$fields]);
	}

	/// THIS METHOD CONSIST TO JOIN FORM TO MODEL 
	/// FOR HANDLE ERRORS TO INPUT CONCERNED

	public function set($var)
	{
		if( isset($var) && $var != null ){
			return $var;
		}
	}


	/** 
	///FUNCTION TO RECORD DATA
	*/
	public function saveModel($id=null){
		$array1 =  get_object_vars( $this ) ;
		$array2 =  get_class_vars( get_parent_class($this) ) ;

		$properties = array_diff_key ($array1, $array2);

		$data =array();

		foreach ($properties as $k => $v) {
			if( isset($v) && !in_array($k, array('validations') )){
				$data[$k] = $properties[$k];
			}
		}

		//if(isset($data->$key)) unset($data->$key);
		$key = $this->primaryKey;

		$fields = array();

		// debug($data);

		foreach($data as $k=>$v){
			if(!is_numeric($v) || $k == 'phone'){
				$v = "'".mysql_real_escape_string($v)."'";
			}else{
				$v = mysql_real_escape_string($v);
			}

			$fields[] .= " $k=$v";

			//$d[":$k"] = $v;
		}

		//$fields[] = "uuid=UUID()";

		$date = new DateTime(null, new DateTimeZone('Africa/Abidjan'));

		if(isset($id) && $id != null){
			debug($id);
			$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).', modified="'.$date->format("Y-m-d H:i:s").'"'.' WHERE '.$key."='".$id."'";
			//$this->id = $data->$key;
			
		} else{	

			$sql  = " INSERT INTO ".$this->table." SET ".implode(',',$fields);
			$sql .= ", modified=\"".$date->format("Y-m-d H:i:s")."\"; ";
			//$sql .= " ";
			
			//$this->id = $data->$key;
		}
		// debug( $fields );
		// print_r($sql); die();
		debug( $sql );

		$rInsert = mysqli_query( $this->current_db, $sql );

		if($rInsert){

			$res = mysqli_query( $this->current_db, "SELECT @last_uuid as uuid" );
			$row = mysqli_fetch_object($res);
			return $row->uuid;

		}else{

			return false;

		}

		/*
		if( $lastID = mysqli_query($this->current_db, "SELECT * FROM users ; ") ) {
			debug($lastID);
		}else{
			debug($lastID);
			debug($sql);
		}
		$last_id = mysqli_insert_id($this->current_db);
		return $last_id ;
		//debug($properties);
		//debug($data);
		*/
 
	}


} 

?>