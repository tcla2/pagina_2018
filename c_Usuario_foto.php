<?php

 
  class Usuario2
  {
   
    public $profile_img;
   
    function __construct($profile_img){     
      $this->profile_img = $profile_img;
    }

    function getData(){    
      $array['profile_img'] = $this->profile_img;
      return $array;
    }
    
  }



 ?>
