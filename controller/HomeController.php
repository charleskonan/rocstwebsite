<?php
class HomeController extends Controller {

	

	function index(){
		$this->render('index');
	}

	function services(){
		$this->render('services');
	}

	function project(){
		$this->render('project');
	}

	function portfolio(){
		$this->render('portfolio');
	}

	function contact(){
		$this->render('contact');
	}


}

?>