<?php
require_once("Controller.php");

class Member extends Controller{

	private $db;
	private $user;

	public function __construct()
	{
		$this->db = Loader::loadHelper('Helper_db');
		$this->user = Loader::loadHelper('User');
		$this->user->getInput($this->db);
		 // = Helper_db::getCon(Loader::$config);
	}
	
	public function defaultTrigger(){


	}

	public function member_login(){

		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (isset($_POST['username']) && isset($_POST['password']))
			{

				if ($this->user->checkLogin($_POST['username'],$_POST['password']) ==  "登陆成功" && isset($_SESSION["login"]["authority"]) && $_SESSION["login"]["authority"] == "1")
					header("location:".BASE_URL."/Admin/admin_page");	
			}
		}

		Loader::loadView('admin_login_view');


	}

	public function member_logoff()
	{
		if (isset($_SESSION["login"]))
		{
			session_destroy();
		}
		header("location:".BASE_URL."/Member/member_login");
	}

}
?>