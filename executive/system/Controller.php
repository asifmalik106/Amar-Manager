<?php
include 'system/Load.php';


class Controller
{
	protected $load;
	function __construct(){
		$this->load = new Load();
	}
	
}