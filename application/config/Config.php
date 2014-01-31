<?php
//GLobal Setting

$Config["system"]["db"] = array(
	"db_host" =>  "localhost",
	"db_user" =>  "",
	"db_password" => "",
	"db_database" => "ed",
	"db_charset" => "utf8"
);


//library name setting
$Config["system"]["lib"] = array(
	"mine" =>  "my",
	"preset" => "helper"
);

//route settting
$Config["system"]["route"] = array(
	"default" => str_replace("application/config", "",__DIR__),
	"controllers" => str_replace("config", "",__DIR__)."controllers/",
	"models" => str_replace("config", "",__DIR__)."models/",
	"views" => str_replace("config", "",__DIR__)."views/",
	"librarys" => str_replace("config", "",__DIR__)."models/librarys/",
	"core" => str_replace("config", "",__DIR__)."controllers/core/",

);

$Config["system"]["defaultRoot"] = array(
 	"class" => "Home",
 	"function" => "defaultTrigger"
);

?>
