<?php 
	/**
	* 
	*/
	class TestClass extends Model
	{
		public $table = 'test_table';
		
		public $name;
		public $firstname;
		public $age;
		public $toc;


		function TestClass( $_name = null, $_firstname = null, $_age = null, $_toc = null )
		{
			$this->name = $this->set($_name);
			$this->firstname = $this->set($_firstname);
			$this->age = $this->set($_age);
			$this->toc = $this->set($_toc);
		}

		


	}
?>