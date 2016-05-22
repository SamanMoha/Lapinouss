<?php
	class Account {
		
		public $name;
		public $surname;
		
		public function __construct($name, $surname) {
			$this->name = $name;
			$this->surname = $surname;
		}
		
		public function getName() {
			return $name;
		}
		
		public function setName($name) {
			$this->name = $name;
		}
		
		public function getSurname() {
			return $surname;
		}
		
		public function setSurname($surname) {
			$this->surname = $surname;
		}
	}
?>