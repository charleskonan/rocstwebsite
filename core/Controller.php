	<?php

	class Controller{	

	public 	$request;  // objet request 
	public 	$vars 		= array();  // variable a passer pour la vue
	public 	$layout 	= 'default'; // layout a yse pour rendre la vue
	private $rendered 	= false; // si le rendu a passé ou pas



	function __construct($request = null){
		if($request) {
			$this->request = $request;		//stocker la request dans l'instance
		}
	}

	public function render($view){
		

		if($this->rendered){return false;}

		extract($this->vars);

		if (strpos($view,'/')===0){
				$view = ROOT.DS.'view'.DS.$view.'.php';
		}else{
				$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		}
		
		ob_start();
		
		require ($view);
		$content_for_layout = ob_get_clean();
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rendered = true;
	}

	public function  set($key, $value=null){

		if(is_array($key)){

			$this->vars += $key;

		} else {

		 	$this->vars[$key] = $value;

		}
		

	}


	function loadModel($name, $params=null){

		$file = ROOT.DS.'model'.DS.$name.'.php';
		require_once($file);

		//if(!isset($name)){
		$this->$name = new $name();
		if(isset($params)){
			//debug($params);
			$vars = get_object_vars( $this->$name ) ;
			//debug($vars);

			foreach ($vars as $k => $v) {
				if( isset( $params[$k] ) ){
					//echo $k." -> ".$params[$k]."<br>";
					$this->$name->$k = $params[$k];
				}
			}
		}	
		
		//}

	}


	/**
	*La fonction qui permet de gérer les erreur 404
	*/
	public function e404($message){
		header("HTTP/1.0 404 Not Found");
		$this->set('message', $message);
		$this->render('/errors/404');
		die();
	}


	/**
	* Function pour appeler un controlleur depuis une vue;
	*/
    function request($controller,$action){
		$controller .= 'Controller';
		require_once(ROOT.DS.'Controller'.DS.$controller.'.php');
		$c = new $controller();
		return $c->$action();
	}

	function redirect($url, $code = null){
		if($code == 301){
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location : ".Router::url($url));
	}
}

	?>