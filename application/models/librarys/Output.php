<?php
/**
 *@author Lee Hey
 *@class Output() is for output management
 *@Description: Adopt decoration design pattern to wrap the data retrieve from database and return to html page
 * 
 */

Class Output implements Function_interface{
    
    protected $dbc;
    
    //@param __construct pass db connection object to user
    public function __construct() { 
        
    } 

    public function getInput($db){
        $this->dbc = $db;
    }
    
    public function getUserList(){
        
    }
    
    public function getArticleList(){
        
    }
    
    public function getArticleContent(){
        
    }
    
    public function getEventList(){
        
    }
    
    public function getEventContent(){
        
    }
    
    
}

?>
