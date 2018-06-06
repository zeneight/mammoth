<?php
/**
* 
*/
class AdminModel extends Model
{
	
	function __construct()
	{
		$this->connect();
		$this->_table = "admin";
	}
}