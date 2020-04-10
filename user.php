<?php
    class User
    {
        protected $id;
        protected $fname;
        protected $lname;
        protected $email;
        protected $password;
        protected $contact;
        protected $createdOn;
        public $con;

        function getId() { return $this->id; }
        function setId($id){ $this->id=$id; }
		function setfname($fname) { $this->fname = $fname; }
        function getName() { return $this->fname; }
        function setlname($lname) { $this->lname = $lname; }
		function getlName() { return $this->lname; }
		function setContact($contact) { $this->contact = $contact; }
		function getContact() { return $this->$contact; }
		function setEmail($email) { $this->email = $email; }
		function getEmail() { return $this->email; }
		function setPass($pass) { $this->password = $pass; }
		function setCreatedOn($createdOn) { $this->createdOn = $createdOn; }
        function getCreatedOn() { return $this->createdOn; }
        
        function __construct()
        {
            require 'DbConnect.php';
            $db=new DbConnect();
            $this->con=$db->connect();
        }
        function exec(){
            $query="INSERT INTO `registrations`(`S.no`, `First name`, `Last Name`, `Email`, `Password`, `Contact Number`, `Reg_Date`) 
            VALUES (null,:fname,:lname,:email,:pass,:contact,:cdate)";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':fname', $this->fname);
            $stmt->bindParam(':lname', $this->lname);
			$stmt->bindParam(':contact', $this->contact);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':pass', $this->password);
			$stmt->bindParam(':cdate', $this->createdOn);
            try{
                if($stmt->execute()) return true;
                else return false;
            }
            catch(Exception $e){
                return $e;
            }
        }
        function log(){
            $query="SELECT * FROM `registrations` WHERE `Email` LIKE ':email'";
            $stmt=$this->con->prepare('SELECT * FROM registrations WHERE Email = :email');
            // $stmt=$this->con->prepare($query);
            $stmt->bindParam(':email',$this->email);
            try{
                if($stmt->execute()){
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            return $row;
        }
        function getUserById(){
            $query="SELECT * FROM `registrations` WHERE `S.no` LIKE '$this->id'";
            $stmt=$this->con->prepare($query);
            try{
                if($stmt->execute()) return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            catch(Exception $e){
                return $e;
            }
        }
        function update(){
            $query="UPDATE `registrations` SET `S.no`='$this->id',`First name`='$this->fname',`Last Name`='$this->lname',`Email`='$this->email',
            `Password`='$this->password',`Contact Number`='$this->contact' WHERE `S.no` LIKE '$this->id'";
            $stmt=$this->con->prepare($query);
            try{
                if($stmt->execute()) return true;
            }
            catch(Exception $e){
                return $e;
            }

        }

    }
?>