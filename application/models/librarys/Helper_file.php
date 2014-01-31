<?php
Class Helper_file{
    private $name="";
    private $type=array();
    private $folder = "";
    public function __construct() {
        
    }

    public function getInput($name,$type, $folder){

        $this->name=$name;
        $choosetype["image"] =array('image/jpeg','image/jpg','image/png','image/gif','image/bmp');
        $this->type=$choosetype[$type];
        $this->folder = $folder; 

    }

    public function upload(){
      try{
        $name=$this->name;
        if (isset($_FILES[$name])){     //check upload status
            if ($_FILES[$name]['error']>0){   //check upload error
                return "文件上传出错";
            }
            else {
                if (in_array($_FILES[$name]["type"],$this->type)){   //check upload type match
                    $temp_arr = explode(".", $_FILES[$name]["name"]);
                    $file_ext = array_pop($temp_arr);
                    $file_ext = trim($file_ext);
                    $file_ext = strtolower($file_ext);   //get file extention
                    $tmp=$_FILES[$name]["tmp_name"];
                    $dst=$this->folder.time().".".$file_ext;
                    if (move_uploaded_file($tmp, $dst)){   //upload file
                        return array("上传成功",$dst);
                    }
                    else return array("上传失败");
                }
                else return array("文件格式不允许");
                
            }
        }
        else return array("上传失败");
        $tmp=$_FILES[$name]["tmp_name"];
        if (file_exists($tmp) && is_file($tmp)){    //delete the temp file
            unlink($tmp);
        }
      }
      catch (Exception $e){
          return "系统出错";
      }
    }
}
?>
