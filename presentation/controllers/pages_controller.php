<?php
	class PagesController {
		
		public function index() {
			$name = 'Ismail';
			$surname  = 'NGUYEN';

			require_once('views/pages/index.php');
		}

		public function error() {
			require_once('views/pages/error.php');
		}
	}
?>