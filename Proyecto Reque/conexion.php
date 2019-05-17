<?php
	
	class connection{
		private $conn;

		public function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "proyectologin");
		}

		public function get_connection() {
			return $this->conn;
		}
	}

?>