<?php

Class Helper_db {
    public $dbc = null;
    public $return_num_row = null;
    private $config;
   
   //@param getCon()only way to get database connection object
   //@return database connection object
   static function getCon($config){
        
        static $db = null;
        if ($db==null)
            $db = new Helper_db($config);
        return $db;
    }
    
    //@param __construct private means the object created within the class
    private function __construct($config) {
        try {
            
        $this->config = $config;
            
        DEFINE('DB_USER', $this->config["system"]["db"]["db_user"]);
        DEFINE('DB_PASSWORD', $this->config["system"]["db"]["db_password"]);
        DEFINE('DB_HOST', $this->config["system"]["db"]["db_host"]);
        DEFINE('DB_NAME', $this->config["system"]["db"]["db_database"]);
        
        $this->dbc = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->dbc->set_charset($this->config["system"]["db"]["db_charset"]);
        
        // var_dump($this->dbc->get_charset());

        if ($this->dbc->connect_errno) {
            throw new Exception;
        }
//        else echo "connection success!";
        }
        catch (Exception $e){
            echo "connection failed";
        }
        
    }   //connect to database
    
    //@param exec() execute an SQL query
    //@return the id of affected row
    public function exec($query){
        try {
            mysqli_query($this->dbc, $query);
            return $this->dbc->affected_rows;

        }
        catch(Exception $e){
            return 0;
        }
        
    }
    
    //@param getResult() array of $var wants to select|$table|$condition
    //@return an array of data
    public function getResult($var=array(),$table,$condition = ""){
        try {
            $returnData="";
            $varList="";$i=1;
            $length = sizeof($var);
            if ($length==0){
                $varList="*";
            }
            else 
                foreach ( $var as $key => $value )  
                {  
                        $varList=($i>=$length)?($varList.$value):($varList.$value.",");
                        $i++;
                }
             $query="select $varList from $table $condition";

             // echo $query;
             
             if ($result=mysqli_query($this->dbc, $query)){
                 
                while ($out=mysqli_fetch_array($result)){
                    
                    $returnData[]=$out;
                    
                }
                
                $this->return_num_row = mysqli_num_rows($result);

                return $returnData;
             }
                return 0;
        }
        catch(Exception $e){
            return 0;
        }   
    }
    
    //@param getSQLResult() input is a complex sql query
    //@return an array of data
    public function getSQLResult($query){
        
         if ($result=mysqli_query($this->dbc, $query)){
                 
             while ($out=mysqli_fetch_array($result)){
                    
                 $returnData[]=$out;
                    
             }
                
             $this->return_num_row = mysqli_num_rows($result);
             var_dump($this->return_num_row);

               return $returnData;
                
         }
        
    }
}

?>
