<?php
require_once("Controller.php");

class Admin extends Controller{

	private $db;
	private $user;
	private $post;
	private $file;

	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION["login"]["authority"]) || $_SESSION["login"]["authority"] != "1")
			header("location:".BASE_URL."/Member/member_login");

		$this->db = Loader::loadHelper('Helper_db');
		$this->user = Loader::loadHelper('User');
		$this->user->getInput($this->db);
		$this->post = Loader::loadHelper('Post');
		$this->post->getInput($this->db);
		$this->file = Loader::loadHelper('Helper_file');
		
	}
	
	public function defaultTrigger(){

		// echo "!!!";
	}


	public function admin_page()
	{
			
		Loader::loadView('admin_page_view');

	}



	public function admin_article()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			foreach ($_POST as $key => $value) {
				$add_array[$key] = $value;
			}
			$add_array['uid'] = $_SESSION["login"]["id"];
			echo $this->post->insertPost(TB__ART, array('article_title', 'article_author', 'article_introduction', 
														'article_content', 'article_display', 'uid'), $add_array);
			echo "<a href='".BASE_URL."/Admin/admin_page'>返回</a>";
		}
		else 
			header("location:".BASE_URL."/Admin/admin_page");
	}

	public function admin_team()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			foreach ($_POST as $key => $value) {
				$add_array[$key] = $value;
			}
			echo $this->post->insertPost(TB_TM, array('team_member','team_introduction', 'team_type'), $add_array);
			echo "<a href='".BASE_URL."/Admin/admin_page'>返回</a>";
		}
		else
			header("location:".BASE_URL."/Admin/admin_page");
	}

	public function admin_event()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			foreach ($_POST as $key => $value) {
				$add_array[$key] = $value;
			}
			$add_array['uid'] = $_SESSION["login"]["id"];
			echo $this->post->insertPost(TB_EVE, array('event_title', 'event_link', 'event_start_time', 
													   'event_introduction', 'event_index_promotion', 'uid'), $add_array);
			echo "<a href='".BASE_URL."/Admin/admin_page'>返回</a>";

			$data["action"] = BASE_URL."/Admin/admin_event_img";

			Loader::loadView('admin_event_img_view', $data);
			$_SESSION["eid"] = $this->post->insert_id;

		}
		else 
			header("location:".BASE_URL."/Admin/admin_page");

	}

	public function admin_event_img()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{

			$this->file->getInput('upload','image', "upload/");
			$destination = $this->file->upload();
			if (isset($_SESSION["eid"]))
				$update_result = $this->post->updatePost(TB_EVE, 'id', $_SESSION["eid"], array("event_pic"), array($destination[1]));
				
			echo $update_result;
			echo "<a href='".BASE_URL."/Admin/admin_page'>返回</a>";
		}
	}

	public function admin_event_summary()
	{
		if (isset(Loader::$URI[2]) && Loader::$URI[2] != ""){
			
			$data["action"] = BASE_URL."/Admin/admin_event_summary/".Loader::$URI[2];

			Loader::loadView('admin_event_img_view', $data);

			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{

				$eid = (int) Loader::$URI[2];
				$this->file->getInput('upload','image', "upload/");
				$destination = $this->file->upload();
				if (isset($_SESSION["eid"]))
					$update_result = $this->post->insertPost(TB_EVE_SUM, array("eid", "summary_pic"), array($eid, $destination[1]));
					
				echo $update_result;
				echo "<a href='".BASE_URL."/Home/history'>返回</a>";
			}

		}
		else 
			header("location:".BASE_URL."/Home/history");
	}

	public function admin_install()
	{
		
		if ($this->db->getResult(array(), TB_USR, "") == 0 )
		{
			$result = $this->db->exec("insert into ".TB_USR."(username,password,authority,verification, reg_time) 
									   values ('admin', password('admin123'), 1, 0, now())");

			if ($result != 0)
				echo "Install Success!";

		}

	}
}
?>