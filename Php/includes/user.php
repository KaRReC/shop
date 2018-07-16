<?php 

	class user{
		
		private $id;
		private $login;
		private $construct;

		function __construct($anonymous = true){
			if ($anonymous == true) {
				$this->id = 0;
				$this->login = '';
			}
			$this->construct = true;
		}
	}

?>