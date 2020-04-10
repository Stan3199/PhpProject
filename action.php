<?php
session_start();
include 'user.php';
include 'aduser.php';

    if(isset($_POST['action'])&&$_POST['action']=='checkCookie'){
        if(isset($_COOKIE['email'],$_COOKIE['password'])){
            $data=['email'=> $_COOKIE['email'] , 'password'=> $_COOKIE['password'] ];
            echo json_encode($data);
        }
    }
    if(isset($_POST['action'])&&$_POST['action']=='register'){
        $users= validateRegForm();

        $usobj=new User();
        $usobj->setfname($users['fname']);
        $usobj->setlname($users['lname']);
        $usobj->setContact($users['contact']);
        $usobj->setEmail($users['email']);
        $usobj->setPass($users['password']);
        $usobj->setCreatedOn(date('Y-m-d'));

        $ret=$usobj->exec();
        echo $ret;
        
    }
    if(isset($_POST['action'])&&$_POST['action']=='login'){

        $usobj=new User();
        $user=validateLoginForm();
        $usobj->setEmail($user['email']);
        $usdata=$usobj->log();
        $rememberMe= isset($_POST['rememberMe']) ? 1 : 0;
        if(is_array($usdata)&&count($usdata)>0){
            if($user['password']==$usdata['Password']){
                if($rememberMe==1){
                    setcookie('email',$usobj->getEmail());
                    setcookie('password',$user['password']);
                }
                $_SESSION['id']=session_id();
                $_SESSION['name'] = $usdata['First name']." ".$usdata['Last Name'];
                echo json_encode(["status" => 1, "msg" => "Successfuly Logged In"]);
            }
            else echo json_encode(["status" => 0, "msg" => "Wrong Password"]);
        }
        else echo json_encode(["status" => 0, "msg" => "Wrong Email"]);

    }
    if(isset($_POST['action'])&&$_POST['action']=='admin'){
        $admin = validateAdminForm();
        $aduser=new Aduser();
        $aduser->setEmail($admin['email']);
        $aduser->setPass($admin['password']);
        $res=$aduser->check();
        // echo $res['Password'];
        if(is_array($res)&&count($res)>0){
            if($res['Password']==$admin['password'])
                echo json_encode(["status"=>1,"msg"=>"Welcome Admin"]);
            else echo json_encode(["status"=>0,"msg"=>"Wrong Email or Password"]);
        }
        else echo json_encode(["status"=>0,"msg"=>"Wrong Email or Password"]);

    }
    if(isset($_POST['action'])&&$_POST['action']=='alldata'){
        $admin=new Aduser();
        $Alldata=$admin->Users();
        // print_r($Alldata);
        // echo $Alldata[0]['First name'];
        echo json_encode($Alldata);
    }

    if(isset($_POST['action'])&&$_POST['action']=='display'){
        $user['id']=$_POST['id'];
        $us=new User();
        $us->setId($user['id']);
        $disp=$us->getUserByid();
        echo json_encode($disp);
    }

    if(isset($_POST['action'])&&$_POST['action']=='end'){
        echo $_POST['S'];
        $users=validateAdChangeForm();

        $usobj=new User();
        $usobj->setfname($users['First']);
        $usobj->setlname($users['Last']);
        $usobj->setContact($users['Contact']);
        $usobj->setEmail($users['Email']);
        $usobj->setPass($users['Password']);
        $usobj->setId($users['id']);

        
        echo $usobj->update();
    }

    function validateRegForm() {
		$users['fname'] = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
		if(false == $users['fname']) {
			echo "Enter valid name";
			exit;
        }
        $users['lname'] = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
		if(false == $users['lname']) {
			echo "Enter valid name";
			exit;
		}

		$users['contact'] = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_NUMBER_INT);
		if(false == $users['contact']) {
			echo "Enter valid number";
			exit;
		}

		$users['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		if(false == $users['email']) {
			echo "Enter valid Email";
			exit;
		}

		$users['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		if(false == $users['password']) {
			echo "Enter valid valid pass";
			exit;
		}

		return $users;
    }

    function validateLoginForm(){
        $users['email'] = filter_input(INPUT_POST, 'lemail', FILTER_VALIDATE_EMAIL);
		if(false == $users['email']) {
			echo json_encode(["status" => 0, "msg" => "Wrong Email"]);
			exit;
		}

		$users['password'] = filter_input(INPUT_POST, 'lpassword', FILTER_SANITIZE_STRING);
		if(false == $users['password']) {
		    echo json_encode(["status" => 0, "msg" => "Wrong Password"]);
			exit;
        }
        return $users;
    }
    function validateAdminForm(){
        $users['email'] = filter_input(INPUT_POST, 'adid', FILTER_VALIDATE_EMAIL);
		if(false == $users['email']) {
			echo json_encode(["status" => 0, "msg" => "Wrong Email"]);
			exit;
		}

		$users['password'] = filter_input(INPUT_POST, 'adpass', FILTER_SANITIZE_STRING);
		if(false == $users['password']) {
		    echo json_encode(["status" => 0, "msg" => "Wrong Password"]);
			exit;
        }
        return $users;
    }

    function validateAdChangeForm() {
        $users['id'] = filter_input(INPUT_POST, 'S', FILTER_SANITIZE_NUMBER_INT);
		if(false == $users['id']) {
			echo "Enter valid id";
			exit;
		}
		$users['First'] = filter_input(INPUT_POST, 'First', FILTER_SANITIZE_STRING);
		if(false == $users['First']) {
			echo "Enter valid name";
			exit;
        }
        $users['Last'] = filter_input(INPUT_POST, 'Last', FILTER_SANITIZE_STRING);
		if(false == $users['Last']) {
			echo "Enter valid name";
			exit;
		}

		$users['Contact'] = filter_input(INPUT_POST, 'Contact', FILTER_SANITIZE_NUMBER_INT);
		if(false == $users['Contact']) {
			echo "Enter valid number";
			exit;
		}

		$users['Email'] = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
		if(false == $users['Email']) {
			echo "Enter valid Email";
			exit;
		}

		$users['Password'] = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
		if(false == $users['Password']) {
			echo "Enter valid valid pass";
			exit;
		}

		return $users;
    }
?>