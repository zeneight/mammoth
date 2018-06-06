<?php
/**
* 
*/
class KatberitaModel extends Model
{
	
	public function __construct()
	{
		$this->connect();
		$this->_table = "katberita";
	}
}