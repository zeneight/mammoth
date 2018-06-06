<?php
/**
* 
*/
class MemberModel extends Model
{
	
	public function __construct()
	{
		$this->connect();
		$this->_table = "member";
	}
}