<?php
Class Helper_image implements Function_interface {
    private $file;
    private $folder = "upload/";
    
    public function __construct() {
        
    }

    public function getInput($file){

        $this->file=$file;

    }

    public function crop($x,$y,$width,$height){
        $src_path = $this->file;
        //创建源图的实例
        $src = imagecreatefromstring(file_get_contents($src_path));

        //裁剪开区域左上角的点的坐标
        //$x = 100;
        //$y = 12;
        //裁剪区域的宽和高
        //$width = 200;
        //$height = 200;
        //最终保存成图片的宽和高，和源要等比例，否则会变形
        $final_width = 500;
        $final_height = round($final_width * $height / $width);

        //将裁剪区域复制到新图片上，并根据源和目标的宽高进行缩放或者拉升
        $new_image = imagecreatetruecolor($final_width, $final_height);
        imagecopyresampled($new_image, $src, 0, 0, $x, $y, $final_width, $final_height, $width, $height);

        //输出图片
        //header('Content-Type: image/jpeg');
        $createfile="upload/".time().".png";
        imagejpeg($new_image,$createfile);
        return $createfile; 
        //imagejpeg($new_image);
        //imagedestroy($src);
        //imagedestroy($new_image);
    }
    public function resize(){
        //header("Content-type: image/png");    
        //原图    
        $src_path = $this->file;    
        //缩放比例 新图/原图    
        $percent = 150/500;    
        list($width,$height,$type) = getimagesize($src_path);    
        $newwidth = $width * $percent;    
        $newheight = $height * $percent;    
        // Load    
        $thumb = imagecreatetruecolor($newwidth, $newheight);    
        $source = imagecreatefromjpeg($src_path);    
        // Resize    
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);    
        // Output    
        $createfile=$folder.time()."_resize.png";
        imagejpeg($thumb,$createfile);
        return $createfile; 
        //imagejpeg($thumb);
        
    }
}
?>
