<?php

 class controller 
 { 
    public function getURL(){
		return $_SERVER["HTTP_ORIGIN"] . $_SERVER["REQUEST_URI"];	
	}
 
 }
 
 