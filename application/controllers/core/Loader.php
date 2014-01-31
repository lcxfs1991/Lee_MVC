<?php


 //Loader for loading routing, setting, data and library
 class Loader{

 	public static $config = null;
 	//cache the library objects
 	public static $helper = array();

 	public static $URI = array();


 	public static function init($config){

 		self::$config = $config; 		

 	}

 	public static function loading($config){

 		//initiate data
 		self::init($config);

 		//process url request and call specified class and function
 		self::loadURL();


 		
 	}

 	public static function loadURL(){

 		$root = $_SERVER["SCRIPT_NAME"];
 		$request= $_SERVER["REQUEST_URI"];

 		$root = str_replace("index.php", "", $root);
 		// echo $root."<br/>";
 		// echo $_SERVER["SCRIPT_NAME"]."<br/>";
 		// echo $_SERVER["REQUEST_URI"]."<br/>";
 		// echo $_SERVER["PHP_SELF"]."<br/>";
 		// echo $request."<br/>";

 		self::$URI = array();
 		
 		//get the request after index.php
 		$url = trim(str_replace($root, '', $request), '/');
 		
 		// echo $url."<br/>";
 		if (empty($url))
		{
		    //default class and function
		    $class = ucfirst(self::$config["system"]["defaultRoot"]["class"]);
		    $func = self::$config["system"]["defaultRoot"]["function"];
		}
		else
		{
		    self::$URI = explode('/', $url);

		    //if the function part is empty, call the default function
		    if (count(self::$URI) < 2)
		    {
		        $class = ucfirst(self::$URI[0]);
		        $func = self::$config["system"]["defaultRoot"]["function"];
		    }
		    else
		    {
		        $class = ucfirst(self::$URI[0]);
		        $func = self::$URI[1];
		    }
		}

		// echo $func;

		$file = self::$config["system"]["route"]["controllers"].$class.".php";

		// echo $class;

		//include class files
		if ( ! file_exists($file))
		{
		    // echo "!!!";
		    self::show_error();
		}
		else {
			// echo "??";
			require_once ($file);
			$obj = new $class;
		}


		
		if (isset($obj)){
			//call class functions
			if ( ! method_exists($obj, $func))
			{
			    self::show_error();
			}
			else {

				// echo $func;
				//run class function
				call_user_func_array(
				    //call internal functions
				    array($obj,$func), 
				    //pass parameters
				    array_slice(self::$URI, 2)
				);
			
			}

 	  	} 
    }


    public static function loadView($view, $data = array()){

    	if (!empty($data))
    	foreach ($data as $key => $value) {
    		$$key = $value;
    	}

    	require_once(self::$config["system"]["route"]["views"].$view.".php");
    }

    public static function loadHelper($helper){

 		$loadHelper = ucfirst(strtolower($helper));
 		# 如果已经加载，则返回对象，避免重复加载
        if (isset(self::$helper[$loadHelper]))
        {
            return self::$helper[$loadHelper];
        }
        else {

        	$file = self::$config["system"]["route"]["librarys"].$loadHelper.".php";
        	// echo $loadHelper;
			//include class files
			if ( ! file_exists($file))
			{
			    self::show_error();
			}
			else {
				require_once ($file);
				if ($loadHelper == "Helper_db")
					$obj = $loadHelper::getCon(self::$config);
				else 
					$obj = new $loadHelper;

				self::$helper[$loadHelper] = $obj;
				return $obj;
			}

        }



 	}


 	public static function custom_error(){
 		echo "new error";
 	}

 	public static function fatal_error(){
 		$error = error_get_last();
	    if ( ! empty($error))
	    {
	        self::show_error();
	    }
 	}

 	public static function show_error($data=array(), $code=404){
 	    if ($code === 404 )
	    {
	        header("HTTP/1.0 404 Not Found");
	        header("Status: 404 Not Found");
	    }

	    if ( ! isset($data['title']))
	    {
	        $data['title'] = 'error';
	    }

	    if ( ! isset($data['message']))
	    {
	        $error = error_get_last();
	        $data['message'] = "{$error['message']} in {$error['file']} on {$error['line']}";
	    }

	    Loader::loadView("error");
	    
 	}


}

?>