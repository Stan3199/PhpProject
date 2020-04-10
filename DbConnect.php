<?php
    class DbConnect{
        private $host='localhost';
        private $dname='page';
        private $user='root';
        private $pass='';

        // function __construct($dname){
        //     $this->dbname=dnamme;
        // }
        function connect(){
            try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
            } 
            catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
        }
    }
?>