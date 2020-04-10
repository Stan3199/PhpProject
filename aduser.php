<?php
    Class Aduser{
        protected $email;
        protected $password;
        public $con;

        function setEmail($email) { $this->email = $email; }
		function getEmail() { return $this->email; }
		function setPass($pass) { $this->password = $pass; }
        function __construct(){
            require 'DbConnect.php';
            $conn=new DbConnect();
            $this->con=$conn->connect(); 
        }
        function check(){
            $query="SELECT * FROM `admin` WHERE `Email Address` LIKE '$this->email'";
            $stmt=$this->con->prepare($query);

            try{
                if($stmt->execute()){
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                return $e;
            }
        }
        function Users(){
            $query="Select * from `registrations`";
            $stmt=$this->con->prepare($query);

            try{
                if($stmt->execute()){
                    return $stmt->fetchAll();;
                }
            }
            catch(Exception $e){
                return $e;
            }
        }
    }
?>