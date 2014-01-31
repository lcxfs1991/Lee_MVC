<?php

Class Functions{
    
    protected $dbc="";
    protected $table = "";
    protected $idColumn = "";
    public $insert_id = "";
    
    public function __construct() { 
        
    } 
    
    public function getInput($db){
        $this->dbc = $db;
    }

    public function delete($id) {
        
        try{
            $query = "delete from $this->table where $this->idColumn = $id";
             if ($this->dbc->exec($query)>0)
                return "删除成功";
           else return "删除失败"; 
        }
        catch(Exception $e){
            return "系统出错";
        }
     }
    
    //@param insert() $col->array of columns you wanna add | $val-->column data
    //@return insert info
    public function insert($col = array(), $val = array()) {
        try {
            $col_len = sizeof($col);
            $val_len = sizeof($val);
            
            $col_list = "";
            $val_list = "";
            $i=1;$j=1;
            
            if ($col_len==0 || $val_len!=$col_len){
                return "两列表不对称";
            }
            else {
                
                foreach ( $col as $key => $value )  
                {  
                        $col_list=($i>=$col_len)?($col_list.$value):($col_list.$value.",");
                        $i++;
                }
                foreach ( $val as $key => $value )  
                {       
                        if (is_string($value)){
                            $value = $this->filterContent($value);
                            $value = "'".$value."'";
                        }
                        $val_list=($j>=$val_len)?($val_list.$value):($val_list.$value.",");
                        $j++;
                }

                $query = "insert into $this->table ($col_list) values($val_list)";

                // echo $query;
                
                if ($this->dbc->exec($query)>0)
                {
                    $this->insert_id = $this->dbc->dbc->insert_id;
                    return "插入成功";
                }
                else return "插入失败";
                
            }
        }
        catch(Exception $e){
            return "系统出错";
        }

    }
    
    //@param update() $col->array of columns you wanna add | $val-->column data
    //@return update info
    public function update($id,$col = array(), $val = array()){
        
            $col_len = sizeof($col);
            $val_len = sizeof($val);
            
            $update_list = "";
            
            if ($col_len==0 || $val_len!=$col_len){
                return "两列表不对称";
            }
            else {

                for ($i=0;$i<$col_len;$i++){
                    if (is_string($val[$i])){
                        $val[$i] = $this->filterContent($val[$i]);
                        $val[$i] = "'".$val[$i]."'";
                    }
                    $update_list = ($i>=$col_len-1)?($update_list.$col[$i]."=".$val[$i]):($update_list.$col[$i]."=".$val[$i].",");
                    
                }

                $query = "update $this->table set $update_list where $this->idColumn=$id";
                // echo $query;
                
                if ($this->dbc->exec($query)>0)
                    return "更新成功";
                else return "更新失败";
                
            }
    }
    
    public function filterContent($var){

        $temp = str_replace(array("\r\n"," ","<b></b>","<i></i>","<h1></h1>","<h2></h2>","<h3></h3>","<h4></h4>","<h5></h5>","<h6></h6>","<script></script>"),array("</br>","&nbsp","<b></b>","<i></i>","<h1></h1>","<h2></h2>","<h3></h3>","<h4></h4>","<h5></h5>","<h6></h6>",""),$var); 
        $temp = $this->dbc->dbc->real_escape_string($temp);
        
        return $temp;
        
    } 
    
    
    
    
}



?>
