<?php

class Database  
{  
	private $dbhost = "localhost:3306";
	private $dbuser = "experjt1_program";
	private $dbpass = "?qbdD_w__~hQ";
	private $dbdata = "experjt1_itechdigi_sussexuni2017";	 	
	public $con;
	
	public function __construct()  
    {
		$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
		if (!$this->con)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$data = mysqli_select_db ($this->con, $this->dbdata);
		if (!$data)
		{
			die('Could not use: ' .$this->dbdata);
		} 
    } 

    public function __destruct() 
    { 
        mysqli_close($this->con);
    }  
}  

