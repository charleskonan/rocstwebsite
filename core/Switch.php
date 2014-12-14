<?php 
	define('DS', DIRECTORY_SEPARATOR);
	//define('CDNLINK', 'http://localhost/CDN_BOM/');
	//define('CDN','C:'.DS.'xampp'.DS.'htdocs'.DS.'CDN_BOM'.DS);
	
	include_once 'Functions.php';
	
	if(!$_POST){
		header("Location: http://localhost/rocst/");
	}else{
		//debug($_POST);
		//debug($_FILES);
	}


	
	if(  isset($_POST["load"]) ){
		$name 	= isset($_POST["load"])   ? $_POST["load"]   : null;
		$func 	= isset($_POST["func"])   ? $_POST["func"]   : null;
		$params = isset($_POST["params"]) ? $_POST["params"] : null;
		
		//echo ('NAME :'. $name);

		if($name){

			include_once 'Functions.php';
			include_once '../config/Config.php';
			include_once 'Model.php';
			include_once '../model/'.$name.'.php';
			
			$model = new $name();
			if( $func == 'save' ){
				//debug($_POST);
				$data = new stdClass();
		 		foreach ($_POST['params'] as $k => $v) {
			 		$data->$k = $v;
			 	}

			 	$data->uuid = $_POST['params']['uuid'];
			 	$params = $data;
			 	//debug($data);
			}

			$r = $model->$func($params);
			
			//$obj->$result = $r;

			$json = json_encode($r);
			echo $json;

		}
	}

	
	if( isset($_POST['controller']) ){

		$controller = isset($_POST["controller"]) ? $_POST["controller"]   : null;
		$func 		= isset($_POST["func"])   ? $_POST["func"]   : null;
		$params 	= isset($_POST["params"]) ? $_POST["params"] : null;

		if($controller){
			
			include_once '../config/Config.php';
			include_once 'Controller.php';
			include_once 'Model.php';
			include_once '../controller/'.$controller.'Controller.php';
			
			$controller = $controller.'Controller';
			$controller = new $controller();

			$r = $controller->$func($params);
			
			//$obj->$result = $r;

			$json = json_encode($r);
			echo $json;

		}
	}


?>