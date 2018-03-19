<?php
  spl_autoload_register(function($class_name){

    if(file_exists($class_name.".php")){
      require_once $class_name.".php";
    }
    if(file_exists("..\\".$class_name.".php")){
      require_once "..\\".$class_name.".php";
    }
    if(file_exists("..\\Data\\".$class_name.".php")){
      require_once "..\\Data\\".$class_name.".php";
    }
  })
 ?>
