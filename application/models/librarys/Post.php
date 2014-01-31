<?php
/**@author Lee Hey
 * @class Post() is for content management
 * 
 */
require_once('Functions.php');
Class Post extends Functions{
    protected $dbc;
    
    //@param __construct pass db connection object to user
    public function __construct() { 
        
    
    } 
    
    //param insertPost $col->table column | $val->value to insert | this function is for inserting article, board_post, board_reply, event, event_summary, team, company, interest,message, 
    public function insertPost($table, $col = array(),$val = array()){
        try{
            parent::$this->table = $table;
            return parent::insert($col,$val);            
        }
        catch (Exception $e){
            return "系统错误";
        }
    }
    
    //@param updatePost $table->target table | $idColumn->target table id | $col->table column | $val->value to insert |similar target tables will use this function
    public function updatePost($table, $idColumn,$id,$col = array(),$val = array()){
        try{
            parent::$this->table = $table;
            parent::$this->idColumn = $idColumn;
            return parent::update($id,$col,$val);            
        }
        catch (Exception $e){
             return "系统错误";
        }
    }
    
}
?>
