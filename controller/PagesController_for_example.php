<?php
class PagesController extends Controller {

	function view($id){

		$this->loadModel('Post');

		$d['page']= $this->Post->findFirst(array(
			'conditions' => array('online'=>1, 'id'=>$id, 'type' =>'page')
			));
		if(empty($d['page'])){
			$this->e404('page introuvable');
		}
		$this->set($d);
	}


// recupérer le menu pour la page appelée

	function getMenu(){
		$this->loadModel('Post');
		return $this->Post->find(array(
			'conditions' => array('online'=>1, 'type' =>'page')
		));
	}


}

?>



