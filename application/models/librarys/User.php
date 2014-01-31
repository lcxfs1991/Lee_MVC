<?php
/**@author Lee Hey
 * @class User() is for user management
 * 
 */
require_once('Functions.php');

Class User extends Functions{
    //$table->table name| $idColumn->user id column | $userColumn->username column | $passColumn-->password column | $ veriColumn --> email verification code
    protected $dbc;
    protected $table = TB_USR;
    protected $idColumn = "id";
    private $userColumn = "username";
    private $passColumn = "password";
    private $veriColumn = "verification";
    
    //@param __construct pass db connection object to user
    public function __construct() { 
      parent::__construct();
      
    } 

    public function getInput($db)
    {
      parent::getInput($db);
    }
    
    //@param checkLogin()   $username -->username value | $password -->password vlaue | $returnVar --> value store in session
    //@return login info
    public function checkLogin($username,$password,$returnVar = array()){
        try {
            $username = mysqli_escape_string($this->dbc->dbc, $username);
            $password = mysqli_escape_string($this->dbc->dbc, $password);
            $checkResult1 = array();
            $checkResult2 = array();
            $checkResult1 = $this->dbc->getResult(array($this->idColumn),$this->table,"where $this->userColumn='$username'and $this->passColumn=password('".$password."')");

            if ($checkResult1!=""){
                $uid = (int) $checkResult1[0][0];

                $checkResult2 = $this->dbc->getResult($returnVar,$this->table,"where $this->idColumn=$uid and $this->veriColumn='0' limit 0,1");              
                if ($checkResult2!=""){
                    foreach ($checkResult2 as $key=>$value){
                        $_SESSION['login'] = $value;
                    }
                    
                    return "登陆成功";
                }
                else return "你未验证邮箱";
            }
            else return "用户名或密码错误";
            
        }
        catch(Exception $e){
            return "系统出错";
        } 
            
     }
    
    //@param insertUser() $name->username value check available or not|$col->array of columns you wanna add | $val-->column data
    //@return insertUser info
     public function insertUser($username, $password,$col = array(), $val = array()) {
         
         try{
             
             if (filter_var($username,FILTER_VALIDATE_EMAIL)=="")
                 return "邮箱格式不正确";
             if (($returnInfo = $this->checkPassword($password))!="密码正确"){
                return $returnInfo;
             }  
             
             $col [] = $this->userColumn;
             $col [] = $this->passColumn;
             $val [] = $username;
             $val [] = md5($password);
                 
             $query = "select $this->idColumn from $this->table where $this->userColumn='$username'";
             if ($this->dbc->exec($query)>0){
                 return "用户名已被注册";
             }
             else  
                 if (parent::insert($col, $val)=="插入成功")
                         return "注册成功";
         }
         catch(Exception $e){
            return "系统出错"; 
         }
        
     }
    
     //@param checkPassword  $password->the password to check
     //@return password checking result
    public function checkPassword($password){
        
        $format = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!?]).{6,12}$/";
        if (strlen($password)<6){
            return "密码长度不能低于6位"; 
        }
        else if (strlen($password)>12){
            return "密码长度不能高于12位"; 
        }
        else if (preg_match($format, $password)==0){
            return "密码格式不对";
        }
        else return "密码正确";
          
    }
     
     
    //@param updatePassword() $uid | $password | $password_repeat
    //@return password update info
    public function updatePassword($uid,$password,$password_repeat) {   
      try{
         
        if (($returnInfo = $this->checkPassword($password))!="密码正确"){
            return $returnInfo;
        }  
        else if (strcmp($password, $password_repeat)!=0){
            return "两次输入的密码不一致，请重新输入新密码";
        }
        else {
           $query = "update user set password=md5('{$password}') where $this->idColumn={$uid}"; 
           if ($this->dbc->exec($query)>0)
                return "修改成功";
           else return "密码与原先一致或发生异常错误"; 
        }
        
      }
      catch (Exception $e){
          return "系统出错";
      }
    
    }
    
    //Specific Functions for Endeavour
    
    //@param regEvent()
    //@return register info
    
    public function regEvent($uid,$eid,$col = array(),$val = array(), $command){
        
        parent::$this->table = "event_register";
        $eventExist = $this->dbc->getResult(array("uid"),"event_register","where uid=$uid and eid=$eid");
        
        if ($command=="register"){
            
            if ($eventExist!="")
                    return "你已经提交申请";
                    
            $col [] = "uid"; $col [] ="eid";
            $val [] = (int) $uid; $val [] = (int) $eid;

            return parent::insert($col,$val);            
            
        }
        else if ($command=="cancel"){
           
            if ($eventExist!="")
                return parent::delete($eventExist[0][0]);
            else
                return "查无此项";
            
        }
        else if ($command=="update"){
            if ($eventExist!="")
                return parent::update($eventExist[0][0],$col,$val);
            else 
                return "查无此项";
            
        }
        else return "系统出错";
        
        
    }
    
    public function rateEvent($uid,$eid,$comment,$rating){
        
        parent::$this->table = "event_register";
        $eventExist = $this->dbc->getResult(array("uid"),"event_register","where uid=$uid and eid=$eid");
        if ($eventExist!=""){
            parent::$this->table = "event_register";
            return parent::update($eventExist[0][0],array("event_register_comment","event_register_rating"),array($comment,$rating));
        }
        else 
            return "查无此项";
    }
    
    public function addUserCompany($uid,$cid){
        
        parent::$this->table = "user_company";
        return parent::insert(array("uid","cid"),array($uid,$cid));                
        
    }
    
    public function addUserInterest($uid,$in_id){
        
        parent::$this->table = "user_interest";
        return parent::insert(array("uid","in_id"),array($uid,$in_id));  
        
    }
    
    //$type-->company or interest
    public function findSimilar($type,$uid){
        try{
        $uid = (int) $uid;
        $columnID = ($type=="interest")?("in_id"):("cid"); 
        
            $query = "select distinct user_$type.uid as target_uid,t1.name,t1.photo,t1.university,t1.major,t1.schoolyear from 
                        (select user.uid,user_$type.$columnID,user.name,user.photo,user.university,user.major,user.schoolyear from user,user_$type
                        where user.uid=user_$type.uid and user.uid=$uid) as t1,
                        user_$type
                        where t1.$columnID = user_interest.$columnID and t1.uid<>user_$type.uid
                        order by target_uid";
//            echo $query;
            
            $similarResult = $this->dbc->getSQLResult($query);
            if ($similarResult=="")
                return "没有共同爱好的朋友";
            else return $similarResult;
        }
        catch(Exception $e){
            return "系统出错";
        }
        
    }
    
    //@param findExactMatch $typ-->company or interest | $name-->company name or interest name
    public function findExactMatch($type,$name,$uid){
      
      $columnName = ($type=="interest")?("interest"):("company"); 
      $columnID = ($type=="interest")?("in_id"):("cid");
      
      try{
        $query = "select *
                    from
                    (select uid from 
                    (select $columnID 
                    from $type
                    where $columnName='$name') as t1,
                    user_$type as t2
                    where t1.$columnID = t2.$columnID and t2.uid<>$uid) as t3,
                    user
                    where user.uid = t3.uid";   //t2.uid<>$uid means excluding user itself
        $similarResult = $this->dbc->getSQLResult($query);
            if ($similarResult=="")
                return "没有共同爱好的朋友";
            else return $similarResult;
        
        
      }
      catch(Exception $e){
          
          return "系统出错";
          
      }
        
        
     
    }
    
}
?>
