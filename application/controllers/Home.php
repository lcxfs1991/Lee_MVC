<?php
require_once("Controller.php");

class Home extends Controller{

	private $db;
	private $post;


	public function __construct()
	{
		parent::__construct();

		$this->db = Loader::loadHelper('Helper_db');
		$this->post = Loader::loadHelper('Post');
		$this->post->getInput($this->db);
		
	}
	
	public function defaultTrigger(){

		$data["css"] = "";

		Loader::loadView('ed_top', $data);

		//history
		$date_str = date("Y-m-d");
		$date = new DateTime($date_str);
		$date->add(new DateInterval("P1D"));
		$date_str = $date->format("Y-m-d");

		$data["history"] = $this->db->getResult(array(), TB_EVE ,"where event_start_time <= '$date_str' order by id desc limit 0,4");

		// var_dump($data["history"]);

		//notice
		$data["notice"] = $this->db->getResult(array(), TB_EVE ,"order by id desc limit 0,1");
		// var_dump($data["notice"]);

		Loader::loadView('home_view', $data);


		Loader::loadView('ed_bottom');

	}

	public function about()
	{
		
		$data["css"] = "_about";

		Loader::loadView('ed_top', $data);

		$data["record"] = $this->db->getResult(array(), TB_ART ,"where article_display=1");


		Loader::loadView('about_view', $data);


		Loader::loadView('ed_bottom');
	}

	public function team()
	{
		$data["css"] = "_team";

		Loader::loadView('ed_top' , $data);

		$type="";
	    if (isset(Loader::$URI[2]) && Loader::$URI[2] != ""){
	        $teamType = Loader::$URI[2];
	        switch ($teamType){
	            case 'ib':
	                $type="投资银行导师团队";
	                break;
	            case 'consultant':
	                $type="咨询公司导师团队";
	                break;
	            case 'foreign':
	                $type="大型外企导师团队";
	                break;
	            case 'executive':
	                $type="执行团队";
	                break;
	            
	        }
	    }


		$data["record"] = $this->db->getResult(array(), TB_TM ,"where team_type='$type'");
		// var_dump($data["record"]);

		Loader::loadView('team_view', $data);

		Loader::loadView('ed_bottom');

	}

	public function article_list()
	{
		$data["css"] = "_article";

		Loader::loadView('ed_top' , $data);

		$data["record"] = $this->db->getResult(array(), TB_ART ,"where article_display=0");

		Loader::loadView('article_list_view', $data);		

		Loader::loadView('ed_bottom');
	}

	public function article_show()
	{

		if (isset(Loader::$URI[2]) && Loader::$URI[2] != ""){

			$data["record"] = $this->db->getResult(array(), TB_ART ,"where article_display=0 and id=".Loader::$URI[2]);

			if ($data["record"] == "")
			{
				header("location:".BASE_URL."/Home/article_list");
			}
			else
			{
				$data["css"] = "_article";

				Loader::loadView('ed_top' , $data);

				Loader::loadView('article_show_view', $data);		
			}
		}
		else 
			header("location:".BASE_URL."/Home/article_list");

		

		Loader::loadView('ed_bottom');
	}

	public function contact()
	{
		$data["css"] = "_list";

		Loader::loadView('ed_top' , $data);

		
		Loader::loadView('contact_view');


		Loader::loadView('ed_bottom');


	}

	public function contact_process()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			foreach ($_POST as $key => $value) {
				$add_array[$key] = $value;
			}

			if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["title"]) || !isset($_POST["msg"])
				|| $_POST["username"] == "" || $_POST["email"] == "" || $_POST["title"] == "" || $_POST["msg"] == "")
				
				$_SESSION["msg"] = "请填好表格!";
				
			else if ($this->post->insertPost(TB_LV_MSG, array('msg_username', 'msg_email', 'msg_title', 'msg_content'), 
														   $add_array) == "插入成功")
				$_SESSION["msg"] = "留言成功！";
			else 
				$_SESSION["msg"] = "留言失败！";

		}
		else
		{
			$_SESSION["msg"] = "请合法提交留言！";
		}
		header("location:".BASE_URL."/Home/contact");
	}

	public function notice()
	{
		$data["css"] = "_notice";

		Loader::loadView('ed_top' , $data);


		$date_str = date("Y-m-d");
		$date = new DateTime($date_str);
		$date->add(new DateInterval("P1D"));
		$date_str = $date->format("Y-m-d");

		$data["record"] = $this->db->getResult(array(), TB_EVE ,"where event_start_time > '$date_str' order by id desc");
		// var_dump($data["record"]);

		// echo date("Y-m-d",strtotime("2012-10-5"));

		Loader::loadView('notice_view' , $data);

		Loader::loadView('ed_bottom');
	}

	public function history()
	{
		$data["css"] = "_history";

		Loader::loadView('ed_top' , $data);

		$date_str = date("Y-m-d");
		$date = new DateTime($date_str);
		$date->add(new DateInterval("P1D"));
		$date_str = $date->format("Y-m-d");

		$data["record"] = $this->db->getResult(array(), TB_EVE ,"where event_start_time <= '$date_str' order by id desc");

		// var_dump($data["record"]);
		Loader::loadView('history_view' , $data);

		Loader::loadView('ed_bottom');

	}

	public function summary()
	{
		

		if (isset(Loader::$URI[2]) && Loader::$URI[2] != ""){

			$data["record"] = $this->db->getResult(array(), TB_EVE_SUM ,"where eid=".Loader::$URI[2]);

			if ($data["record"] == "")
				header("location:".BASE_URL."/Home/history");
			else{
				$data["css"] = "_summary";

				Loader::loadView('ed_top' , $data);
				
				Loader::loadView('summary_view', $data);		
			}
		}
		else 
			header("location:".BASE_URL."/Home/history");

		Loader::loadView('ed_bottom');
	}

	public function tutorial()
	{
		$data["css"] = "_list";

		Loader::loadView('ed_top' , $data);

		Loader::loadView('tutorial_view');

		Loader::loadView('ed_bottom');
	}

	public function support()
	{
		$data["css"] = "_list";

		Loader::loadView('ed_top' , $data);

		Loader::loadView('support_view');

		Loader::loadView('ed_bottom');
	}



	
}
?>